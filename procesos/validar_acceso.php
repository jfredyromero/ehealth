<?php
    if ($_SESSION["tipo_usuario"] != 1){
        $error = "Location: ".$_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/acceso_denegado.php";
        header("Location: /ehealth/static/php/acceso_denegado.php");
    }
?>
