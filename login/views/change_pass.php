<form action="../login/login.php?action=save_pass" method="POST">
    <h1>Restablecer contraseña</h1>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nueva contraseña</label>
        <input type="password" name="contrasena" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <input type="hidden" name="correo" value="<?php echo($correo); ?>">
        <input type="hidden" name="token" value="<?php echo($token); ?>">
        <input type="submit" name="enviar" value="Restablecer contraseña" class="btn btn-primary">
    </div>
</form>