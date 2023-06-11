@if( isset($listInventory) )
<div class="mb-3">
    <select name="id_productos" id="id_productos" require>
        
        @for($i =0; $i< count($ListProduct);$i++)
            @if(  $ListProduct[$i]['id_productos'] == $listInventory['id_productos'] )
                <option value="{{ $ListProduct[$i]['id_productos'] }}" selected="selected">{{$ListProduct[$i]['nombres_productos']}}</option>
            @else

                <option value="{{ $ListProduct[$i]['id_productos'] }}">{{$ListProduct[$i]['nombres_productos']}}</option>

            @endif
        @endfor
    </select>
</div>
@else
<div class="mb-3">
    <label class="form-label" for="cantidad">Producto</label>
    <select name="id_productos" id="id_productos">
        <option value="">Seleccione....</option>

        @foreach($ListProducts as $Product)
            <option value="{{ $Product->id_productos }}">{{ $Product->nombres_productos }}</option>
        @endforeach

    </select>
</div>
@endif



<div class="mb-3">
    <label class="form-label" for="fecha_vencimiento">Fecha vencimiento</label>
    <input class="form-control" type="date"  value="{{ isset($listInventory['fecha_vencimiento'])?$listInventory['fecha_vencimiento']:'' }}" name="fecha_vencimiento">
</div>

<div class="mb-3">
    <label class="form-label" for="talla">Talla</label>
    <input class="form-control" type="text" value="{{ isset($listInventory['talla'] )?$listInventory['talle'] :'' }}" name="talla" >
</div>

<div class="mb-3">
    <label class="form-label" for="peso">Peso</label>
    <input class="form-control" type="number" value="{{ isset($listInventory['peso'])?$listInventory['peso']:'' }}" name="peso" >
</div>

<div class="mb-3">
    <label class="form-label" for="marca">Marca</label>
    <input class="form-control" type="text" value="{{ isset($listInventory['marca'])?$listInventory['marca']:'' }}" name="marca" >
</div>

<div class="mb-3">
    <label class="form-label" for="color">Color</label>
    <input class="form-control" type="text" value="{{ isset($listInventory['color'])?$listInventory['color']:'' }}" name="color" >
</div>

<div class="mb-3">
    <label class="form-label" for="lote">Lote</label>
    <input class="form-control" type="text" value="{{ isset($listInventory['lote'])?$listInventory['lote']:'' }}" name="lote" >
</div>

<div class="mb-3">
    <label class="form-label" for="cantidad">Cantidad</label>
    <input class="form-control" type="number" value="{{ isset($listInventory['cantidad_stock'])?$listInventory['cantidad_stock']:'' }}" name="cantidad_stock" >
</div>

@if( isset($listInventory) )
<div class="mb-3">
    <select name="id_estado" id="id_estado">
        @for($i=0;$i < count($ListState);$i++)
            @if( $ListState[$i]['id_estados'] == $listInventory['id_estado'] )
                <option value="{{ $ListState[$i]['id_estados'] }}"  selected='selected'>{{ $ListState[$i]['nombre_esta'] }}</option>
            @else
                <option value="{{ $ListState[$i]['id_estados'] }}">{{ $ListState[$i]['nombre_esta'] }}</option>
            @endif
        @endfor
    </select>

</div>
@else

<div class="mb-3">
    <label class="form-label" for="cantidad">Estado</label>
    <select name="id_estado" id="id_estado">
        <option value="">Seleccione....</option>

        @foreach($ListState as $State)
            <option value="{{ $State->id_estados }}">{{ $State->nombre_esta }}</option>
        @endforeach

    </select>
</div>


@endif

<input type="submit" value="Guardar" class="btn btn-primary">
<a href="{{ url('dash/inventario') }}" class="btn btn-secondary">Regresar</a>