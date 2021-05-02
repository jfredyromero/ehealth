<?php
    //$conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $id = $_GET["id_tarj"];

    // CONSULTA ESTADO
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
    $sql1 = "SELECT * from datos_dispositivos where id_tarjeta=$id";
    // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
    $result1 = $mysqli->query($sql1);
    $row1 = $result1->fetch_array(MYSQLI_NUM);
    $estado= $row1[1];
    echo $estado;
?>
