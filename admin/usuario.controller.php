<?php
    require_once('sistema.controller.php');
    
    /*
        Clase principal de usuarios
    */
    class Usuario extends Sistema
    {
        var $id_usuario;
        var $correo;
        var $contrasena;

        function setId_usuario($id){
            $this->id_usuario=$id;
        }

        function getId_usuario(){
            return $this->id_usuario;
        }

        function setCorreo($nom){
            $this->correo=$nom;
        }

        function getCorreo(){
            return $this->correo;
        }

        function setContrasena($contrasena){
            $this->contrasena=$contrasena;
        }

        function getContrasena(){
            return $this->contrasena;
        }

        function create($correo, $contrasena)
        {
            
            $dbh = $this->connect();  
            $sentencia = "INSERT INTO usuario(correo,contrasena) VALUES(:correo, :contrasena)"; 
            $stmt = $dbh->prepare($sentencia);   
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;     
        }

        function read()
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM usuario";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function readOne($id_usuario)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM usuario WHERE id_usuario=:id_usuario";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function update($id_usuario, $correo, $contrasena)
        {
            $dbh = $this->connect();
            $sentencia = "UPDATE usuario SET correo=:correo, contrasena=:contrasena WHERE id_usuario=:id_usuario"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);   
            $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
            $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function delete($id_usuario)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM usuario WHERE id_usuario=:id_usuario"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
?>