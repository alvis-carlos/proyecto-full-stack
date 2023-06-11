<select name="id_tipo_estado" id="id_tipo_estado">
    <option value="" require>Seleccione una opcion</option>
    @foreach( $tipo_estados as $tipo_estado )
        <option value="{{$tipo_estado->id_tipo_estado}}">{{$tipo_estado->nombre_tip_esta}}</option>
    @endforeach 
    
</select>