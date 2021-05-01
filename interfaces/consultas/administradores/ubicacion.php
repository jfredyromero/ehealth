<?php
    $conexion = $_SERVER['DOCUMENT_ROOT'] . "/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $autenticacion = $_SERVER['DOCUMENT_ROOT'] . "/ehealth/procesos/autenticacion_sesion.php";
    include $autenticacion;
    $validacion = $_SERVER['DOCUMENT_ROOT'] . "/ehealth/procesos/validar_acceso.php";
    include $validacion;
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <?php
        $head = $_SERVER['DOCUMENT_ROOT'] . "/ehealth/static/php/head.php";
        include $head;
    ?>

</head>

<body background="/ehealth/static/img/background.jpg">
    <h1 id="home-title">eHealth: Dispositivo IoT</h1>
    <div id="home">

        <?php
            if ($_SESSION["tipo_usuario"] == 1)
                $nav = $_SERVER['DOCUMENT_ROOT'] . "/ehealth/static/php/nav_admin.php";
            else
                $nav = $_SERVER['DOCUMENT_ROOT'] . "/ehealth/static/php/nav_user.php";
            include $nav;
        ?>

        <div id="page-content">
            <table width="80%" align=center cellpadding=3 border=1>
                <tr>
                    <td valign="top" align=center width=80& colspan=8>
                        <img src="/ehealth/static/img/logo.png" width=800 height=250>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align=center width=80& colspan=8 bgcolor="#281E5D">
                        <h1>
                            <font color=white>Ubicación del Dispositivo</font>
                        </h1>
                    </td>
                </tr>

                <?php

                $mysqli = new mysqli($host, $user, $pw, $db);
                $id_tarj = $_GET['id_tarjeta'];
                $sql1 = "SELECT * from datos_dispositivos WHERE id_tarjeta= '$id_tarj'";
                $result1 = $mysqli->query($sql1);
                $row1 = $result1->fetch_array(MYSQLI_NUM);
                $id_ta = $row1[0];
                $estado = $row1[1];
                $ubicacion = $row1[2];
                $propietario = $row1[3];

                $sqlubi = "SELECT * from datos_ubicaciones WHERE id_tarj=$id_tarj  order by id DESC"; //CONSULTA LA ULTIMA UBICACION AGREGADA A LA TABLA UBICACIONES
                $resultubi = $mysqli->query($sqlubi);
                $rowubi = $resultubi->fetch_array(MYSQLI_NUM);

                if ($rowubi == NULL) {
                ?>
                    <tr>
                        <td valign="center" align=center bgcolor="#E1E1E1" colspan=8>
                            <b>El ID solicitado NO tiene registro de ubicación</b>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#EEEEEE" align=center colspan=8>
                            <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/administradores/dispositivos.php" role="button">
                                <i class="fas fa-angle-double-left"></i>
                                <span class="pl-3">Volver</span>
                            </a>
                        </td>
                    </tr>
                <?php
                } else {
                    $latitud = $rowubi[1];
                    $longitud = $rowubi[2];
                ?>
                    <form method=POST action="ubicacion.php">
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>ID:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=6>
                                <input type="number" value=<?php echo $id_ta; ?> disabled>
                                <input type="hidden" name="id_tarjeta" value=<?php echo $id_ta; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Propietario</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=6>
                                <input type="text" value="<?php echo $propietario; ?>" disabled>
                                <input type="hidden" name="propietario" value=<?php echo $propietario; ?>>
                            </td>
                        </tr>
                        <tr height=20>
                        </tr>
                        <tr>
                            <td valign="center" align=center colspan=8 bgcolor="#281E5D">
                                <h1>
                                    <font color=white>Mapa</font>
                                </h1>
                            </td>
                        </tr>
                        <tr>
                            <td valign="center" align=center colspan=8 bgcolor="#E1E1E1">
                                <div id="map" style="height:400px;width:90%;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=8>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/administradores/dispositivos.php" role="button">
                                    <i class="fas fa-angle-double-left"></i>
                                    <span class="pl-3">Volver</span>
                                </a>
                            </td>
                        </tr>
                    </form>
                <?php
                } ?>
            </table>
        </div>
    </div>
    <div id="jscripts">
        <?php
        $jscripts = $_SERVER['DOCUMENT_ROOT'] . "/ehealth/static/php/jscripts.php";
        include $jscripts;
        ?>
        <script>
            function initMap() {
                var latit = <?php echo $latitud ?>;
                var longi = <?php echo $longitud ?>;
                var uluru = {
                    lat: latit,
                    lng: longi
                };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: uluru
                });
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwrROSJLYv3oz-WQeIyNRa37c1U0GXRPQ&callback=initMap">
            <!-- Se deben reemplazar las XXXX por la API Key de Google MAPS
            -->
        </script>
    </div>
</body>

</html>
