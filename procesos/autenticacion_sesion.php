<?php
    session_start();
    if ($_SESSION["autenticado"] != "AUTxxfffxx"){
        // Se debe reenviar a la pagina de inicio de sesion con el mensaje que notifica el error en la autenticación
        header("Location: /ehealth/iniciar_sesion.php?mensaje=3");
    }
?>
