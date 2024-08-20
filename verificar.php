<?php

$mi_archivos=new mysqli("localhost","root","","archivos_subidos");

$nombre_v=$_POST["nombre_v"];
$apellido_v=$_POST["apellido_v"];

$verificar="SELECT * FROM integrantes WHERE nombre = '$nombre_v' and apellido= '$apellido_v' ";
$result = $mi_archivos->query($verificar);
if ($result->num_rows >0) {
    $archivoHTML = "formulario3.html"; // Nombre del archivo HTML

    if (file_exists($archivoHTML)) {
        header('Content-Type: text/html'); 
        readfile($archivoHTML); }

} else{
    echo ("Usuario no encontrado");
}
?>