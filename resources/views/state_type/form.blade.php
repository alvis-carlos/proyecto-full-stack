<div class="mb-3">
    <label class="form-label" for="nombres_productos">Nombre tipo estado</label>
    <input class="form-control" type="text"  value="{{ isset($tipoestado['nombre_tip_esta'])?$tipoestado['nombre_tip_esta']:'' }}" name="nombre_tip_esta">
</div>

<input type="submit" value="Guardar" class="btn btn-primary">
<a href="{{ url('dash/TipoEstado') }}" class="btn btn-secondary">Regresar</a>