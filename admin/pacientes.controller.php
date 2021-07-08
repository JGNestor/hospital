<?php
    require_once('sistema.controller.php');  //incluir codigo de otro archivo
    
    /*
        Clase principal de pacientes
    */
    class Paciente extends Sistema
    {
        var $id_paciente;
        var $nombre;
        var $apaterno;
        var $amaterno;
        var $nacimiento;
        var $domicilio;
        var $fotografia;

        function setId_paciente($id){
            $this->id_paciente=$id;
        }

        function getId_paciente(){
            return $this->id_paciente;
        }

        function setNombre($nom){
            $this->nombre=$nom;
        }

        function getNombre(){
            return $this->nombre;
        }

        function setPaterno($paterno){
            $this->apaterno=$paterno;
        }

        function getPaterno(){
            return $this->apaterno;
        }

        function setMaterno($materno){
            $this->amaterno=$materno;
        }

        function getMaterno(){
            return $this->amaterno;
        }

        function setNacimiento($nac){
            $this->nacimiento=$nac;
        }

        function getNacimiento(){
            return $this->nacimiento;
        }

        function setDomicilio($dom){
            $this->domicilio=$dom;
        }

        function getDomicilio(){
            return $this->domicilio;
        }

        function setFotografia($foto){
            $this->forografia=$foto;
        }

        function getFotografia(){
            return $this->forografia;
        }

        
        /*
            Metodo para crear un paciente
            Params String @nombre recibe el nombre del paciente
                   String @apaterno recibe el apellido paterno del paciente
                   String @materno recibe el apellido materno del paciente
                   Date @nacimiento recibe la fecha de nacimiento del paciente
                   String @domicilio recibe el domicilio del paciente
            Returns Integer con la cantidad de registros aceptados
        */
        function create($nombre, $apaterno, $amaterno, $nacimiento, $domicilio, $correo)
        {
            $dbh = $this->connect();
            $dbh->beginTransaction();
            try
            {
                $foto=$this->guardarFotografia();
                $sentencia="INSERT INTO usuario(correo, contrasena) VALUES(:correo, :contrasena)";
                $stmt=$dbh->prepare($sentencia);
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $contrasena=md5(rand(1,100));
                $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
                $resultado = $stmt->execute(); 
                $sentencia="SELECT * FROM usuario WHERE correo=:correo";
                $stmt=$dbh->prepare($sentencia);
                $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
                $resultado = $stmt->execute(); 
                $fila=$stmt->fetchAll();
                $id_usuario=$fila[0]['id_usuario'];
                if(is_numeric($id_usuario))
                {
                    $sentencia="INSERT INTO usuario_rol(id_usuario, id_rol) VALUES(:id_usuario, 3)";
                    $stmt=$dbh->prepare($sentencia);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $resultado = $stmt->execute(); 
                    $id_doctor = $this->getIdDoctor($_SESSION['id_usuario']);
                    if($foto)
                    {
                        $sentencia = "INSERT INTO paciente(nombre,apaterno,amaterno,nacimiento,domicilio,fotografia,id_usuario,id_doctor) 
                                    VALUES(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio, :fotografia, :id_usuario, :id_doctor)"; 
                        $stmt = $dbh->prepare($sentencia);    
                        $stmt->bindParam(':fotografia', $foto, PDO::PARAM_STR);
                        //$stmt->bindParam(':fotografia', $_FILES['fotografia']['name'], PDO::PARAM_STR);
                    }  
                    else
                    {
                        $sentencia = "INSERT INTO paciente(nombre,apaterno,amaterno,nacimiento,domicilio,id_usuario,id_doctor) 
                                    VALUES(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio, :id_usuario, :id_doctor)"; 
                        $stmt = $dbh->prepare($sentencia);   
                    }     
                    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                    $stmt->bindParam(':apaterno', $apaterno, PDO::PARAM_STR);
                    $stmt->bindParam(':amaterno', $amaterno, PDO::PARAM_STR);
                    $stmt->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
                    $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR);
                    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
                    $resultado = $stmt->execute();  
                    $dbh->commit();
                    return $resultado;      
                }
            }
            catch(Exception $e)
            {
                echo 'Excepción capturada: ', $e->getMessage(), "\n";
                $dbh->rollBack();
            }
            $dbh->rollBack();
        }

        /*
            Metodo para guardar la fotografia de un paciente
            Returns boolean
        */
        function guardarFotografia(){ 
            $archivo=$_FILES['fotografia'];
            $tipos = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg');
            if($archivo['error']==0)
            {
                if(in_array($archivo['type'],$tipos))
                {
                    if($archivo['size']<=2097152)
                    {
                        $a=explode('/',$archivo['type']);
                        $nuevo_nombre=md5(time()).'.'.$a[1];
                        if(move_uploaded_file($archivo['tmp_name'],'files/'.$nuevo_nombre))
                        {
                            return $nuevo_nombre;
                        }
                    }
                }
            }
            return false;
        }

        /*
            Metodo para obtener todos los pacientes
            Returns array
        */
        function read($my=false)
        {
            $dbh = $this->connect();
            if($my)
            {
                $id_doctor=$this->getIdDoctor($_SESSION['id_usuario']);
                $sentencia="SELECT * FROM paciente WHERE id_doctor = :id_doctor"; 
                $stmt = $dbh->prepare($sentencia); 
                $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
            }
            else
            {
                $sentencia="SELECT * FROM paciente";
                $stmt = $dbh->prepare($sentencia); 
            }
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        /*
            Metodo para obtener un solo paciente
            Params Int @id_paciente que es el id del pasiente
            Returns array
        */
        function readOne($id_paciente)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM paciente WHERE id_paciente=:id_paciente";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            //$rows[0]['edad'] = $this->calcularEdad($rows[0]['nacimiento']);
            return $filas;
        }

        /*
            Metodo para actualizar un paciente
            Params Int @id_paciente que es el id del paciente
                   String @nombre recibe el nombre del paciente
                   String @apaterno recibe el apellido paterno del paciente
                   String @materno recibe el apellido materno del paciente
                   Date @nacimiento recibe la fecha de nacimiento del paciente
                   String @domicilio recibe el domicilio del paciente
            Returns Integer con la cantidad de registros modificados
        */
        function update($id_paciente, $nombre, $apaterno, $amaterno, $nacimiento, $domicilio)
        {
            $dbh = $this->connect();
            $foto=$this->guardarFotografia();
            if($foto)
            {
                $sentencia = "UPDATE paciente SET nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, nacimiento=:nacimiento, domicilio=:domicilio, fotografia=:fotografia WHERE id_paciente=:id_paciente"; 
                $stmt = $dbh->prepare($sentencia); 
                $stmt->bindParam(':fotografia', $foto, PDO::PARAM_STR);
            }
            else
            {
                $sentencia = "UPDATE paciente SET nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, nacimiento=:nacimiento, domicilio=:domicilio WHERE id_paciente=:id_paciente"; 
                $stmt = $dbh->prepare($sentencia); 
            }
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);   
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno', $apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno', $amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        /*
            Metodo para borrar un solo paciente
            Params Int @id_paciente que es el id del pasiente
            Returns Integer con la cantidad de registros eliminados
        */
        function delete($id_paciente)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM paciente WHERE id_paciente=:id_paciente"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_paciente', $id_paciente, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
?>