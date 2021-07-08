<?php echo(isset($datos))?"<h1>Modificar rol</h1>":"<h1>Nuevo rol</h1>"; ?>
<form action="rol.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST">
    <div class="mb-4">
        <label>Tipo rol</label>
        <input type="text" name="rol[rol]" value="<?php echo(isset($datos[0]['rol']))?$datos[0]['rol']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <input type="hidden" name="rol[id_rol]" value="<?php echo(isset($datos[0]['id_rol']))?$datos[0]['id_rol']:''; ?>" >
        <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
    </div>
</form>