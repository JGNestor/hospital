<?php echo(isset($datos))?"<h1>Modificar relación</h1>":"<h1>Nueva relación</h1>";?>
<form action="rol_permiso.php?action=<?php echo(isset($datos))?'update':'save'; ?>" method="POST">
    <!--<div class="mb-4">
        <label>Rol</label>
        <input type="text" name="relacion[rol]" value="<?php //echo(isset($datos[0]['id_rol']))?$datos[0]['id_rol']:''; ?>" class="form-control" rows="1">
    </div>
    <div class="mb-4">
        <label>Permiso</label>
        <input type="text" name="relacion[permiso]" value="<?php //echo(isset($datos[0]['id_permiso']))?$datos[0]['id_permiso']:''; ?>" class="form-control" rows="1">
    </div>-->
    <div class="mb-4">
        <label>Rol</label>
        <select name="relacion[rol]" class="form-control" rows="1">
            <?php             
                foreach($tipos1 as $key => $tipo): 
                    $selected='';
                    if($tipo[0]['id_rol']==$datos[0]['id_rol'])
                    {
                        $selected=' selected';
                    }
            ?>
            <option value="<?php echo($tipo['rol']); ?>" <?php echo($selected); ?>> <?php echo($tipo['rol']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-4">
        <label>Permiso</label>
        <select name="relacion[permiso]" class="form-control" rows="1">
            <?php 
                foreach($tipos2 as $key => $tipo): 
                    $selected='';
                    if($tipo[0]['id_permiso']==$datos[0]['id_permiso'])
                    {
                        $selected=' selected';
                    }
            ?>
            <option value="<?php echo($tipo['permiso']); ?>" <?php echo($selected); ?>> <?php echo($tipo['permiso']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="hidden" name="relacion[id_rol]" value="<?php echo(isset($datos[0]['id_rol']))?$datos[0]['id_rol']:''; ?>" >
    <input type="hidden" name="relacion[id_permiso]" value="<?php echo(isset($datos[0]['id_permiso']))?$datos[0]['id_permiso']:''; ?>">
    <input type="submit" name="enviar" class="btn btn-primary mb-2" value="Guardar">
</form>