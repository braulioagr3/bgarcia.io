<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $DB = 'e-commerce';
    $conection = @mysqli_connect($host,$user,$pas,$DB);
    if(!$conection)
        echo "Error en la coneccion";
    /*else
        echo "Conexion exitosa";*/

?>