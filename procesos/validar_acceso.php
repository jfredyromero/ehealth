<?php
    if ($_SESSION["tipo_usuario"] != 1){
        header("Location: /ehealth/static/php/acceso_denegado.php");
    }
?>
