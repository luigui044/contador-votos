

    <label for="jrv">Número de JRV</label>
            
    <select name="jrv" id="jrv" class="form-control"  required >
        <option value="">seleccione número de JRV</option>
        @foreach ($jrvs as $item)
        <option value="{{$item->junta}}">{{$item->junta}}</option>

        @endforeach
    </select>