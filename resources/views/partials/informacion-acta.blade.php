<div class="row p-2">
    <div class="card w-100 my-3">
        <div class="card-body">
            <h3 class="text-center">Información del acta</h3>
        </div>
    </div>

    <div class="card w-100 my-3">
        <div class="card-body">
            <form method="POST" class="border border-light p-4" action="#!" id="frm-acta">
                <div class="form-group">
                    {{-- centro de votación --}}
                    <label for="centro">Centro de votación</label>

                    <select name="centro" id="centro" class="form-control">
                        <option value="">Seleccione centro de votación:</option>
                        @foreach ($centros as $item)
                            <option value="{{ $item->id_centro }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Número JRBV --}}
                <div class="form-group" id="filtrar">
                    <label for="jrv">Número de JRV:</label>
                    <select name="jrv" id="jrv" class="form-control" disabled>
                        <option value="">Seleccione número de JRV</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="junta">Número de junta:</label>
                            <input type="text" id="junta" name="junta" class="form-control"
                                value="{{ $datos['junta'] ?? old('junta') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="sobrantes">Papeletas sobrantes:</label>
                            <input type="text" id="sobrantes" name="sobrantes" class="form-control"
                                value="{{ $datos['sobrantes'] ?? old('sobrantes') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="inutilizadas">Papeletas inutilizadas:</label>
                            <input type="text" id="inutilizadas" name="inutilizadas" class="form-control"
                                value="{{ $datos['inutilizadas'] ?? old('inutilizadas') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="entregadas">Papeletas entregadas a votantes:</label>
                            <input type="text" id="entregadas" name="entregadas_votantes" class="form-control"
                                value="{{ $datos['entregadas a votantes'] ?? old('entregadas_votantes') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="total-papeletas">Total de papeletas:</label>
                            <input type="text" id="total-papeletas" name="total_papeletas" class="form-control"
                                value="{{ $datos['total papeletas'] ?? old('total_papeletas') }}" required>
                        </div>
                    </div>
                </div>
                <hr>
                <h4 class="text-center my-4 text-primary">Total de votos válidos por partido político</h4>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fuerza_solidaria">FUERZA SOLIDARIA:</label>
                            <input type="text" id="fuerza_solidaria" name="fuerza_solidaria" class="form-control"
                                value="{{ $datos['FUERZA SOLIDARIA'] ?? old('fuerza_solidaria') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fmln">FMLN:</label>
                            <input type="text" id="fmln" name="fmln" class="form-control"
                                value="{{ $datos['FMLN'] ?? old('fmln') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="arena">ARENA:</label>
                            <input type="text" id="arena" name="arena" class="form-control"
                                value="{{ $datos['ARENA'] ?? old('arena') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuestro_tiempo">NUESTRO TIEMPO:</label>
                            <input type="text" id="nuestro_tiempo" name="nuestro_tiempo" class="form-control"
                                value="{{ $datos['NUESTRO TIEMPO'] ?? old('nuestro_tiempo') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="fps">FPS:</label>
                            <input type="text" id="fps" name="fps" class="form-control"
                                value="{{ $datos['FPS'] ?? old('fps') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuevas_ideas">NUEVAS IDEAS:</label>
                            <input type="text" id="nuevas_ideas" name="nuevas_ideas" class="form-control"
                                value="{{ $datos['NUEVAS IDEAS'] ?? old('nuevas_ideas') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="total_votos_validos">Total de votos válidos:</label>
                            <input type="text" id="total_votos_validos" name="total_votos_validos"
                                class="form-control"
                                value="{{ $datos['TOTAL VOTOS VALIDOS'] ?? old('total_votos_validos') }}" required>
                        </div>
                    </div>
                </div>
                <hr>
                <h4 class="text-center my-4 text-primary">Otros votos</h4>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="impugnados">IMPUGNADOS:</label>
                            <input type="text" id="impugnados" name="impugnados" class="form-control"
                                value="{{ $datos['IMPUGNADOS'] ?? old('impugnados') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nulos">NULOS:</label>
                            <input type="text" id="nulos" name="nulos" class="form-control"
                                value="{{ $datos['NULOS'] ?? old('nulos') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="abstenciones">ABSTENCIONES:</label>
                            <input type="text" id="abstenciones" name="abstenciones" class="form-control"
                                value="{{ $datos['ABSTENCIONES'] ?? old('abstenciones') }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="faltantes">FALTANTES:</label>
                            <input type="text" id="faltantes" name="faltantes" class="form-control"
                                value="{{ $datos['FALTANTES'] ?? old('faltantes') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="total_otros_votos">Total otros votos:</label>
                            <input type="text" id="total_otros_votos" name="total_otros_votos"
                                class="form-control" value="{{ $datos['TOTAL OTROS VOTOS'] ?? old('total_otros_voto') }}" required>
                        </div>
                    </div>
                </div>
                <hr>
                <h4 class="text-center my-4 text-primary">TOTAL VOTACIÓN:</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="total_votacion">Total:</label>
                            <input type="text" id="total_votacion" name="total_votacion" class="form-control"
                            value="{{ ($datos['TOTAL OTROS VOTOS'] ?? 0) + ($datos['TOTAL VOTOS VALIDOS'] ?? old('total_votacion')) }}"
                                required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
