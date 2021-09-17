<?php
    //$conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.

    $hum = $_GET["humedad"]; // el dato de humedad que se recibe aqu� con GET denominado humedad, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada
    $temp = $_GET["temperatura"]; // el dato de temperatura que se recibe aqu� con GET denominado temperatura, es enviado como parametro en la solicitud que realiza la tarjeta microcontrolada
    $rain = $_GET["lluvia"];
    $ID_TARJ = $_GET["ID_TARJ"];
    $lon = $_GET["longitud"];
    $lat = $_GET["latitud"];
    $vel = $_GET["velocidad"];
    $alt = $_GET["altitud"];

    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

    date_default_timezone_set('America/Bogota'); // esta l�nea es importante cuando el servidor es REMOTO y est� ubicado en otros pa�ses como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.

    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    
    if($temp!=0 || $hum!=0){
        $sql1 = "INSERT into datos_medidos (id_tarjeta, temperatura, humedad, fecha, hora, lluvia) VALUES ('$ID_TARJ', '$temp', '$hum', '$fecha', '$hora', $rain)"; // Aqu� se ingresa el valor recibido a la base de datos.
        $sql2 = "INSERT into datos_ubicaciones (id_tarj, latitud, longitud, fecha, hora, velocidad, altitud) VALUES ('$ID_TARJ', '$lat', '$lon', '$fecha', '$hora','$vel','$alt')";
        $sql3 = "INSERT into datos_validos (id_tarjeta, fecha, hora, estado) VALUES ('$ID_TARJ', '$fecha', '$hora', 1)";
        $result1 = $mysqli->query($sql1);
        $result2 = $mysqli->query($sql2);
        $result3 = $mysqli->query($sql3);
        echo "Los datos fueron validos\n";
        echo "La sentencia ".$sql1." fue ".$result1."\n"; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
        echo "La sentencia ".$sql2." fue ".$result2."\n"; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
        echo "La sentencia ".$sql3." fue ".$result3."\n"; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
    }else{
        $sql1 = "INSERT into datos_validos (id_tarjeta, fecha, hora, estado) VALUES ('$ID_TARJ', '$fecha', '$hora', 0)";
        $result1 = $mysqli->query($sql1);
        echo "Los datos fueron invalidos\n";
        echo "La sentencia ".$sql1." fue ".$result1."\n"; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.
    } 
?>
