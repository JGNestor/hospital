<?php
    require_once('sistema.controller.php');
    
    /*
        Clase principal de productos
    */
    class TipoProducto extends Sistema
    {
        var $id_tipo_producto;
        var $tipo_producto;

        function setId_tipo_producto($id){
            $this->id_tipo_producto=$id;
        }

        function getId_tipo_producto(){
            return $this->id_tipo_producto;
        }

        function setTipoProducto($producto){
            $this->tipo_producto=$producto;
        }

        function getTipoProducto(){
            return $this->tipo_producto;
        }

        /*
            Metodo para crear un producto
            Params String @tipo_producto recibe el nombre del producto
            Returns Integer con la cantidad de registros aceptados
        */
        function create($tipo_producto)
        {
            $dbh = $this->connect();
            $sentencia = "INSERT INTO tipo_producto(tipo_producto) VALUES(:tipo_producto)"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':tipo_producto', $tipo_producto, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;     
        }

        /*
            Metodo para obtener todos los productos
            Returns array
        */
        function read()
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM tipo_producto";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        /*
            Metodo para obtener un solo producto
            Params Int @id_tipo_producto que es el id del producto
            Returns array
        */
        function readOne($id_tipo_producto)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM tipo_producto WHERE id_tipo_producto=:id_tipo_producto";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        /*
            Metodo para actualizar un producto
            Params Int @id_tipo_producto que es el id del producto
                   String @tipo_producto recibe el nombre del producto
            Returns Integer con la cantidad de registros modificados
        */
        function update($id_tipo_producto, $tipo_producto)
        {
            $dbh = $this->connect();
            $sentencia = "UPDATE tipo_producto SET tipo_producto=:tipo_producto WHERE id_tipo_producto=:id_tipo_producto"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_INT);   
            $stmt->bindParam(':tipo_producto', $tipo_producto, PDO::PARAM_STR);
            $resultado = $stmt->execute();
            return $resultado;
        }
        
        /*
            Metodo para borrar un solo producto
            Params Int @id_tipo_producto que es el id del producto
            Returns Integer con la cantidad de registros eliminados
        */
        function delete($id_tipo_producto)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM tipo_producto WHERE id_tipo_producto=:id_tipo_producto"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }
    }
?>