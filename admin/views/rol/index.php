<h1>Roles</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="rol.php?action=create" class="btn btn-success">Nuevo rol</a>
<table class="table">
    <thead>
        <tr>
            <th scope='col'>No. rol</th>
            <th scope='col'>Tipo de rol</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $rol): ?>
        <tr>
            <td><?=$rol['id_rol']?></td>
            <td><?=$rol['rol']?></td>
            <td>
                <a href="rol.php?action=show&id_rol=<?=$rol['id_rol']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                <!--<button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>-->
            </td>
            <td>
                <a href="rol.php?action=delete&id_rol=<?=$rol['id_rol']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>