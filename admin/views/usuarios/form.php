<?php echo(isset($datos))?"<h1>Modificar usuario</h1>":"<h1>Nuevo usuario</h1>"; ?>
<?php if(isset($datos[0]['fotografia'])): ?>
    <img src="files/<?php echo($datos[0]['fotografia']) ?>" class="rounded-circle" width="200">
<?php endif; ?>
<form action="usuario.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-4">
        <label>correo</label>
        <input type="text" name="usuario[correo]" value="<?php echo(isset($datos[0]['correo']))?$datos[0]['correo']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Contraseña</label>
        <input type="text" name="usuario[contrasena]" value="<?php echo(isset($datos[0]['contrasena']))?$datos[0]['contrasena']:''; ?>" class="form-control" rows="1" disabled>
    </div>
    <div class="mb-4">
        <input type="hidden" name="usuario[id_usuario]" value="<?php echo(isset($datos[0]['id_usuario']))?$datos[0]['id_usuario']:''; ?>" >
        <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
    </div>
</form>