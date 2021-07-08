<?php
require_once'sistema.controller.php';
require_once'pacientes.controller.php';
require_once'doctores.controller.php';
$sistema = new Sistema;
$pacientes=new Paciente;
$sistema->verificarRoles('Doctor');
$datos = $pacientes->read();

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $content="
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 9px;
        }
        #t01 {
            width: 100%;    
            background-color: #7ff081;
            text-align:center;
        }
</style>
    <h1>Pacientes</h1>
    <p>listado de los pacientes</p>
    <table>
        <tr id='t01'>
            <th>No. paciente</th>
            <th>Nombre</th>
            <th>Apellido paterno</th>
            <th>Apellido materno</th>
            <th>Nacimiento</th>
            <th>Domicilio</th>
        </tr>";
    foreach($datos as $dato => $value)
    {
        $content.="
        <tr>
            <td>".$value['id_paciente']."</td>
            <td>".$value['nombre']."</td>
            <td>".$value['apaterno']."</td>
            <td>".$value['amaterno']."</td>
            <td>".$value['nacimiento']."</td>
            <td>".$value['domicilio']."</td>
        </tr>";
    }
    $content.="
    </table>";
      
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output('pacientes.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}