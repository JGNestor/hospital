<?php echo(isset($datos))?"<h1>Modificar paciente</h1>":"<h1>Nuevo paciente</h1>"; ?>
<?php if(isset($datos[0]['fotografia'])): ?>
    <img src="files/<?php echo($datos[0]['fotografia']) ?>" class="rounded-circle" alt="img_paciente" width="200">
<?php endif; ?>
<form action="pacientes.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-4">
        <label>Nombre</label>
        <input type="text" name="paciente[nombre]" value="<?php echo(isset($datos[0]['nombre']))?$datos[0]['nombre']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Apellido paterno</label>
        <input type="text" name="paciente[apaterno]" value="<?php echo(isset($datos[0]['apaterno']))?$datos[0]['apaterno']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Apellido materno</label>
        <input type="text" name="paciente[amaterno]" value="<?php echo(isset($datos[0]['amaterno']))?$datos[0]['amaterno']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Fecha de nacimiento</label>
        <input type="date" name="paciente[nacimiento]" value="<?php echo(isset($datos[0]['nacimiento']))?$datos[0]['nacimiento']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Dirección</label>
        <input type="text" name="paciente[domicilio]" value="<?php echo(isset($datos[0]['domicilio']))?$datos[0]['domicilio']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
        <input type="email" name="paciente[correo]" value="<?php echo(isset($datos[0]['correo']))?$datos[0]['correo']:''; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-4">
        <label>Fotografia</label>
        <input type="file" name="fotografia" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <input type="hidden" name="paciente[id_paciente]" value="<?php echo(isset($datos[0]['id_paciente']))?$datos[0]['id_paciente']:''; ?>" >
        <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
    </div>
</form>