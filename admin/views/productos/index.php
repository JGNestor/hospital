<h1>Productos</h1>
<?php if(isset($resultado)): ?>
<div class="alert alert-info" role="alert">
    <?=$resultado; ?>
</div>
<?php endif; ?>
<a href="producto.php?action=create" class="btn btn-success">Nuevo producto</a>
<div class="d-flex flex-row-reverse">
    <form action="producto.php" class="form-check form-check-inline" method="GET">
        <input type="text" class="form-check-control" name='busqueda'>
        <input type="submit" name="buscar" class="btn btn-primary mb-2" value="Buscar">
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th scope='col'>No. producto</th>
            <th scope='col'>Producto</th>
            <th scope='col'>Precio</th>
            <th scope='col'>Tipo producto</th>
            <th scope='col'>Modificar</th>
            <th scope='col'>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos as $key => $producto): ?>
        <tr>
            <td><?=$producto['id_producto']?></td>
            <td><?=$producto['producto']?></td>
            <td><?=$producto['precio']?></td>
            <td><?=$producto['tipo_producto']?></td>
            <td>
                <a href="producto.php?action=show&id_producto=<?=$producto['id_producto']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>  
            </td>
            <td>
                <a href="producto.php?action=delete&id_producto=<?=$producto['id_producto']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>  
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">       
            <!--<li class="page-item"><a class="page-link" href="#">Anterior</a></li>-->
            <?php for($i=0, $j=1; $i<$productos->total(); $i=$i+5, $j++):?>
            <li class="page-item"><a class="page-link" href="producto.php?<?php echo (isset($_GET['busqueda']))?'busqueda='.$_GET['busqueda'].'&':'';?>&desde=<?php echo($i); ?>&limite=5"><?php echo($j); ?></a></li>
            <?php endfor;?>
           <!-- <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>-->
        </ul>
    </nav>
</div>

<?php 
    echo"Filtrando ".count($datos)." de ".$productos->total()." productos";
?>