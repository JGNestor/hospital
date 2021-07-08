<h1>Permisos</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="permiso.php?action=create" class="btn btn-success">Nuevo permiso</a>
<table class="table">
    <thead>
        <tr>
            <th scope='col'>No. permiso</th>
            <th scope='col'>Tipo de permiso</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $permiso): ?>
        <tr>
        <td><?=$permiso['id_permiso']?></td>
            <td><?=$permiso['permiso']?></td>
            <td>
                <a href="permiso.php?action=show&id_permiso=<?=$permiso['id_permiso']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                <!--<button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>-->
            </td>
            <td>
                <a href="permiso.php?action=delete&id_permiso=<?=$permiso['id_permiso']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>