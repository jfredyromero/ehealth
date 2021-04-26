<?php
    session_start();
    unset($_SESSION["nombre_usuario"]);
    unset($_SESSION["id_usuario"]);
    unset($_SESSION["tipo_usuario"]);
    unset($_SESSION["autenticado"]);
    session_destroy();
    //header('Location: index.php');
?>
