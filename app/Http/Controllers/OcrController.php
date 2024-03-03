<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Jrv;

use App\Models\CentrosVotacion;
use App\Models\TResultadosBodyActa;
use App\Models\TResultadosHeadActa;
use Exception;

class OcrController extends Controller
{
    private function obtenerDatosDeEncabezados ($encabezados, $texto) {
        $datos = [];
        foreach ($encabezados as $encabezado) {
            $cantidadPalabrasEncabezado = count(explode(' ', $encabezado));
            $texto = substr(
                $texto, 
                strpos($texto, $encabezado));
            $dato = explode(' ', $texto)[$cantidadPalabrasEncabezado];
            $datos[$encabezado] = $dato;
        }
        return $datos;
    }

    private function obtenerVotos($texto, $palabraBusqueda, $conceptos) {
        $votos = [];
        $texto = substr($texto, strpos($texto, $palabraBusqueda) + strlen($palabraBusqueda));
        $palabras = explode(' ', $texto);
        $total = 0;

        for ($i = 0; $i < count($conceptos) - 1; $i++) {
            $total += floatval($palabras[$i]);
            $votos[$conceptos[$i]] = $palabras[$i];
        }

        $votos[$conceptos[count($conceptos) - 1]] = $total;
        return $votos;
    }

    function procesarTexto($texto) { 
        $encabezadosTabla1 = ['sobrantes', 'inutilizadas', 'entregadas a votantes',  'junta', 'total papeletas'];

        $partidosPoliticos = [
            'FUERZA SOLIDARIA',
            'FMLN',
            'ARENA',
            'NUESTRO TIEMPO',
            'FPS',
            'NUEVAS IDEAS',
            'TOTAL VOTOS VALIDOS'
        ];

        $tiposOtrosVotos = [
            'IMPUGNADOS',
            'NULOS',
            'ABSTENCIONES',
            'FALTANTES',
            'TOTAL OTROS VOTOS'
        ];

        // Se cambian todos los \n que trae el texto por espacios en blanco
        $texto = preg_replace('/\n+/', ' ', $texto);
        $texto = mb_strtolower($texto, 'UTF-8');
        $textoActa = 'acta.';
        $posicionTextoActa = strpos($texto, $textoActa);
        $textoDeInteres = substr($texto, $posicionTextoActa);

        $datosTabla1 = $this->obtenerDatosDeEncabezados($encabezadosTabla1, $textoDeInteres);
        $textoVotosValidos = 'total votos válidos ';
        $textoOtrosVotos = 'otros votos ';
        $votosValidos = $this->obtenerVotos($textoDeInteres, $textoVotosValidos, $partidosPoliticos);
        $otrosVotos = $this->obtenerVotos($textoDeInteres, $textoOtrosVotos, $tiposOtrosVotos);
        return array_merge($datosTabla1, $votosValidos, $otrosVotos);
    }

    private function almacenarInformacionActa ($datos, $jrv, $rutaArchivo) {
        $partidosPoliticos = [
            'FUERZA SOLIDARIA',
            'FMLN',
            'ARENA',
            'NUESTRO TIEMPO',
            'FPS',
            'NUEVAS IDEAS',
            'TOTAL VOTOS VALIDOS'
        ];

        try {
            $headActa = new TResultadosHeadActa();
            $headActa->id_jrv = $jrv;

            // Si esta habilitado el ocr se guardan estos campos
            if (count($datos) > 0) {
                $headActa->papeletas_entregadas = intval($datos['total papeletas']);
                $headActa->papeletas_utilizadas = 0;
                $headActa->papeletas_sobrantes = intval($datos['sobrantes']);
                $headActa->papeletas_inutilizadas = intval($datos['inutilizadas']);
                $headActa->papeletas_entregadas_votantes = intval($datos['entregadas a votantes']);
                $headActa->votos_validos = intval($datos['TOTAL VOTOS VALIDOS']);
                $headActa->votos_nulos = intval($datos['NULOS']);
                $headActa->votos_impugnados = intval($datos['IMPUGNADOS']);
                $headActa->abstenciones = intval($datos['ABSTENCIONES']);
            }
    
            $headActa->id_user = auth()->user()->id;
            $headActa->archivo = $rutaArchivo;
            $headActa->save();

            for ($i=1; $i <= 6; $i++) {
                $bodyActa = new TResultadosBodyActa();
                $bodyActa->id_resultado_head = $headActa->id;
                $bodyActa->id_candidato = $i;
                $bodyActa->v_rostro = 0;
                // Si esta habilitado el ocr se guardan estos campos
                if (count($datos) > 0) {
                    $bodyActa->v_bandera = $datos[$partidosPoliticos[$i - 1]];
                }
                $bodyActa->v_ambos = 0;
                $bodyActa->save();
            }


            $cualjrv = Jrv::find($jrv);
            $cualjrv->completado2 =1;
            $cualjrv->save();

            Alert::success('Información', 'Los datos del acta han sido guardados correctamente.');
        } catch (Exception $e) {
            Alert::error('Información', 'Ha ocurrido un error al intentar almacenar el acta.');
        } finally {
            return redirect()->route('acta');
        }
    }

    function procesarActa(Request $request) {
        $request->validate([
            'jrv' => 'required'
        ]);

        $archivoActa = $request->hasFile('archivo_acta') ? $request->file('archivo_acta') : '';
        $jrv = $request->jrv;

        // Validando que suban el archivo del acta
        if ($archivoActa == '') {
            Alert::error('Error', 'Debe subir el archivo del acta para que pueda ser procesado.');
            return back();
        }

        // Se guarda el archivo
        $rutaArchivo = $archivoActa->store('Actas');

        $archivo = Storage::get($rutaArchivo);
        
        $client = new ImageAnnotatorClient([
            'credentials' => json_decode('{
                "account": "",
                "client_id": "764086051850-6qr4p6gpi6hn506pt8ejuq83di341hur.apps.googleusercontent.com",
                "client_secret": "d-FL95Q19q7MQmFpd7hHD0Ty",
                "quota_project_id": "rcla-342216",
                "refresh_token": "1//055iqCc5k8UoaCgYIARAAGAUSNwF-L9IrTQin6mZDC7XjJPKTf4rno4OYj3XoN8i5yv5ANlWkAuzKCpLIYTcmyFx1mbG1eWogI7k",
                "type": "authorized_user",
                "universe_domain": "googleapis.com"
            }', true)
        ]);

        // Annotate an image, detecting faces.
        $annotation = $client->documentTextDetection(
            $archivo,
            [Type::DOCUMENT_TEXT_DETECTION]
        );

        $textoActa = $annotation->getFullTextAnnotation()->getText();
        $datosExtraidos = $this->procesarTexto($textoActa);
        return $this->almacenarInformacionActa($datosExtraidos, $jrv, $rutaArchivo);
    }
}
