@extends('layouts.master')

@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('contenedor')
    

<div class="container-fluid">
    
    <h1 class="text-center">Formulario de contador de  Votos</h1>
    <hr>
    <form action="{{route('guardar')}}" id="formulario" method="POST">
@csrf
    <div class="row">

            <div class="col-md-5">

                    <div class="form-group">
                        {{-- centro de votación --}}    
                        <label for="centro">Centro de votación</label>
            
                        <select name="centro" id="centro" class="form-control" required>
                            <option value="">Seleccione centro de votación</option>
                            @foreach ($centros as $item)
                                <option value="{{$item->id_centro}}">{{$item->nombre}}</option>

                            @endforeach
                        </select>
            
                    </div>
                    {{-- Número JRBV --}}
                    <div class="form-group " id="filtrar">
            
                        <label for="jrv">Número de JRV</label>
            
                        <select name="jrv" id="jrv" class="form-control" disabled > 
                            <option value="">seleccione número de JRV</option>
                        </select>
            
                    </div>
            
                    <div class="row">

                        <div class="col-md-6">

                            {{-- total de papeletas entregadas --}}
                                    <div class="form-group">
                                        <label for="TPapeletas">Número de Papeletas entregadas</label>
                                        <input type="text" name="TPapeletas"  class="form-control" id="TPapeletas" required>
                            
                                    </div>
                            
                            {{-- papeletas utilziadas --}}
                            
                                    <div class="form-group">
                                        <label for="UPapeletas">Papeletas Utilizadas</label>
                                        <input type="text" class="form-control" name="UPapeletas" id="UPapeletas" required>
                                    </div>
                                    
                            {{-- papeltas sobrantes --}}
                                    <div class="form-group">
                                        <label for="SPapeletas">Papeletas Sobrantes
                                        </label>
                                        <input type="text" class="form-control" name="SPapeletas" id="SPapeletas" required>
                                    </div>
                                    {{-- papeltas inutlizadas --}}
                                <div class="form-group">
                                    <label for="IPapeletas">Papeletas inutlizadas
                                    </label>
                                    <input type="text" class="form-control" name="IPapeletas" id="IPapeletas" required>
                                </div>
                                 {{-- papeltas inutlizadas --}}
                                 <div class="form-group">
                                    <label for="EPapeletas">Papeletas Entregadas a votantes
                                    </label>
                                    <input type="text" class="form-control" name="EPapeletas" id="EPapeletas" required>
                                </div>
                        </div>

                        <div class="col-md-6">

                            {{-- total de papeletas entregadas --}}
                                    <div class="form-group">
                                        <label for="VValidos">Votos válido</label>
                                        <input type="text" name="VValidos"  class="form-control" id="VValidos" required>
                            
                                    </div>
                            
                            {{-- papeletas utilziadas --}}
                            
                                    <div class="form-group">
                                        <label for="VNulos">Votos nulos</label>
                                        <input type="text" class="form-control" name="VNulos" id="VNulos" required>
                                    </div>
                                    
                            {{-- papeltas sobrantes --}}
                                    <div class="form-group">
                                        <label for="VImpugnados">Votos impugnados
                                        </label>
                                        <input type="text" class="form-control" name="VImpugnados" id="VImpugnados" required>
                                    </div>
                                     {{-- papeltas abstenciones --}}
                             <div class="form-group">
                                <label for="abstenciones">Abstenciones
                                </label>
                                <input type="text" class="form-control" name="abstenciones" id="abstenciones" required>
                            </div>
                        </div>
                        
                    </div>
            
            </div>

            <div class="col-md-7">
                {{-- FMLN --}}
                <div class="row">
                    <div class="col-md-3">
                         {{-- votos Rostros MP --}}
                         <div class="form-group">
                            <label for="vMiguel">Votos Miguel Pereira 
                            </label>
                            <input type="text" class="form-control" name="vMiguel" id="vMiguel" value="0" onchange="sumar('#vMiguel','#vFmln','#vAmbosFmln','#vTotalFmln')"required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}} 
                        <div class="form-group">
                           <label for="vFmln">Votos FMLN 
                           </label>
                           <input type="text" class="form-control" name="vFmln" id="vFmln"  value="0"  onchange="sumar('#vMiguel','#vFmln','#vAmbosFmln','#vTotalFmln')" required>
                       </div>
                   </div>
                   <div class="col-md-3">
                    {{-- votos Bandera  FMLN --}}
                    <div class="form-group">
                       <label for="vAmbosFmln">Ambos
                       </label>
                       <input type="text" class="form-control" name="vAmbosFmln" id="vAmbosFmln"  value="0"  onchange="sumar('#vMiguel','#vFmln','#vAmbosFmln','#vTotalFmln')" required>
                   </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}}
                        <div class="form-group">
                           <label for="vTotalFmln">Total 
                           </label>
                           <input type="text" class="form-control" name="vTotalFmln" id="vTotalFmln" disabled>
                       </div>
                    </div>
                  
                </div>
                {{-- GANA/NI --}}
                <div class="row">
                    <div class="col-md-3">
                         {{-- votos Rostros MP --}}
                         <div class="form-group">
                            <label for="vWill">Votos Will Salgado 
                            </label>
                            <input type="text" class="form-control" name="vWill" id="vWill" onchange="sumar('#vWill','#vGanaNi','#vAmbosGanaNi','#vTotalGanaNi')"  value="0"   required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}}
                        <div class="form-group">
                           <label for="vGanaNi">Votos GANA/NI 
                           </label>
                           <input type="text" class="form-control" name="vGanaNi" id="vGanaNi" onchange="sumar('#vWill','#vGanaNi','#vAmbosGanaNi','#vTotalGanaNi')"  value="0"  required>
                       </div>
                   </div>
                   <div class="col-md-3">
                    {{-- votos Bandera  FMLN --}}
                    <div class="form-group">
                       <label for="vAmbosGanaNi">Ambos
                       </label>
                       <input type="text" class="form-control" name="vAmbosGanaNi" id="vAmbosGanaNi" onchange="sumar('#vWill','#vGanaNi','#vAmbosGanaNi','#vTotalGanaNi')"  value="0"  required>
                   </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}}
                        <div class="form-group">
                           <label for="vTotalGanaNi">Total 
                           </label>
                           <input type="text" class="form-control" name="vTotalGanaNi" id="vTotalGanaNi" disabled>
                       </div>
                    </div>
                  
                </div>
                {{-- Nuestro tiempo --}}
                <div class="row">
                    <div class="col-md-3">
                         {{-- votos Rostros MP --}}
                         <div class="form-group">
                            <label for="vLuwin">Votos Luwing Campos
                            </label>
                            <input type="text" class="form-control" name="vLuwin" id="vLuwin" onchange="sumar('#vLuwin','#vNT','#vAmbosNT','#vTotalNT')"  value="0"   required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}}
                        <div class="form-group">
                           <label for="vNT">Votos NT
                           </label>
                           <input type="text" class="form-control" name="vNT" id="vNT" onchange="sumar('#vLuwin','#vNT','#vAmbosNT','#vTotalNT')"  value="0"    required>
                       </div>
                   </div>
                   <div class="col-md-3">
                    {{-- votos Bandera  FMLN --}}
                    <div class="form-group">
                       <label for="vAmbosNT">Ambos
                       </label>
                       <input type="text" class="form-control" name="vAmbosNT" id="vAmbosNT" onchange="sumar('#vLuwin','#vNT','#vAmbosNT','#vTotalNT')"  value="0"   required>
                   </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}}
                        <div class="form-group">
                           <label for="vTotalNT">Total 
                           </label>
                           <input type="text" class="form-control" name="vTotalNT" id="vTotalNT" disabled>
                       </div>
                    </div>
                  
                </div>
                {{-- PCN --}}
                <div class="row">
                    <div class="col-md-3">
                         {{-- votos Rostros Margarita --}}
                         <div class="form-group">
                            <label for="vMargarita">Votos  Margarita Moreno 
                            </label>
                            <input type="text" class="form-control" name="vMargarita" id="vMargarita" onchange="sumar('#vMargarita','#vPCN','#vAmbosPCN','#vTotalPCN')"  value="0"   required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  PDC --}}
                        <div class="form-group">
                           <label for="vPCN">Votos PCN
                           </label>
                           <input type="text" class="form-control" name="vPCN" id="vPCN" onchange="sumar('#vMargarita','#vPCN','#vAmbosPCN','#vTotalPCN')"  value="0"  required>
                       </div>
                   </div>
                   <div class="col-md-3">
                    {{-- votos Bandera  FMLN --}}
                    <div class="form-group">
                       <label for="vAmbosPCN">Ambos
                       </label>
                       <input type="text" class="form-control" name="vAmbosPCN" id="vAmbosPCN" onchange="sumar('#vMargarita','#vPCN','#vAmbosPCN','#vTotalPCN')"  value="0"  required>
                   </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}}
                        <div class="form-group">
                           <label for="vTotalPCN">Total 
                           </label>
                           <input type="text" class="form-control" name="vTotalPCN" id="vTotalPCN"   disabled>
                       </div>
                    </div>



                  
                  
                </div>
                {{-- PDC --}}
                <div class="row">
                    <div class="col-md-3">
                         {{-- votos Rostros Margarita --}}
                         <div class="form-group">
                            <label for="vReyes">Votos Moises Juárez
                            </label>
                            <input type="text" class="form-control" name="vReyes" id="vReyes" onchange="sumar('#vReyes','#vPDC','#vAmbosPDC','#vTotalPDC')"  value="0"  required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  PDC --}}
                        <div class="form-group">
                           <label for="vPDC">Votos PDC
                           </label>
                           <input type="text" class="form-control" name="vPDC" id="vPDC" onchange="sumar('#vReyes','#vPDC','#vAmbosPDC','#vTotalPDC')"  value="0" required>
                       </div>
                   </div>
                   <div class="col-md-3">
                    {{-- votos Bandera  FMLN --}}
                    <div class="form-group">
                       <label for="vAmbosPDC">Ambos
                       </label>
                       <input type="text" class="form-control" name="vAmbosPDC" id="vAmbosPDC" onchange="sumar('#vReyes','#vPDC','#vAmbosPDC','#vTotalPDC')"  value="0" required>
                   </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  FMLN --}}
                        <div class="form-group">
                           <label for="vTotalPDC">Total 
                           </label>
                           <input type="text" class="form-control" name="vTotalPDC" id="vTotalPDC" disabled>
                       </div>
                    </div>
                   
                  
                </div>
                {{-- CD --}}
                <div class="row">
                    <div class="col-md-3">
                         {{-- votos Rostros Margarita --}}
                         <div class="form-group">
                            <label for="vGeovanni">Votos Geovanni Flores
                            </label>
                            <input type="text" class="form-control" name="vGeovanni" id="vGeovanni" onchange="sumar('#vGeovanni','#vCD','#vAmbosCD','#vTotalCD')"  value="0" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Bandera  CD --}}
                        <div class="form-group">
                           <label for="vCD">Votos CD
                           </label>
                           <input type="text" class="form-control" name="vCD" id="vCD" onchange="sumar('#vGeovanni','#vCD','#vAmbosCD','#vTotalCD')" value="0"  required>
                       </div>
                   </div>
                   <div class="col-md-3">
                    {{-- votos ambos  CD --}}
                    <div class="form-group">
                       <label for="vAmbosCD">Ambos
                       </label>
                       <input type="text" class="form-control" name="vAmbosCD" id="vAmbosCD" onchange="sumar('#vGeovanni','#vCD','#vAmbosCD','#vTotalCD')" value="0" required>
                   </div>
                    </div>
                    <div class="col-md-3">
                        {{-- votos Total  CD --}}
                        <div class="form-group">
                           <label for="vTotalCD">Total 
                           </label>
                           <input type="text" class="form-control" name="vTotalCD" id="vTotalCD" disabled>
                       </div>
                    </div>
                  
                </div>
               {{-- ARENA --}}
               <div class="row">
                <div class="col-md-3">
                     {{-- votos Rostros Margarita --}}
                     <div class="form-group">
                        <label for="vMariaViera">Votos Margarita Viera
                        </label>
                        <input type="text" class="form-control" name="vMariaViera" id="vMariaViera" onchange="sumar('#vMariaViera','#vArena','#vAmbosArena','#vTotalArena')" value="0"  required>
                    </div>
                </div>
                <div class="col-md-3">
                    {{-- votos Bandera  ARENA --}}
                    <div class="form-group">
                       <label for="vArena">Votos ARENA
                       </label>
                       <input type="text" class="form-control" name="vArena" id="vArena" onchange="sumar('#vMariaViera','#vArena','#vAmbosArena','#vTotalArena')" value="0"  required>
                   </div>
               </div>
               <div class="col-md-3">
                {{-- votos ambos  CD --}}
                <div class="form-group">
                   <label for="vAmbosArena">Ambos
                   </label>
                   <input type="text" class="form-control" name="vAmbosArena" id="vAmbosArena" onchange="sumar('#vMariaViera','#vArena','#vAmbosArena','#vTotalArena')" value="0"  required>
               </div>
                </div>
                <div class="col-md-3">
                    {{-- votos Total  CD --}}
                    <div class="form-group">
                       <label for="vTotalArena">Total 
                       </label>
                       <input type="text" class="form-control" name="vTotalArena" id="vTotalArena" disabled>
                   </div>
                </div>
              
            </div>

            </div>

    </div>
   
    <button type="submit"  class="btn btn-primary  btn-lg btn-block"><i class="fas fa-vote-yea"></i>  Guardar Conteo de JRV</button>

</form>
    

</div>
@endsection

@section('jsmas')
<script type="text/javascript" src="{{asset('assets/js/filt.js')}}"></script>

@endsection