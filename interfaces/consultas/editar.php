<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/conexion.php";
    include $root;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>eHealth</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="/ehealth/static/css/styles.css" rel="stylesheet">
    </head>
    <body background="/ehealth/static/img/background.jpg">
        <h1 id="home-title">eHealth: Dispositivo IoT</h1>
        <div id="home">
            <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #281E5D;">
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/ehealth/interfaces/consultas/ultimos.php">
                                Últimos
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Consultas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/ehealth/interfaces/consultas/ultimos.php">Últimos</a>
                                <a class="dropdown-item" href="/ehealth/interfaces/consultas/fechas.php">Fechas</a>
                                <a class="dropdown-item" href="/ehealth/interfaces/consultas/dispositivos.php">Dispositivos</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ehealth/interfaces/probabilidades/probabilidades.php">Probabilidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ehealth/interfaces/rangos/rangos.php">Rangos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><strong>Username</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Salir</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-content">
                <table width="80%" align=center cellpadding=5 border=1>
                    <tr>
                        <td valign="top" align=center width=80& colspan=6>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center width=80& colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Editar Dispositivo</font>
                            </h1>
                        </td>
                    </tr>

                    <?php
                    if ((isset($_POST["enviado"]))){
                        $id_tarjeta = $_POST['id_tarjeta'];
                        $propietario =$_POST['propietario'];
                        $ubicacion =$_POST['ubicacion'];
                        $estado = $_POST['estado'];

                        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

                        $sql1 = "UPDATE datos_dispositivos set propietario='$propietario' where id_tarjeta='$id_tarjeta'";
                        //echo "sql1".$sql1;
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result1 = $mysqli->query($sql1);

                        $sql2 = "UPDATE datos_dispositivos set ubicacion='$ubicacion' where id_tarjeta='$id_tarjeta'";
                        //echo "sql2".$sql2;
                        $result2 = $mysqli->query($sql2);

                        $sql3 = "UPDATE datos_dispositivos set estado='$estado' where id_tarjeta='$id_tarjeta'";
                        //echo "sql3".$sql3;
                        $result3 = $mysqli->query($sql3);

                        if (($result1 == 1)&&($result2 == 1)&&($result3 == 1)){
                            $mensaje = "Datos modificados correctamente";
                        }else{
                            $mensaje = "Inconveniente el editar los datos";
                        }

                        echo '<tr>
                        <td bgcolor="#EEEEFF" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000048"> <b>'.$mensaje.'</b></font>
                                </td>
                        </tr>';

                        $mysqli = new mysqli($host, $user, $pw, $db);
                        $id_tarj=$_POST["id_tarjeta"];
                        $sql1="SELECT * from datos_dispositivos WHERE id_tarjeta= '$id_tarj'";
                        $result1 = $mysqli->query($sql1);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);

                        $id_ta = $row1[0];
                        $estado = $row1[1];
                        $ubicacion = $row1[2];
                        $propietario= $row1[3];

                        if ($estado=='1') {
                            $estado_si='selected';
                        }else{
                            $estado_si='';
                        }

                        if ($estado=='0') {
                            $estado_no='selected';
                        }else{
                            $estado_no='';
                        }

                    }else{
                        $mysqli = new mysqli($host, $user, $pw, $db);
                        $id_tarj=$_GET["id_tarjeta"];
                        $sql1="SELECT * from datos_dispositivos WHERE id_tarjeta= '$id_tarj'";
                        $result1 = $mysqli->query($sql1);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);

                        $id_ta = $row1[0];
                        $estado = $row1[1];
                        $ubicacion = $row1[2];
                        $propietario= $row1[3];

                        if ($estado=='1') {
                            $estado_si='selected';
                        }else{
                            $estado_si='';
                        }

                        if ($estado=='0') {
                            $estado_no='selected';
                        }else{
                            $estado_no='';
                        }
                    }

                    ?>

                    <form method=POST action="editar.php">
                        <tr>
                            <td bgcolor="#CCEECC" align=center>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>ID:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                 <input type="number"  value=<?php echo $id_ta; ?> disabled>
                                 <input type="hidden" name="id_tarjeta" value=<?php echo $id_ta; ?> >
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Propietario</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="text" name="propietario" value= "<?php echo $propietario; ?>" required>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Ubicación</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="text" name="ubicacion" value= <?php echo $ubicacion; ?>  required>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Estado:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <div class="dropdown">
                                    <select class="btn btn-secondary" name="estado" >
                                        <option value="1" <?php echo $estado_si;?> >Activo</option>
                                        <option value="0" <?php echo $estado_no;?> >Inactivo</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=2>
                                <input type="hidden" name="enviado" value="S1">
                                <input type="submit" value="Editar" name="editar">
                            </td>
                        </tr>
                    </form>

                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
