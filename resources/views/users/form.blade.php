<div class="mb-3">
    <label class="form-label" for="nombres_productos">Nombre</label>
    <input class="form-control" type="text"  value="{{ isset($datauser['name'])?$datauser['name']:'' }}" name="name">
</div>

<div class="mb-3">
    <label class="form-label" for="nombres_productos">Email</label>
    <input class="form-control" type="email"  value="{{ isset($datauser['email'])?$datauser['email']:'' }}" name="email">
</div>

<div class="mb-3">
    <label class="form-label" for="nombres_productos">Password</label>
    <input class="form-control" type="Password"  value="" name="password">
</div>

<div class='mb-3'>
    <label class="form-label"  for="nombres_productos">Tipo de usuario</label>
    <select name="is_admin" class="form-control">
        <option value="">Seleccione</option>
        <option value="1">Administrador</option>
        <option value="0">Cliente</option>
    </select>
</div>


<input type="submit" value="Guardar">
<a href="{{ url('dash/users') }}">Regresar</a>