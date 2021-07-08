<?php
    include('rol_permiso.controller.php');
    include('rol.controller.php');
    include('permiso.controller.php');
    $sistema=new Sistema();
    $sistema->verificarRoles('Administrador');
    $relaciones = new RolPermiso;
    $tipo_rol=new Roles;
    $tipo_permiso=new Permisos;
    $action = (isset($_GET['action']))?$_GET['action']:'read';
    $tipos1=$tipo_rol->read(); 
    $tipos2=$tipo_permiso->read(); 
    include("views/header.php");
    switch($action)
    {
        case 'create':
            include('views/rol_permiso/form.php');
            break;

        case 'save':
            $relacion=$_POST['relacion'];
            $resultado=$relaciones->create($relacion['id_rol'],$relacion['id_permiso']);
            print_r($_POST);
            $datos = $relaciones->read();
            include('views/rol_permiso/index.php');
            break;
        
        case 'delete':
            $id_rol=$_GET['id_rol'];
            $id_permiso=$_GET['id_permiso'];
            $resultado=$relaciones->delete($id_rol,$id_permiso);
            $datos = $relaciones->read();
            include('views/rol_permiso/index.php');
            break;

        case 'show':
            $id_rol=$_GET['id_rol'];
            $id_permiso=$_GET['id_permiso'];
            $datos=$relaciones->readOne($id_rol,$id_permiso);    
            include('views/rol_permiso/form.php');        
            break;

        case 'update':
            $relacion=$_POST['relacion'];
            $resultado=$relaciones->update($relacion['rol'], $relacion['permiso']);
            $datos = $relaciones->read();
            include('views/rol_permiso/index.php');
            break;

        default:
            $datos = $relaciones->read();
            include('views/rol_permiso/index.php');
    }
    include('views/footer.php');
?>