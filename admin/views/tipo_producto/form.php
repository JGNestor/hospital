<?php echo(isset($datos))?"<h1>Modificar tipo de producto</h1>":"<h1>Nuevo tipo de producto</h1>";?>
<form action="tipo_producto.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST">
    <div class="mb-4">
        <label>Tipo producto</label>
        <input type="text" name="producto[tipo_producto]" value="<?php echo(isset($datos[0]['tipo_producto']))?$datos[0]['tipo_producto']:''; ?>" class="form-control" rows="1">
    </div>
    <input type="hidden" name="producto[id_tipo_producto]" value="<?php echo(isset($datos[0]['id_tipo_producto']))?$datos[0]['id_tipo_producto']:''; ?>" >
    <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
</form>