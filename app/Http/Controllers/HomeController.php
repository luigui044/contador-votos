<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentrosVotacion;
use App\Models\Jrv;
use App\Models\TResultado;
use App\Models\TResultadosActa;

use App\Models\VwSumaVoto;
use App\Models\VSumaVotosActa;
use App\Models\ContarJrv;
use App\Models\ContarJrvActa;
use App\Models\TTipoVotoActa;

use App\Models\ContarJrvPorcentaje;
use App\Models\ContarJrvPorcentajeActa;

use App\Models\TTipoVoto;
use App\Models\VwTipoVoto;
use App\Models\TCandidato;
use App\Models\TResultadosHead;
use App\Models\TResultadosBody;
use RealRashid\SweetAlert\Facades\Alert;

use DB;
use JavaScript;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $rol = auth()->user()->rol;
        if($rol == 1 || $rol ==3)
        {
            return $this->resumen();
        }
        else
        {
           return $this->formulario();
        }

      
    }





    public function formulario()
    {
            $id = auth()->user()->id;
            $candidatos = TCandidato::all();
            // $centros =  CentrosVotacion::where('id_usuario',$id)->where('completado',0)->get();
            $centros = CentrosVotacion::where('completado',0)->get();

            return view('formulario-votos', compact('centros','candidatos'));
    }


    public function formulario_acta()
    {
        $id = auth()->user()->id;
        $centros = CentrosVotacion::where('completado',0)->get();
        // $centros =  CentrosVotacion::where('id_usuario',$id)->where('completado',0)->get();          
        return view('formulario-acta', compact('centros'));
    }


    public function filtrar(Request $request)
    {
        $centro = $request->centro;

        $jrvs = Jrv::where('id_centro_vot',$centro)->where('completado',0)->get();

        return view('partials.jrv',compact('jrvs'));



    }



    public function filtrar2(Request $request)
    {
        $centro = $request->centro;

        $jrvs = Jrv::where('id_centro_vot',$centro)->where('completado',1)->get();

        return view('partials.jrv',compact('jrvs'));



    }

    public function guardarJrv(Request $request)
    {
        $id = auth()->user()->id;
        $rol = auth()->user()->rol;    
        $jrv = $request->jrv;
        $resultadosHead = new TResultadosHead();
        $resultadosHead->id_jrv = $jrv;
        $resultadosHead->papeletas_entregadas = $request->TPapeletas;
        $resultadosHead->papeletas_utilizadas = 0;
        $resultadosHead->papeletas_sobrantes = $request->SPapeletas;
        $resultadosHead->papeletas_inutilizadas = $request->IPapeletas;
        $resultadosHead->papeletas_entregadas_votantes = $request->EPapeletas;
        $resultadosHead->votos_validos = $request->VValidos;
        $resultadosHead->votos_nulos = $request->VNulos;
        $resultadosHead->votos_impugnados = $request->VImpugnados;
        $resultadosHead->abstenciones = $request->abstenciones;
        $resultadosHead->id_user = $id;
        $resultadosHead->save();



        for ($i=1; $i <=5 ; $i++) { 
            

          $resultadosBody = new TresultadosBody();
          $resultadosBody->id_resultado_head = $resultadosHead->id;
          $resultadosBody->id_candidato = $i;
          $resultadosBody->v_rostro = $request->input('vCandidato'.$i);
          $resultadosBody->v_bandera = $request->input('vPartido'.$i);
          $resultadosBody->v_ambos = $request->input('vAmbos'.$i);;

          $resultadosBody->save();

        }

        $cualjrv = Jrv::find($jrv);
        $cualjrv->completado =1;
        $cualjrv->save();
           
        if($rol == 1)
        { 
            alert()->success('Confirmación','Resultados de JRV No.'.$cualjrv->junta. ' Registrados éxitosamente' );

            return redirect()->route('ingreso');

            
        }
        else
        {
            alert()->success('Confirmación','Resultados de JRV No.'.$request->jrv. ' Registrados éxitosamente'  );
            return back();
        }




    }
    public function guardarActa(Request $request)
    {

            ///// DEJO COMENTADO EN FUNCION DE SUSTITUIR LO QUE ANTES ERAN LOS INPUTS POR LOS VALORES LEIDOS EN LA IMAGEN
            // SOLO SE MANTENDRAN LOS DATOS DE LA JRV, ID USUARIO Y ROL
            //  $id = auth()->user()->id;
            //  $rol = auth()->user()->rol;
            //  $jrv = $request->jrv;
            //  $resultadosHead = new TResultadosHead();
            //  $resultadosHead->id_jrv = $jrv;
            //  $resultadosHead->papeletas_entregadas = $request->TPapeletas;
            //  $resultadosHead->papeletas_utilizadas = 0;
            //  $resultadosHead->papeletas_sobrantes = $request->SPapeletas;
            //  $resultadosHead->papeletas_inutilizadas = $request->IPapeletas;
            //  $resultadosHead->papeletas_entregadas_votantes = $request->EPapeletas;
            //  $resultadosHead->votos_validos = $request->VValidos;
            //  $resultadosHead->votos_nulos = $request->VNulos;
            //  $resultadosHead->votos_impugnados = $request->VImpugnados;
            //  $resultadosHead->abstenciones = $request->abstenciones;
            //  $resultadosHead->id_user = $id;
            //  $resultadosHead->save();



            //  for ($i=1; $i <=5 ; $i++) { $resultadosBody=new TresultadosBody(); $resultadosBody->id_resultado_head =
            //      $resultadosHead->id;
            //      $resultadosBody->id_candidato = $i;
            //      $resultadosBody->v_rostro = $request->input('vCandidato'.$i);
            //      $resultadosBody->v_bandera = $request->input('vPartido'.$i);
            //      $resultadosBody->v_ambos = $request->input('vAmbos'.$i);;

            //      $resultadosBody->save();

            //      }

            //      $cualjrv = Jrv::find($jrv);
            //      $cualjrv->completado =1;
            //      $cualjrv->save();
       
            alert()->success('Confirmación','Resultados de JRV No. 0 Registrados éxitosamente');    
            return redirect()->route('acta');

    }


    public function resumen()
    {   

        
        $votos = VwSumaVoto::all();
        $jrvs = ContarJrv::all();
         $jrvsporc= ContarJrvPorcentaje::all();
        $tvotos = VwTipoVoto::all();
        JavaScript::put([
        
        'votos' => $votos,
        'jrvs' => $jrvs,
        'jrvsporc' => $jrvsporc,
        'tvotos'=> $tvotos
            ]);

        return view('dashboard');
    }


    public function resumenActas()
    {   
        $voto = VSumaVotosActa::all();
        $jrvs = ContarJrvActa::all();
         $jrvsporc= ContarJrvPorcentajeActa::all();
        $tvotos = TTipoVotoActa::all();
        JavaScript::put([
        'voto' => $voto,
        'jrvs' => $jrvs,
        'jrvsporc' => $jrvsporc,
        'tvotos'=> $tvotos
            ]);

        return view('dashboard-actas');
    }

}
