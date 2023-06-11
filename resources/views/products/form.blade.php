<div class="mb-3">
    <label class="form-label" for="nombres_productos">Nombre producto</label>
    <input class="form-control" type="text"  value="{{ isset($productos['nombres_productos'])?$productos['nombres_productos']:'' }}" name="nombres_productos">
</div>

<div class="mb-3">
    <label class="form-label" for="descripcion">Descripción producto</label>
    <input class="form-control" type="text" value="{{ isset($productos['descripcion'] )?$productos['descripcion'] :'' }}" name="descripcion" >
</div>


<div class="mb-3">
    <label class="form-label" for="valor">Valor</label>
    <input class="form-control" type="text" value="{{ isset($productos['valor'])?$productos['valor']:'' }}" name="valor" >
</div>

<div class="mb-3">
    @if( isset($categorias) )
        <select name="id_categorias" id="id_categorias">
            @for($i =0; $i< count($categorias);$i++)
                @if(  $categorias[$i]['id_categorias'] == $productos['id_categorias'] )
                    <option value="{{ $categorias[$i]['id_categorias'] }}" selected="selected">{{$categorias[$i]['nombre_catego']}}</option>
                @else
                    <option value="{{ $categorias[$i]['id_categorias'] }}">{{$categorias[$i]['nombre_catego']}}</option>

                @endif
            @endfor
        </select>
    @else
        <label class="form-label" for="id_categorias">Categoria</label>
        <select name="id_categorias" id="id_categorias">
            <option value="" required>Seleccione...</option>
            @foreach($ListCategoria as $categoria)
                <option value="{{ $categoria->id_categorias }}"> {{ $categoria->nombre_catego }} </option>
            @endforeach
        </select>
    @endif
</div>

<div class="mb-3">
    <label class="form-label" for="imagen">Imagen producto</label>
    <input class="form-control" type="file" name="imagen" >    
</div>

<input type="submit" value="Guardar" class="btn btn-primary">
<a href="{{ url('dash/productos') }}" class="btn btn-secondary">Regresar</a>