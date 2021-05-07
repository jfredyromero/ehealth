<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $autenticacion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/autenticacion_sesion.php";
    include $autenticacion;
?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <?php
            $head = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/head.php";
            include $head;
        ?>

    </head>
    <body background="/ehealth/static/img/background.jpg">
        <h1 id="home-title">eHealth: Dispositivo IoT</h1>
        <div id="home">

            <?php
                if ($_SESSION["tipo_usuario"]==1)
                    $nav = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/nav_admin.php";
                else
                    $nav = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/nav_user.php";
                include $nav;
            ?>

            <div id="page-content">
                <table width="80%" align=center cellpadding=5 border=1>
                    <tr>
                        <td valign="center" align=center width=80% colspan=6>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center width=80% colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Consulta de dispositivos eHealth</font>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td align=center colspan=3 bgcolor="#E1E1E1">
                            <a id="boton_tabla" class="btn btn-lg" style="background-color:#281E5D; color:white" href="#boton_tabla" role="button">
                                <i class="fas fa-table"></i>
                                <span class="pl-3">Tabla</span>
                            </a>
                        </td>
                        <td align=center colspan=3 bgcolor="#E1E1E1">
                            <a id="boton_mapa" class="btn btn-lg" style="background-color:#281E5D; color:white" href="#boton_mapa" role="button">
                                <i class="fas fa-map-marked-alt"></i>
                                <span class="pl-2">Mapa</span>
                            </a>
                        </td>
                    </tr>
                    <tr height=50>
                    </tr>
                </table>
                <div id="tabla_dispositivos">
                    <table width=90% align=center cellpadding=5 border=0>
                        <tr>
                            <?php
                                if (isset($_GET["submit"]) && !empty($_GET["submit"])) {
                                    $id = $_GET["id_tarjeta"];
                                    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                    $sql5 = "SELECT estado from datos_dispositivos WHERE id_tarjeta= $id";
                                    $result5 = $mysqli->query($sql5);
                                    $row5 = $result5->fetch_array(MYSQLI_NUM);
                                    if ($row5 == NULL) {
                                        ?>
                                        <tr>
                                            <td valign="center" align=center bgcolor="#E1E1E1" colspan=7>
                                                <b>El ID solicitado NO existe</b>
                                            </td>
                                        </tr>
                                        <?php
                                        unset($_GET["submit"]);
                                    }
                                    else{
                                        ?>
                                        <tr>
                                            <td valign="center" align=center bgcolor="#E1E1E1" colspan=7>
                                                <b>Usted ha consultado el ID: <?php echo $id; ?></b>
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                }
                            ?>

                            <form method="GET">
                                <td style="border: none;" width=100 colspan=3>
                                </td>
                                <td style="border: none;" valign="center" align="right" colspan=2>
                                    <input type="number" class="form-control" name="id_tarjeta" placeholder="ID de la tarjeta..." required>
                                </td>
                                <td style="border: none;" valign="center" align=right colspan=2>
                                    <button style="background-color:#281E5D; color:white" value="Buscar" type="submit" class="btn btn-lg" name="submit"><i style="background-color:#281E5D; color:white" class="fas fa-search"></i><span class="pl-3">Buscar</span></button>
                                </td>
                            </form>
                        </tr>
                        <tr height=20>
                        </tr>
                    </table>
                    <table width=90% align=center cellpadding=5 border=1>
                        <tr height=50>
                            <td valign="center" align=center bgcolor="#E1E1E1">
                                <b>ID</b>
                            </td>
                            <td valign="center" align=center bgcolor="#E1E1E1">
                                <b>Propietario</b>
                            </td>
                            <td valign="center" align=center bgcolor="#E1E1E1" width=120>
                                <b>Ubicación</b>
                            </td>
                            <td valign="center" align=center bgcolor="#E1E1E1" width=80>
                                <b>Estado</b>
                            </td>
                            <td valign="center" align=center bgcolor="#E1E1E1" width=120>
                                <b>Fecha último registro</b>
                            </td>
                            <td valign="center" align=center bgcolor="#E1E1E1" width=120>
                                <b>Hora último registro</b>
                            </td>
                            <td valign="center" align=center bgcolor="#E1E1E1" width=40>
                                <b>Símbolo</b>
                            </td>
                        </tr>

                        <?php

                        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                        $sql1 = "SELECT * from datos_dispositivos order by id_tarjeta"; // Aqu� se ingresa el valor recibido a la base de datos.
                        $result1 = $mysqli->query($sql1);
                        if (isset($_GET["submit"]) && !empty($_GET["submit"])) {
                            //Busca fehca máxima
                            $sql2 = "SELECT MAX(fecha) from datos_ubicaciones WHERE id_tarj= $id";
                            $result2 = $mysqli->query($sql2);
                            $row2 = $result2->fetch_array(MYSQLI_NUM);
                            $fecha = $row2[0];
                            //Busca hora máxima
                            $sql23 = "SELECT MAX(hora) from datos_ubicaciones WHERE id_tarj= $id AND fecha='$fecha'";
                            $result23 = $mysqli->query($sql23);
                            $row23 = $result23->fetch_array(MYSQLI_NUM);
                            $hora = $row23[0];

                            $sql3 = "SELECT * from datos_dispositivos WHERE id_tarjeta= $id";
                            $result3 = $mysqli->query($sql3);
                            while ($row3 = $result3->fetch_array(MYSQLI_NUM)) {
                                $propietario = $row3[3];
                                $estado = $row3[1];
                                $ubicacion = $row3[2];
                            }
                        ?>
                            <tr>
                                <td valign="center" align=center>
                                    <?php echo $id; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $propietario; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $ubicacion; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php
                                    if ($estado == 1) {
                                    ?>
                                        <img src="/ehealth/static/img/comprobado.png" width=32 height=32>
                                    <?php
                                    } else {
                                    ?>
                                        <img src="/ehealth/static/img/cancelar.png" width=32 height=32>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $fecha; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $hora; ?>
                                </td>
                                <td valign="center" align=center>
                                    <img src="/ehealth/static/img/map_icons/icono_<?php echo $id; ?>.png" width=32 height=32>
                                </td>
                            </tr>
                            <tr height=20>
                            </tr>
                        </table>
                        <table width=90% align=center cellpadding=5 border=0>
                            <tr>
                                <td style="border: none;" valign="center" align=left>
                                    <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/usuarios/dispositivos.php" role="button">
                                        <i class="fas fa-angle-double-left"></i>
                                        <span class="pl-3">Volver</span>
                                    </a>
                                </td>
                            </tr>
                        </table>
                            <?php
                        } else {
                            $contador = 0;
                            while ($row1 = $result1->fetch_array(MYSQLI_NUM)) {
                                $ID_TARJ = $row1[0];
                                $propietario = $row1[3];
                                $estado = $row1[1];
                                $ubicacion = $row1[2];
                                $contador++;
                                $sql2 = "SELECT MAX(fecha) from datos_ubicaciones WHERE id_tarj= $contador";
                                $result2 = $mysqli->query($sql2);
                                $row2 = $result2->fetch_array(MYSQLI_NUM);
                                $fecha = $row2[0];
                                $sql23 = "SELECT MAX(hora) from datos_ubicaciones WHERE id_tarj= $contador AND fecha='$fecha'";
                                $result23 = $mysqli->query($sql23);
                                $row23 = $result23->fetch_array(MYSQLI_NUM);
                                $hora = $row23[0];
                            ?>
                                <tr>
                                    <td valign="center" align=center>
                                        <?php echo $ID_TARJ; ?>
                                    </td>
                                    <td valign="center" align=center>
                                        <?php echo $propietario; ?>
                                    </td>
                                    <td valign="center" align=center>
                                        <?php echo $ubicacion; ?>
                                    </td>
                                    <td valign="center" align=center>
                                        <?php
                                        if ($estado == 1) {
                                        ?>
                                            <img src="/ehealth/static/img/comprobado.png" width=32 height=32>
                                        <?php
                                        } else {
                                        ?>
                                            <img src="/ehealth/static/img/cancelar.png" width=32 height=32>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td valign="center" align=center>
                                        <?php echo $fecha; ?>
                                    </td>
                                    <td valign="center" align=center>
                                        <?php echo $hora; ?>
                                    </td>
                                    <td valign="center" align=center>
                                        <img src="/ehealth/static/img/map_icons/icono_<?php echo $ID_TARJ; ?>.png" width=32 height=32>
                                    </td>
                                </tr>

                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <div id="mapa_dispositivos">
                    <table width="80%" align=center cellpadding=5 border=1>
                        <tr>
                          <td valign="center" align=center width=80% colspan=8 bgcolor="#281E5D">
                            <h1> <font color=white>Mapa</font></h1>
                          </td>
                        </tr>
                        <tr>
                          <td valign="center" align=center width=80% colspan=8 bgcolor="#E1E1E1">
                            <?php
                                $mysqli2 = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                $sqlubi2 = "SELECT * FROM datos_ubicaciones WHERE id IN (SELECT MAX(id) FROM datos_ubicaciones GROUP BY id_tarj) ORDER BY id_tarj"; //CONSULTA LAS ULTIMAS 100 UBICACIONES DE LA TABLA DE LA BASE DE DATOS
                                $resultubi = $mysqli2->query($sqlubi2);
                                $i=0;
                                while($rowubi = $resultubi->fetch_array(MYSQLI_NUM))
                                {
                                   $latitud2[$i] = $rowubi[1];
                                   $longitud2[$i] = $rowubi[2];
                                   $id_tarjeta2[$i] = $rowubi[3];
                                   $fecha2[$i] = $rowubi[4];
                                   $hora2[$i] = $rowubi[5];
                                   $i++;
                                }
                            ?>
                            <div id="map" style="height:400px;width:80%;">
                            </div>
                          </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="jscripts">
            <?php
                $jscripts = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/jscripts.php";
                include $jscripts;
            ?>
            <script src="/ehealth/static/js/switch_views.js" type="text/javascript"></script>
            <script>
              var map;

              // ALMACENA EN VARIABLES LA UBICACION INICIAL Y FINAL

              var latit= <?php echo $latitud2[0] ?>;
              var longi= <?php echo $longitud2[0] ?>;
              var tarjeta= <?php echo $id_tarjeta2[0] ?>;
              var uluru = {lat: latit, lng: longi};

              var latitk= <?php echo $latitud2[$i-1] ?>;
              var longik= <?php echo $longitud2[$i-1] ?>;
              var tarjetak= <?php echo $id_tarjeta2[$i-1] ?>;
              var uluruk = {lat: latitk, lng: longik};

              function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 12,
                  center: {lat: 2.46542, lng: -76.59035},
                  mapTypeId: 'roadmap'
                });

              var infowindow = new google.maps.InfoWindow({
                content: 'Ubicaci&oacute;n Inicial, Lat: ' + <?php echo $latitud2[0];?> + ', Lon: ' + <?php echo $longitud2[0];?>,
                position: uluru
               });
              //infowindow.open(map);
                const num_icons = 4; // Numero de iconos almacenados (Debe ser equivalente al numero de dispositivos en el sistema)
                var icons = [
                  <?php
                    for ($k=1;$k<4;$k++)
                      {
                  ?>
                  {
                  ubicacion: {icon:'/ehealth/static/img/map_icons/icono_'+<?php echo $k ?>+'.png'}
                  },
                  <?php
                     }
                  ?>
                  {
                  ubicacion: {icon:'/ehealth/static/img/map_icons/icono_'+num_icons+'.png'}
                  }
                ];

                // GUARDA EN UN ARREGLO FEATURES LOS PUNTOS DE UBICACION
                var features = [
                   <?php
                     for ($k=0;$k<$i;$k++)
                       {
                   ?>
                   {
                    position: new google.maps.LatLng(<?php echo $latitud2[$k];?>, <?php echo $longitud2[$k];?>),
                    tarjeta: <?php echo $id_tarjeta2[$k];?>,
                    type: 'ubicacion'
                   },
                   <?php
                      }
                   ?>
                  {
                    position: new google.maps.LatLng(<?php echo $latitud2[$k-1];?>, <?php echo $longitud2[$k-1];?>),
                    tarjeta: <?php echo $id_tarjeta2[$k-1];?>,
                    type: 'ubicacion'
                  }
                ];

                // CREA LOS MARCADORES Y LOS PRESENTA EN EL MAPA

                features.forEach(function(feature) {
                  var marker = new google.maps.Marker({
                    position: feature.position,
                    icon: icons[feature.tarjeta-1][feature.type].icon,
                    map: map
                  });
                });

              // PRESENTA TAMBIEN UN MENSAJE EMERGENTE PARA LA UBICACION INICIAL Y LA FINAL.

              var infowindow = new google.maps.InfoWindow({
                  content: 'Hola Lina ' + <?php echo $latitud2[$k-1];?> + ', Lon: ' + <?php echo $longitud2[$k-1];?>,
                  position: uluruk
              });
              //infowindow.open(map);

              }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwrROSJLYv3oz-WQeIyNRa37c1U0GXRPQ&callback=initMap"></script>
        </div>
    </body>
</html>
