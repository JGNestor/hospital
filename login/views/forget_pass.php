<form action="../login/login.php?action=send_pass" method="POST">
    <h1>Recuperar contraseña</h1>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
        <input type="email" name="correo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <input type="submit" name="enviar" value="Recuperar contraseña" class="btn btn-primary">
    </div>
</form>