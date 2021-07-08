<h1>Usuarios</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="usuario.php?action=create" class="btn btn-success">Nuevo usuario</a>
<table class="table">
    <thead>
        <tr>
            <th scope='col'>No. usuario</th>
            <th scope='col'>Correo</th>
            <th scope='col'>Contraseña</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $usuario): ?>
        <tr>
            <td><?=$usuario['id_usuario']?></td>
            <td><?=$usuario['correo']?></td>
            <td><?=$usuario['contrasena']?></td>
            <td>
                <a href="usuario.php?action=show&id_usuario=<?=$usuario['id_usuario']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                <!--<button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>-->
            </td>
            <td>
                <a href="usuario.php?action=delete&id_usuario=<?=$usuario['id_usuario']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>