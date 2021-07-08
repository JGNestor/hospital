<h1>Relacion de roles y permisos</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="rol_permiso.php?action=create" class="btn btn-success">Nueva relacion</a>
<table class="table">
    <thead>
        <tr>
            <th scope='col'>Rol</th>
            <th scope='col'>Permiso</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $relacion): ?>
        <tr>
            <td><?=$relacion['rol']?></td>
            <td><?=$relacion['permiso']?></td>
            <td>
                <a href="rol_permiso.php?action=show&id_rol=<?=$relacion['id_rol']?>&id_permiso=<?=$relacion['id_permiso']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                <!--<button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>-->
            </td>
            <td>
                <a href="rol_permiso.php?action=delete&id_rol=<?=$relacion['id_rol']?>&id_permiso=<?=$relacion['id_permiso']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>