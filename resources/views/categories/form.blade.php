<div class="mb-3">
    <label for="nombre_catego" class="form-label">Nombre categoria</label>
    <input type="text" class="form-control" name='nombre_catego' id="nombre_catego"
    value="{{ isset($categories['nombre_catego'])?$categories['nombre_catego']:'' }}">
</div>
<input type="submit" value="Guardar"class="btn btn-primary">
<a class="btn btn-secondary" href="{{ url('dash/categorias') }}" >regresar</a>