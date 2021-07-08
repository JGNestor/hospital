<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pacientes</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/features/">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
        <?php
        //        $mysqli = new mysqli("localhost", "hospital", "hospital123", "hospital");
        //        $resultado = $mysqli->query("SELECT * FROM paciente");
        //        while ($fila = $resultado->fetch_assoc()) 
        //        {
        //            echo $fila['apaterno'] . "\n";
        //        }
        ?>

        <h1>Pacientes</h1>
        <?php
            $i=1;
            //$mysqli = new mysqli("localhost", "hospital", "hospital123", "hospital");
            $dbh = new PDO('mysql:host=localhost;dbname=hospital', "hospital", "hospital123");
            //$resultado = $mysqli->query("SELECT * FROM paciente");
            $resultado = $dbh->query('SELECT * FROM paciente');
            $rows = $resultado->fetchAll();

            /*print_r($rows);
            die();*/
            
            echo 
            "<table class='table'>
                <thead>
                    <tr>
                        <th scope='col'>#</th>
                        <th scope='col'>Nombre</th>
                        <th scope='col'>Apellido Paterno</th>
                        <th scope='col'>Apellido Materno</th>
                        <th scope='col'>Fecha Nacimiento</th>
                        <th scope='col'>Domiciilo</th>
                        <th scope='col'>Fotografia</th>
                    </tr>
                </thead>    
                <tbody>";
                foreach($rows as $fila)
                //while ($fila = $resultado->fetch_assoc()) 
                {
                    //echo $fila['apaterno'] . "\n";
                    echo
                    "<tr>
                        <td>".$i."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['apaterno']."</td>
                        <td>".$fila['amaterno']."</td>
                        <td>".$fila['nacimiento']."</td>
                        <td>".$fila['domicilio']."</td>
                        <td>".$fila['fotografia']."</td>
                    </tr>";
                    $i++;
                } 
            echo 
                "</tbody>    
            </table>";               
        ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
