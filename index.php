<?php
    session_start();
    $_SESSION["tipo_usuario"]= 1; //Administrador
    //$_SESSION["tipo_usuario"]= 0; //Usuario
    $_SESSION["id_usuario"]= 77291932;
    $_SESSION["nombre_usuario"]= "Fredy";
    $_SESSION["autenticado"]= "AUTxxfffxx";
    header("Location: interfaces/consultas/registros.php");
?>
