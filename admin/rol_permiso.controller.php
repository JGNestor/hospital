<?php
    require_once('sistema.controller.php');

    class RolPermiso extends Sistema
    {
        var $id_rol;
        var $id_permiso;

        function setId_rol($id){
            $this->id_rol=$id;
        }

        function getId_rolo(){
            return $this->id_rol;
        }

        function setId_permiso($per){
            $this->id_permiso=$per;
        }

        function getId_permiso(){
            return $this->getId_permiso;
        }

        function create($id_rol, $id_permiso)
        {
            $dbh = $this->connect();
            $sentencia = "INSERT INTO rol_permiso(id_rol,id_permiso) VALUES(:id_rol, :id_permiso)"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;     
        }

        function read()
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM rol_permiso join rol using (id_rol) join permiso using (id_permiso)";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function readOne($id_rol, $id_permiso)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM rol_permiso WHERE id_rol=:id_rol AND id_permiso= :id_permiso";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        function update($id_rol, $id_permiso)
        {
            $dbh = $this->connect();
            $sentencia = "UPDATE rol_permiso SET id_rol=:id_rol, id_permiso=:id_permiso WHERE id_rol=:id_rol AND id_permiso=:id_permiso"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_rol', $rol, PDO::PARAM_INT);   
            $stmt->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;
        }

        function delete($id_rol, $id_permiso)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM rol_permiso WHERE id_rol=:id_rol AND id_permiso=:id_permiso"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmt->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
?>