<?php echo(isset($datos))?"<h1>Modificar permiso</h1>":"<h1>Nuevo permiso</h1>"; ?>
<form action="permiso.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST">
    <div class="mb-4">
        <label>Tipo permiso</label>
        <input type="text" name="permiso[permiso]" value="<?php echo(isset($datos[0]['permiso']))?$datos[0]['permiso']:''; ?>" class="form-control" rows="1">
    </div>
    <input type="hidden" name="permiso[id_permiso]" value="<?php echo(isset($datos[0]['id_permiso']))?$datos[0]['id_permiso']:''; ?>" >
    <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
</form>