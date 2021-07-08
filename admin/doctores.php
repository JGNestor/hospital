<?php
    include('doctores.controller.php');
    include('usuario.controller.php');
    $sistema=new Sistema();
    $sistema->verificarRoles('Doctor');
    $doctores = new Doctor;
    $usuarios=new Usuario;
    $action = (isset($_GET['action']))?$_GET['action']:'read';
    $tipos=$usuarios->read(); 
    include("views/header.php");
    switch($action)
    {
        case 'create':
            include('views/doctores/form.php');
            break;

        case 'save':
            $doctor=$_POST['doctor'];
            $resultado=$doctores->create($doctor['nombre'], $doctor['apaterno'], $doctor['amaterno'], $doctor['especialidad'], $doctor['id_usuario']);
            $datos = $doctores->read();
            include('views/doctores/index.php');
            break;
        
        case 'delete':
            $id_doctor=$_GET['id_doctor'];
            $resultado=$doctores->delete($id_doctor);
            $datos = $doctores->read();
            include('views/doctores/index.php');
            break;

        case 'show':
            $id_doctor=$_GET['id_doctor']; 
            $datos=$doctores->readOne($id_doctor);    
            include('views/doctores/form.php');        
            break;

        case 'update':
            $doctor=$_POST['doctor'];
            $resultado=$doctores->update($doctor['id_doctor'], $doctor['nombre'], $doctor['apaterno'], $doctor['amaterno'], $doctor['especialidad'], $doctor['id_usuario']);
            $datos = $doctores->read();
            include('views/doctores/index.php');
            break;

        default:
            $datos = $doctores->read();
            include('views/doctores/index.php');
    }
    include('views/footer.php');
?>
