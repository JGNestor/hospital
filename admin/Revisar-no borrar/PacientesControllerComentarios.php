<?php
    require_once('sistema.controller.php');  //incluir codigo de otro archivo
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

        function create($nombre, $apaterno, $amaterno, $nacimiento, $domicilio)
        {
            $dbh = $this->conect();
            /*$this->setNombre($nombre);
            $this->setPaterno($apaterno);
            $this->setMaterno($amaterno);
            $this->setNacimiento($nacimiento);
            $this->setDomicilio($domicilio);*/
            //$sentencia = ("INSERT INTO paciente(nombre,apaterno,amaterno,nacimiento,domicilio) VALUES('".$this->getNombre()."','".$this->getPaterno()."','".$this->getMaterno()."','".$this->getNacimiento()."','".$this->getDomicilio()."')");    
            //$resultado = $dbh->exec($sentencia);
            $sentencia = "INSERT INTO paciente(nombre,apaterno,amaterno,nacimiento,domicilio) 
                            VALUES(:nombre, :apaterno, :amaterno, :nacimiento, :domicilio)"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno', $apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno', $amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;     
        }

        function read()
        {
            $dbh = $this->conect();
            //$resultado = $dbh->query("SELECT * FROM paciente");
            //$rows = $resultado->fetchAll();
            $sentencia="SELECT * FROM paciente";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function readOne($id)
        {
            $dbh = $this->conect();
            $this->setId_paciente($id);
            /*$resultado = $dbh->query("SELECT * FROM paciente WHERE id_paciente=".$this->getId_paciente());
            $rows = $resultado->fetchAll();*/
            $sentencia="SELECT * FROM paciente WHERE id_paciente=:id_paciente";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_paciente', $id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }

        function update($id, $nombre, $apaterno, $amaterno, $nacimiento, $domicilio)
        {
            $dbh = $this->conect();
            /*$this->setId_paciente($id);
            $this->setNombre($nombre);
            $this->setPaterno($apaterno);
            $this->setMaterno($amaterno);
            $this->setNacimiento($nacimiento);
            $this->setDomicilio($domicilio);*/            
            //$sentencia="UPDATE paciente SET nombre='".$this->getNombre()."',apaterno='".$this->getPaterno()."', amaterno='".$this->getMaterno()."', nacimiento='".$this->getNacimiento()."', domicilio='".$this->getDomicilio()."' WHERE id_paciente=".$this->getId_paciente();
            //$resultado=$dbh->exec($sentencia);
            $sentencia = "UPDATE paciente SET nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, nacimiento=:nacimiento, domicilio=:domicilio WHERE id_paciente=:id_paciente"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_paciente', $id, PDO::PARAM_INT);   
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno', $apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno', $amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
            $stmt->bindParam(':domicilio', $domicilio, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function delete($id)
        {
            $dbh = $this->conect();
            /*$this->setId_paciente($id);
            $resultado = $dbh->exec("DELETE FROM paciente WHERE id_paciente=".$this->getId_paciente());*/
            $sentencia = "DELETE FROM paciente WHERE id_paciente=:id_paciente"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_paciente', $id, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
    
    //$pacientes = new Paciente;
    //$datos = $pacientes->read();
    //print_r($datos); 
    //echo("<br/>");
    //$resultado = $pacientes->update(9,"SSSSSebastiana", "Campos", "Perez", "1999-12-11","calle #1");
    //$resultado = $pacientes->delete(9);
    //echo($resultado);
    //echo("<br/>");
    //$datos = $pacientes->readOne(1);
    //print_r($datos); 
?>