<?php
    require_once('sistema.controller.php');
    
    /*
        Clase principal de doctores
    */
    class Doctor extends Sistema
    {
        var $id_doctor;
        var $nombre;
        var $apaterno;
        var $amaterno;
        var $especialidad;

        function setId_doctor($id){
            $this->id_doctor=$id;
        }

        function getId_doctor(){
            return $this->id_doctor;
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

        function setEspecialidad($esp){
            $this->especialidad=$esp;
        }

        function getEspecialidad(){
            return $this->especialidad;
        }
    
        function create($nombre, $apaterno, $amaterno, $especialidad, $id_usuario)
        {
            $dbh = $this->connect();            
            $sentencia = "INSERT INTO doctor(nombre, apaterno, amaterno, especialidad, id_usuario) 
                            VALUES(:nombre, :apaterno, :amaterno, :especialidad, :id_usuario)"; 
            $stmt = $dbh->prepare($sentencia);   
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno', $apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno', $amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':especialidad', $especialidad, PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $resultado = $stmt->execute(); 
            return $resultado;      
        }

        function read()
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM doctor d JOIN usuario u USING(id_usuario)";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function readOne($id_doctor)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM doctor WHERE id_doctor=:id_doctor";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function update($id_doctor, $nombre, $apaterno, $amaterno, $especialidad, $id_usuario)
        {
            $dbh = $this->connect();
            $sentencia = "UPDATE doctor SET nombre=:nombre, apaterno=:apaterno, amaterno=:amaterno, especialidad=:especialidad, id_usuario=:id_usuario WHERE id_doctor=:id_doctor"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);   
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apaterno', $apaterno, PDO::PARAM_STR);
            $stmt->bindParam(':amaterno', $amaterno, PDO::PARAM_STR);
            $stmt->bindParam(':especialidad', $especialidad, PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function delete($id_doctor)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM doctor WHERE id_doctor=:id_doctor"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
?>