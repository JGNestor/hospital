<?php
    include('sistema.controller.php');
    $sistema=new Sistema;
    $sistema->verificarSesion();
    include('views/header.php');
?>
<h1>Bienvenido al sistema</h1>

<?php
    //<a href="../login/login.php?action=logout">Salir</a>
    include('views/footer.php');
?>
