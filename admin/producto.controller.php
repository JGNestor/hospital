<?php
    require_once('sistema.controller.php');
    
    /*
        Clase principal de productos
    */
    class Producto extends Sistema
    {
        var $id_producto;
        var $producto;
        var $precio;

        function setId_producto($id){
            $this->id_producto=$id;
        }

        function getId_producto(){
            return $this->id_producto;
        }

        function setProducto($nom){
            $this->producto=$nom;
        }

        function getProducto(){
            return $this->producto;
        }

        function setPrecio($precio){
            $this->precio=$precio;
        }

        function getPrecio(){
            return $this->precio;
        }
        
        /*
            Metodo para crear un producto
            Params String @producto recibe el nombre del producto
                   String @precio recibe el precio del producto
                   String @id_tipo_producto recibe el tipo del producto 
            Returns Integer con la cantidad de registros aceptados
        */
        function create($producto, $precio, $id_tipo_producto)
        {
            $dbh = $this->connect();
            $sentencia = "INSERT INTO producto(producto,precio,id_tipo_producto) VALUES(:producto, :precio, :id_tipo_producto)"; 
            $stmt = $dbh->prepare($sentencia);   
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stmt->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_INT);
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
            $busqueda=(isset($_GET['busqueda']))?$_GET['busqueda']:'';
            $ordenamiento=(isset($_GET['ordenamiento']))?$_GET['ordenamiento']:'p.producto';
            $limite=(isset($_GET['limite']))?$_GET['limite']: 20;
            $desde=(isset($_GET['desde']))?$_GET['desde']: 0;
            //$sentencia="SELECT * FROM producto p JOIN tipo_producto tp using(id_tipo_producto)";
            $sentencia="SELECT * FROM producto p JOIN tipo_producto tp using(id_tipo_producto) where p.producto like :busqueda order by :ordenamiento limit :limite offset :desde";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindValue(':busqueda', '%'.$busqueda.'%', PDO::PARAM_STR);
            $stmt->bindValue(':ordenamiento', $ordenamiento, PDO::PARAM_STR);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':desde', $desde, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        /*
            Metodo para obtener un solo producto
            Params Int @id_producto que es el id del pasiente
            Returns array
        */
        function readOne($id_producto)
        {
            $dbh = $this->connect();
            $sentencia="SELECT * FROM producto WHERE id_producto=:id_producto";
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas;
        }

        /*
            Metodo para actualizar un producto
            Params Int @id_producto que es el id del producto
                   String @producto recibe el nombre del producto
                   String @precio recibe el precio del producto
                   String @id_tipo_producto recibe el tipo del producto
            Returns Integer con la cantidad de registros modificados
        */
        function update($id_producto, $producto, $precio, $id_tipo_producto)
        {
            $dbh = $this->connect();         
            $sentencia = "UPDATE producto SET producto=:producto, precio=:precio, id_tipo_producto=:id_tipo_producto WHERE id_producto=:id_producto"; 
            $stmt = $dbh->prepare($sentencia); 
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);   
            $stmt->bindParam(':producto', $producto, PDO::PARAM_STR);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
            $stmt->bindParam(':id_tipo_producto', $id_tipo_producto, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;
        }

        /*
            Metodo para borrar un solo producto
            Params Int @id_producto que es el id del producto
            Returns Integer con la cantidad de registros eliminados
        */
        function delete($id_producto)
        {
            $dbh = $this->connect();
            $sentencia = "DELETE FROM producto WHERE id_producto=:id_producto"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            $resultado = $stmt->execute();
            return $resultado;            
        }

        function total()
        {
            $dbh = $this->connect();
            $sentencia = "SELECT count(id_producto) as total FROM producto"; 
            $stmt = $dbh->prepare($sentencia);    
            $stmt->execute();
            $filas = $stmt->fetchAll();
            return $filas[0]['total'];        
        }
    }
?>