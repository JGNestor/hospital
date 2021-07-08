<h1>Doctores</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="doctores.php?action=create" class="btn btn-success">Nuevo doctor</a>
<table class="table">
    <thead>
        <tr>
            <th scope='col'>No. doctor</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Apellido Paterno</th>
            <th scope='col'>Apellido Materno</th>
            <th scope='col'>Especialidad</th>
            <th scope='col'>Usuario</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $doctor): ?>
        <tr>
            <td><?=$doctor['id_doctor']?></td>
            <td><?=$doctor['nombre']?></td>
            <td><?=$doctor['apaterno']?></td>
            <td><?=$doctor['amaterno']?></td>
            <td><?=$doctor['especialidad']?></td>
            <td><?=$doctor['correo']?></td>
            <td>
                <a href="doctores.php?action=show&id_doctor=<?=$doctor['id_doctor']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
            </td>
            <td>
                <a href="doctores.php?action=delete&id_doctor=<?=$doctor['id_doctor']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>