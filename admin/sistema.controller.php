<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    require_once'../vendor/autoload.php';
    class Sistema
    {
        var $dsn='mysql:host=localhost;dbname=hospital';
        var $user='hospital';
        var $pass='hospital123';

        function connect()
        {
            $dbh = new PDO($this->dsn, $this->user, $this->pass);
            return $dbh;
        }   
        
        function validateUser($correo, $contrasena)
        {
            $contrasena = md5($contrasena);
            $dbh = $this->connect();
            $sentencia = "SELECT * FROM usuario WHERE correo=:correo AND contrasena=:contrasena"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $stmt->execute();
            $fila = $stmt->fetchAll();
            return isset($fila[0]['correo'])?true:false;
        }

        function validateToken($correo, $token)
        {
            $dbh = $this->connect();
            if(!is_null($token))
            {
                $sentencia = "SELECT * FROM usuario WHERE correo=:correo AND token=:token"; 
                $stmt = $dbh->prepare($sentencia);    
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->execute();
                $fila = $stmt->fetchAll();
                return isset($fila[0]['correo'])?true:false;
            }
            else
            {
                return false;
            }
           
        }

        function validateEmail($correo)
        {
            return (false !== filter_var($correo, FILTER_VALIDATE_EMAIL));
        }

        /*
            Metodo para obtener los roles asignados a un correo electronico
        */
        function getRoles($correo)
        {
            $dbh = $this->connect();
            $sentencia = "SELECT r.id_rol, r.rol FROM usuario u 
                            JOIN usuario_rol ur ON u.id_usuario=ur.id_usuario 
                            JOIN rol r ON ur.id_rol=r.id_rol 
                            WHERE u.correo=:correo"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $roles=array();
            foreach($fila as $key => $value)
            {
                array_push($roles, $value['rol']);
            }   
            return $roles;       
        }

         /*
            Metodo para obtener los permisos asignados a un correo electronico
        */
        function getPermisos($correo)
        {
            $dbh = $this->connect();
            $sentencia = "SELECT p.id_permiso, p.permiso FROM usuario u 
                            JOIN usuario_rol ur ON u.id_usuario=ur.id_usuario 
                            JOIN rol r ON ur.id_rol=r.id_rol 
                            JOIN rol_permiso rp ON r.id_rol=rp.id_rol
                            JOIN permiso p ON rp.id_permiso=p.id_permiso
                            WHERE u.correo=:correo"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $permisos=array();
            foreach($fila as $key => $value)
            {
                array_push($permisos, $value['permiso']);
            }   
            return $permisos;     
        }

        //Enruta al usuario al login en caso de no contar con el rol necesario
        function verificarRoles($rol)
        {
            $this->verificarSesion();
            $roles=$_SESSION['roles'];
            if(!in_array($rol, $roles))
            {
                $mensaje='No cuenta con el rol adecuado';
                include('views/header.php');
                include('../login/views/login.php');
                include('views/footer.php');
                die();
            }
        }

        //Revisa si se tienen o no roles
        function validarRoles($rol)
        {
            $this->verificarSesion();
            $roles=$_SESSION['roles'];
            if(in_array($rol, $roles))
            {
                return true;
            }
            return false;
        }

        //Revisa si se tienen o no permisos
        function validarPermisos($permiso)
        {
            $this->verificarSesion();
            $permisos=$_SESSION['permisos'];
            if(in_array($permiso, $permisos))
            {
                return true;
            }
            return false;
        }

        //revisa si hay logueo
        function verificarSesion()
        {
            if(!isset($_SESSION['validado']))
            {
                $mensaje='Inicio de sesión requerido';
                include('views/header.php');
                include('../login/views/login.php');
                include('views/footer.php');    
                die();
            }
            return false;
        }

        function getIdDoctor($id_usuario)
        {   
            $dbh = $this->connect();
            $sentencia = "SELECT id_doctor FROM doctor WHERE id_usuario=:id_usuario"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $dato = $stmt->fetchAll();
            return $dato[0]['id_doctor'];
        }

        function getIdUsuario($correo)
        {
            $dbh = $this->connect();
            $sentencia = "SELECT id_usuario FROM usuario WHERE correo=:correo"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->execute();
            $dato = $stmt->fetchAll();
            if(isset($dato[0]['id_usuario']))
            {
                return $dato[0]['id_usuario'];
            }
            return null;
        }

        function changePass($correo)
        {
            $id_usuario=$this->getIdUsuario($correo);
            if(!is_null($id_usuario));
            {
                //$token=substr(md5(rand(1,10))1,10);
                $token=substr(crypt(sha1(hash('sha512',md5(rand(1,9999)).$id_usuario)), 'Cruzazul campeon'),1,10);
                $dbh = $this->connect();
                $sentencia = "UPDATE usuario SET token=:token WHERE id_usuario=:id_usuario"; 
                $stmt = $dbh->prepare($sentencia);    
                $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
                $mensaje='Se ha enviado un correo electrónico a su cuenta';
                require '../vendor/autoload.php';
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->Username = '16030657@itcelaya.edu.mx';
                $mail->Password = '';
                $mail->setFrom('16030657@itcelaya.edu.mx', 'Nestor Daniel Juarez');
                $mail->addReplyTo('16030657@itcelaya.edu.mx', 'Nestor Daniel Juarez');
                $mail->addAddress($correo, $correo);
                $mail->Subject = 'Recuperación de contraseña del hospital';
                $cuerpo="Estimado usuario por favor haga clic en el siguiente enlace para recuperar su contraseña:<br><a href='https://localhost/hospital/login/login.php?action=change_pass&correo=".$correo."&token=".$token."'>Recuperar contraseña</a>";
                $mail->msgHTML($cuerpo);
                $mail->AltBody = 'Mensaje alternativo';
                if (!$mail->send()) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Message sent!';
                }
            }
        }

        function resetPassword($correo, $token, $contrasena)
        {
            if($this->validateEmail($correo))
            {
                if($this->validateToken($correo, $token))
                {
                    $dbh = $this->connect();
                    if(!is_null($token))
                    {
                        $contrasena=md5($contrasena);
                        $sentencia = "UPDATE usuario SET contrasena=:contrasena, token=null where correo=:correo"; 
                        $stmt = $dbh->prepare($sentencia);    
                        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                        $fila = $stmt->execute();
                        if($fila)
                        {
                            return true;
                        }
                        return false;
                    }
                }
            }
            return false;
        }
    }
?>