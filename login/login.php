<?php
    include('../admin/sistema.controller.php');
    $sistema = new Sistema;
    $action = (isset($_GET['action']))?$_GET['action']:'read';
    include("views/header.php");
    $mensaje='';
    switch($action)
    {   
        case 'logout':
            unset($_SESSION);
            session_destroy();
            $mensaaje='Ha salido des sistema';
            include('views/login.php');
            break;

        case 'forget':
            include('views/forget_pass.php');
            break;    

        case 'send_pass':
            $correo=$_POST['correo'];
            if($sistema->validateEmail($correo))
            {
                $sistema->changePass($correo);
            }
            break;
        
        case 'change_pass':
            $correo=$_GET['correo'];
            $token=$_GET['token'];
            if($sistema->validateToken($correo,$token))
            {
                include('views/change_pass.php');
            }
            else
            {
                header('Location: http://www.gmail.com');
            }
            break;

        case 'save_pass':
            $correo=$_POST['correo'];
            $token=$_POST['token'];
            $contrasena=$_POST['contrasena'];    
            if($sistema->resetPassword($correo, $token, $contrasena))
            {
                $mensaje="La contraseña ha sido modificada exitosamente";
                include('views/login.php');
            } 
            else
            {
                $mensaje="Ha ocurrido un error";
                include('views/login.php');
            }     
            break;

        case 'validate':
            if(isset($_POST['enviar']))
            {
                $correo=$_POST['correo'];
                $contrasena=$_POST['contrasena'];
                if($sistema->validateEmail($correo))
                {
                    if($sistema->validateUser($correo,$contrasena))
                    {
                        $roles=$sistema->getRoles($correo);
                        $permisos=$sistema->getPermisos($correo);
                        $id_usuario=$sistema->getIdUsuario($correo);
                        $_SESSION['validado']=true;
                        $_SESSION['roles']=$roles;
                        $_SESSION['permisos']=$permisos;
                        $_SESSION['correo']=$correo;
                        $_SESSION['id_usuario']=$id_usuario;
                        header('location: ../admin/index.php');
                    }
                    else
                    {
                        $mensaje='Usuario y/o contraseña incorrecto(s)';
                    }
                }
                else
                {
                    echo 'formato correo no valido';
                }
            }
            include('views/login.php');
            break;
        
        default:
            include('views/login.php');
    }
    //include('views/footer.php');
?>