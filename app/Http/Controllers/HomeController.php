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
            $centros =  CentrosVotacion::where('id_usuario',$id)->where('completado',0)->get();
             
            return view('formulario-votos', compact('centros','candidatos'));
    }


    public function formulario_acta()
    {
        $id = auth()->user()->id;
            $centros =  CentrosVotacion::where('id_usuario',$id)->where('completado',0)->get();
             
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

        $resultadosHead = new TResultadosHead();
        $resultadosHead->id_jrv = $request->jrv;
        $resultadosHead->papeletas_entregadas = $request->TPapeletas;
        $resultadosHead->papeletas_utilizadas = $request->UPapeletas;
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



           
        if($rol == 1)
        {
            return redirect()->route('ingreso');

            
        }
        else
        {
            return redirect()->route('formulario-votos');
        }




    }
    public function guardarActa(Request $request)
    {
        $id = auth()->user()->id;
            $saveJrv = new TResultadosActa();
            $saveJrv->id_centro = $request->centro;
            $saveJrv->id_jrv = $request->jrv;
            $saveJrv->papeletas_entregadas = $request->TPapeletas;
            $saveJrv->papeletas_utilizadas = $request->UPapeletas;
            $saveJrv->papeletas_sobrantes = $request->SPapeletas;
            $saveJrv->votos_validos = $request->VValidos;
            $saveJrv->votos_nulos = $request->VNulos;
            $saveJrv->votos_impugnados = $request->VImpugnados;
            $saveJrv->abstenciones = $request->abstenciones;
            $saveJrv->v_miguel_pereira = $request->vMiguel;
            $saveJrv->v_fmln = $request->vFmln;
            $saveJrv->v_ambos_fmln = $request->vAmbosFmln;
            $saveJrv->v_total_fmln = $request->vMiguel+$request->vFmln+$request->vAmbosFmln;
            $saveJrv->v_will_salgado = $request->vWill;
            $saveJrv->v_ni_gana = $request->vGanaNi;
            $saveJrv->v_ambos_ni_gana = $request->vAmbosGanaNi;
            $saveJrv->v_total_ni_gana = $request->vWill+$request->vGanaNi+$request->vAmbosGanaNi;
            $saveJrv->v_luwing = $request->vLuwin;
            $saveJrv->v_nt = $request->vNT;
            $saveJrv->v_ambos_nt = $request->vAmbosNT;
            $saveJrv->v_total_nt = $request->vLuwin+$request->vNT+ $request->vAmbosNT;
            $saveJrv->v_moises = $request->vReyes;
            $saveJrv->v_pdc = $request->vPDC;
            $saveJrv->v_ambos_pdc = $request->vAmbosPDC;
            $saveJrv->v_total_pdc = $request->vReyes+$request->vPDC +$request->vAmbosPDC;
            $saveJrv->v_margarita = $request->vMargarita;
            $saveJrv->v_pcn = $request->vPCN;
            $saveJrv->v_ambos_pcn = $request->vAmbosPCN;
            $saveJrv->v_total_pcn = $request->vMargarita+$request->vPCN+$request->vAmbosPCN;
            $saveJrv->v_geovanni = $request->vGeovanni;
            $saveJrv->v_cd = $request->vCD;
            $saveJrv->v_ambos_cd = $request->vAmbosCD;
            $saveJrv->v_total_cd = $request->vGeovanni+$request->vCD+$request->vAmbosCD;
            $saveJrv->v_maria = $request->vMariaViera;
            $saveJrv->v_arena = $request->vArena;
            $saveJrv->v_ambos_arena = $request->vAmbosArena;
            $saveJrv->v_total_arena = $request->vMariaViera+$request->vArena+$request->vAmbosArena;
            $saveJrv->id_user = $id;
            $saveJrv->papeletas_inutilizadas = $request->IPapeletas;
            $saveJrv->papeletas_entregadas_vot = $request->EPapeletas;
            $saveJrv->save();




            $rol = auth()->user()->rol;
        if($rol == 1)
        {
            return redirect()->route('acta');

            
        }
        else
        {
            return redirect()->route('acta');
        }




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
