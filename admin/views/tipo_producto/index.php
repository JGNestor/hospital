<h1>Tipos de productos</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="tipo_producto.php?action=create" class="btn btn-success">Nuevo tipo producto</a>
<table class="table">
    <thead>
        <tr>
            <th scope='col'>No. producto</th>
            <th scope='col'>Tipo de producto</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $producto): ?>
        <tr>
            <td><?=$producto['id_tipo_producto']?></td>
            <td><?=$producto['tipo_producto']?></td>
            <td>
                <a href="tipo_producto.php?action=show&id_tipo_producto=<?=$producto['id_tipo_producto']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
                <!--<button type="button" class="btn btn-primary"><i class="fa fa-edit"></i></button>-->
            </td>
            <td>
                <a href="tipo_producto.php?action=delete&id_tipo_producto=<?=$producto['id_tipo_producto']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>