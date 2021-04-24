<?php
    session_start();
    $_SESSION["autenticado"]= "SIx3";
    $_SESSION["tipo_usuario"]= 0; //Administrador
    //$_SESSION["tipo_usuario"]= 0; //Usuario
    $_SESSION["nombre_usuario"]= "Jhon Fredy";
    header("Location: interfaces/consultas/registros.php");
?>
