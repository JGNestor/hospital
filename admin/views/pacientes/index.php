<h1>Pacientes</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="pacientes.php?action=create" class="btn btn-success">Nuevo paciente</a>
<a href="pacientes.report.php?action=create" target="_blank" class="btn btn-dark">Reporte pacientes</a>
<table class="table">
    <thead>
        <tr>
            <th scope='col'>No. paciente</th>
            <th scope='col'>Fotografia</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Apellido Paterno</th>
            <th scope='col'>Apellido Materno</th>
            <th scope='col'>Fecha Nacimiento</th>
            <th scope='col'>Domiciilo</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Historial</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $paciente): ?>
        <tr>
            <td><?=$paciente['id_paciente']?></td>
            <td><img src="files/<?php echo(isset($paciente['fotografia'])?$paciente['fotografia']:'default.webp'); ?>" class="rounded-circle" width="60"></td>
            <td><?=$paciente['nombre']?></td>
            <td><?=$paciente['apaterno']?></td>
            <td><?=$paciente['amaterno']?></td>
            <td><?=$paciente['nacimiento']?></td>
            <td><?=$paciente['domicilio']?></td>
            <td>
                <a href="pacientes.php?action=show&id_paciente=<?=$paciente['id_paciente']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                <!--<button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>-->
            </td>
            <td>
                <a href="pacientes.php?action=consulta&id_paciente=<?=$paciente['id_paciente']?>" class="btn btn-info"><i class="fa fa-history"></i></a>
            </td>
            <td>
                <a href="pacientes.php?action=delete&id_paciente=<?=$paciente['id_paciente']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>