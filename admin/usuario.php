<?php
    include('usuario.controller.php');
    include('rol.controller.php');
    $sistema=new Sistema();
    $sistema->verificarRoles('Administrador');
    $usuarios = new Usuario;
    $action = (isset($_GET['action']))?$_GET['action']:'read';
    include("views/header.php");
    switch($action)
    {
        case 'create':
            include('views/usuarios/form.php');
            break;

        case 'save':
            $usuario=$_POST['usuario'];
            $resultado=$usuarios->create($usuario['correo'], $usuario['contrasena']);
            $datos = $usuarios->read();
            include('views/usuarios/index.php');
            break;
        
        case 'delete':
            $id_usuario=$_GET['id_usuario'];
            $resultado=$usuarios->delete($id_usuario);
            $datos = $usuarios->read();
            include('views/usuarios/index.php');
            break;

        case 'show':
            $id_usuario=$_GET['id_usuario']; 
            $datos=$usuarios->readOne($id_usuario);    
            include('views/usuarios/form.php');        
            break;

        case 'update':
            $usuario=$_POST['usuario'];
            $resultado=$usuarios->update($usuario['id_usuario'], $usuario['correo'], $usuario['contrasena']);
            $datos = $usuarios->read();
            include('views/usuarios/index.php');
            break;

        default:
            $datos = $usuarios->read();
            include('views/usuarios/index.php');
    }
    include('views/footer.php');
?>
