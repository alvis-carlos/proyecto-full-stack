

<div class="mb-3">
    <label class="form-label" for="nombre_esta" >Nombre estado</label>
    <input class="form-control" type="text" value="{{ isset($listEstato['nombre_esta'])?$listEstato['nombre_esta']:'' }}" name="nombre_esta">
</div>

<div class="mb-3">
@if( isset($listEstato['id_tipo_estado']) )

    <label class="form-label" for="nombre_esta" >Nombre tipo estado</label>
    <select class="form-control" name="id_tipo_estado" id="id_tipo_estado">
    @for($i = 0; $i < count($ListStateType); $i++)

        @if( $ListStateType[$i]['id_tipo_estado'] == $listEstato['id_tipo_estado'] )
            <option value="{{ $ListStateType[$i]['id_tipo_estado'] }}" selected="selected">{{ $ListStateType[$i]['nombre_tip_esta'] }}</option>
        @else
            <option value="{{ $ListStateType[$i]['id_tipo_estado'] }}">{{ $ListStateType[$i]['nombre_tip_esta'] }}</option>
        @endif

    @endfor

    </select>
@else

</div>

<div class="mb-3">
    <label class="form-label" for="nombres_productos">Nombre tipo estado</label>
    <select name="id_tipo_estado" id="id_tipo_estado">
        <option value="">Seleccionar...</option>
        @foreach($ListStateType  as $StateType)
            <option value="{{ $StateType->id_tipo_estado }}">{{ $StateType->nombre_tip_esta }}</option>
        @endforeach
    </select>
</div>


@endif
<br>
<input type="submit" value="Guardar" class="btn btn-primary">
<a href="{{ url('dash/estados') }}" class="btn btn-secondary">Regresar</a>
