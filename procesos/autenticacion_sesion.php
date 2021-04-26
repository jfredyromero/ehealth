<?php
    session_start();
    if ($_SESSION["autenticado"] != "AUTxxfffxx"){
        // Se debe reenviar a la pagina de inicio de sesion con el mensaje que notifica el error en la autenticación
        //header("Location: /ehealth/inicio_sesion.php?error=1");
    }
?>
