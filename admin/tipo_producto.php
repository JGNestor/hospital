<?php
    include('tipo_producto.controller.php');
    $sistema=new Sistema();
    $sistema->verificarRoles('Administrador');
    $tipo_producto = new TipoProducto;
    $action = (isset($_GET['action']))?$_GET['action']:'read';
    include("views/header.php");
    switch($action)
    {
        case 'create':
            include('views/tipo_producto/form.php');
            break;

        case 'save':
            $producto=$_POST['producto'];
            $resultado=$tipo_producto->create($producto['tipo_producto']);
            $datos = $tipo_producto->read();
            include('views/tipo_producto/index.php');
            break;
        
        case 'delete':
            $id_tipo_producto=$_GET['id_tipo_producto'];
            $resultado=$tipo_producto->delete($id_tipo_producto);
            $datos = $tipo_producto->read();
            include('views/tipo_producto/index.php');
            break;

        case 'show':
            $id_tipo_producto=$_GET['id_tipo_producto'];
            $datos=$tipo_producto->readOne($id_tipo_producto);    
            include('views/tipo_producto/form.php');        
            break;

        case 'update':
            $producto=$_POST['producto'];
            $resultado=$tipo_producto->update($producto['id_tipo_producto'], $producto['tipo_producto']);
            $datos = $tipo_producto->read();
            include('views/tipo_producto/index.php');
            break;

        default:
            $datos = $tipo_producto->read();
            include('views/tipo_producto/index.php');
    }
    include('views/footer.php');
?>