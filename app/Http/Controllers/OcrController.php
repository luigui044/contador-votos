<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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

        for ($i = 0; $i < count($conceptos); $i++) {
            $total += floatval($palabras[$i]);
            $votos[$conceptos[$i]] = $palabras[$i];
        }

        $votos['total' . trim($palabraBusqueda)] = $total;
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
            'NUEVAS IDEAS'
        ];

        $tiposOtrosVotos = [
            'IMPUGNADOS',
            'NULOS',
            'ABSTENCIONES',
            'FALTANTES'
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

    function procesarActa(Request $request) {
        $archivoActa = $request->hasFile('archivo_acta') ? $request->file('archivo_acta') : '';
        $fotografiaActa = $request->hasFile('fotografia_acta') ? $request->file('fotografia_acta') : '';

        // Validando que suban el archivo del acta
        if ($archivoActa == '' && $fotografiaActa == '') {
            Alert::error('Error', 'Debe subir el archivo del acta para que pueda ser procesada.');
            return back();
        }

        $rutaArchivo = $archivoActa == '' ? $fotografiaActa : $archivoActa;
        $rutaArchivo = $rutaArchivo->store('Actas');
        $archivo = Storage::get($rutaArchivo);
        $archivoActa = $request->hasFile('archivo_acta') ? $request->file('archivo_acta') : '';
        
        $client = new ImageAnnotatorClient([
            'credentials' => json_decode(file_get_contents('C:\Users\HP\AppData\Roaming\gcloud\application_default_credentials.json'), true)
        ]);

        // Annotate an image, detecting faces.
        $annotation = $client->documentTextDetection(
            $archivo,
            [Type::DOCUMENT_TEXT_DETECTION]
        );

        $textoBoleta = $annotation->getFullTextAnnotation()->getText();
        return $this->procesarTexto($textoBoleta);
    }
}
