<?php echo(isset($datos))?"<h1>Modificar producto</h1>":"<h1>Nuevo producto</h1>"; ?>
<form action="producto.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST" enctype="multipart/form-data">
    <div class="mb-4">
        <label>Producto</label>
        <input type="text" name="producto[producto]" value="<?php echo(isset($datos[0]['producto']))?$datos[0]['producto']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Precio</label>
        <input type="text" name="producto[precio]" value="<?php echo(isset($datos[0]['precio']))?$datos[0]['precio']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Tipo de producto</label>
        <select name="producto[id_tipo_producto]" class="form-control" rows="1">
            <?php 
                foreach($tipos as $key => $tipo): 
                    $selected='';
                    if($tipo[0]['id_tipo_producto']==$datos[0]['id_tipo_producto'])
                    {
                        $selected=' selected';
                    }
            ?>
            <option value="<?php echo($tipo['id_tipo_producto']); ?>" <?php echo($selected); ?>> <?php echo($tipo['tipo_producto']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-4">
        <input type="hidden" name="producto[id_producto]" value="<?php echo(isset($datos[0]['id_producto']))?$datos[0]['id_producto']:''; ?>" >
        <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
    </div>
</form>