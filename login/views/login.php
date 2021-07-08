<form action="../login/login.php?action=validate" method="POST">
    <h1><?php echo($mensaje); ?></h1>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
        <input type="email" name="correo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
        <input type="password" name="contrasena" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <input type="submit" name="enviar" value="Ingresar" class="btn btn-primary">
    </div>
    <a href="../login/login.php?action=forget">¿Olvidó su contraseña?</a>
</form>