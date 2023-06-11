
<div class="mb-1">
    <label class="form-label" for="names">Nombres</label>
    <input class="form-control" type="text"  value="{{ isset($profile['Nombres'])?$profile['Nombres']:'' }}" name="Nombres">
</div>

<div class="mb-1">
    <label class="form-label" for="last_name">Apellidos</label>
    <input class="form-control" type="text"  value="{{ isset($profile['apellidos'])?$profile['apellidos']:'' }}" name="apellidos">
</div>

<div class="mb-1">
    <label class="form-label" for="last_name">Dirección</label>
    <input class="form-control" type="text"  value="{{ isset($profile['direccion'])?$profile['direccion']:'' }}" name="direccion">
</div>

<div class="mb-1">
    <label class="form-label" for="last_name">Celular / Telefono</label>
    <input class="form-control" type="text"  value="{{ isset($profile['telefono'])?$profile['telefono']:'' }}" name="telefono">
</div>

<div class="mb-1">
    <label class="form-label" for="last_name">Cedula</label>
    <input class="form-control" type="text"  value="{{ isset($profile['telefono'])?$profile['telefono']:'' }}" name="cedula">
</div>

<div class="mb-2">
    <label class="form-label" for="last_name">Tipo de documento</label>
    <select class="form-control" name="tipo_documento" id="tipo_documento">
        <option value="">Seleccione...</option>
        <option value="CC">Cedula ciudadania</option>
        <option value="CE">Cedula extrajeria</option>
    </select>
</div>

<input class="btn btn-primary" type="submit" value="Guardar">