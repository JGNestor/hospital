<?php
    require_once('sistema.controller.php');
    
    /*
        Clase principal de roles
    */
    class Roles extends Sistema
    {
        var $id_rol;
        var $rol;

        function setId_rol($id){
            $this->id_rol=$id;
        }

        function getId_rol(){
            return $this->$id_rol;
        }

        function setRol($rol){
            $this->rol=$rol;
        }

        function getRol(){
            return $this->rol;
        }

        
        function create($rol)
        {
            $dbh = $this->connect();
            $sentencia = "INSERT INTO rol(rol) VALUES(:rol)"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;     
        }

        
        function read()
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM rol";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        
        function readOne($id_rol)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM rol WHERE id_rol=:id_rol";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        
        function update($id_rol, $rol)
        {
            $dbh = $this->connect();
            $sentencia = "UPDATE rol SET rol=:rol WHERE id_rol=:id_rol"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);   
            $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        
        function delete($id_rol)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM rol WHERE id_rol=:id_rol"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
?>