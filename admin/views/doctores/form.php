<?php echo(isset($datos))?"<h1>Modificar doctor</h1>":"<h1>Nuevo doctor</h1>"; ?>
<form action="doctores.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-4">
        <label>Nombre</label>
        <input type="text" name="doctor[nombre]" value="<?php echo(isset($datos[0]['nombre']))?$datos[0]['nombre']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Apellido paterno</label>
        <input type="text" name="doctor[apaterno]" value="<?php echo(isset($datos[0]['apaterno']))?$datos[0]['apaterno']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Apellido materno</label>
        <input type="text" name="doctor[amaterno]" value="<?php echo(isset($datos[0]['amaterno']))?$datos[0]['amaterno']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Especialidad</label>
        <input type="date" name="doctor[especialidad]" value="<?php echo(isset($datos[0]['nacimiento']))?$datos[0]['especialidad']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Usuario</label>
        <select name="doctor[id_usuario]" class="form-control" rows="1">
            <?php 
                foreach($tipos as $key => $tipo): 
                    $selected='';
                    if($tipo[0]['id_usuario']==$datos[0]['id_usuario'])
                    {
                        $selected=' selected';
                    }
            ?>
            <option value="<?php echo($tipo['id_usuario']); ?>" <?php echo($selected); ?>> <?php echo($tipo['correo']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-4">
        <input type="hidden" name="doctor[id_doctor]" value="<?php echo(isset($datos[0]['id_doctor']))?$datos[0]['id_doctor']:''; ?>" >
        <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
    </div>
</form>