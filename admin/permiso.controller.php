<?php
    require_once('sistema.controller.php');
    
    class Permisos extends Sistema
    {
        var $id_permiso;
        var $permiso;

        function setId_permiso($id){
            $this->id_permiso=$id;
        }

        function getId_permiso(){
            return $this->id_permiso;
        }

        function setPermiso($permiso){
            $this->permiso=$permiso;
        }

        function getPermiso(){
            return $this->permiso;
        }

        function create($permiso)
        {
            $dbh = $this->connect();
            $sentencia = "INSERT INTO permiso(permiso) VALUES(:permiso)"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':permiso', $permiso, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;     
        }

        function read()
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM permiso";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function readOne($id_permiso)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM permiso WHERE id_permiso=:id_permiso";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function update($id_permiso, $permiso)
        {
            $dbh = $this->connect();
            $sentencia = "UPDATE permiso SET permiso=:permiso WHERE id_permiso=:id_permiso"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);   
            $stmt->bindParam(':permiso', $permiso, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function delete($id_permiso)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM permiso WHERE id_permiso=:id_permiso"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
?>