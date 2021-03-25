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
                                <font color=white>Fiebre Amarilla</font>
                            </h1>
                        </td>
                    </tr>

                    <?php
                        if ((isset($_POST["enviado"]))){  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
                            $enviado = $_POST["enviado"];
                            if ($enviado == "S1"){
                                $temp_max_fiebre = $_POST["temp_max_fiebre"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
                                $hum_max_fiebre = $_POST["hum_max_fiebre"];
                                $temp_max_dengue = $_POST["temp_max_dengue"];
                                $hum_max_dengue = $_POST["hum_max_dengue"];
                                $llu_fiebre=$_POST["opt_fiebre"];
                                $llu_dengue=$_POST["opt_dengue"];

                                $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos.
                                // se actualiza la tabla de valores m�ximos
                                $sql3 = "UPDATE datos_maximos set max_temp='$temp_max_fiebre' where id=1";
                                // la siguiente l�nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi�n a la base de datos mysqli
                                $result1 = $mysqli->query($sql3);

                                $sql4 = "UPDATE datos_maximos set max_hum='$hum_max_fiebre' where id=1";
                                // la siguiente l�nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi�n a la base de datos mysqli
                                $result2 = $mysqli->query($sql4);

                                $sql7 = "UPDATE datos_maximos set pre_lluvia='$llu_fiebre' where id=1";
                                $result5 = $mysqli->query($sql7);

                                $sql5 = "UPDATE datos_maximos set max_temp='$temp_max_dengue' where id=2";
                                $result3 = $mysqli->query($sql5);

                                $sql6 = "UPDATE datos_maximos set max_hum='$hum_max_dengue' where id=2";
                                $result4 = $mysqli->query($sql6);

                                $sql8 = "UPDATE datos_maximos set pre_lluvia='$llu_dengue' where id=2";
                                $result6 = $mysqli->query($sql8);

                                if (($result1 == 1)&&($result2 == 1)&&($result3 == 1)&&($result4 == 1)&&($result5 == 1)&&($result6 == 1)){
                                    $mensaje = "Datos actualizados correctamente";
                                }else{
                                    $mensaje = "Inconveniente actualizando datos";
                                    header('Location: rangos.php?mensaje='.$mensaje);
                                }
                            }   // FIN DEL IF, si ya se han recibido los datos del formulario
                        }   // FIN DEL IF, si la variable enviado existe, que es cuando ya se env�o el formulario

                        // AQUI CONSULTA LOS VALORES ACTUALES DE HUMEDAD y TEMPERATURA, PARA PRESENTARLOS EN EL FORMULARIO
                        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                        $sql1 = "SELECT * from datos_maximos where id=1";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        // CONSULTA FIEBRE AMARILLA
                        $result1 = $mysqli->query($sql1);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);
                        $temp_max_fiebre = $row1[2];
                        $hum_max_fiebre = $row1[3];
                        $lluvia_fiebre = $row1[4];
                        if ($lluvia_fiebre=='1') {
                            $var_lluF_si='selected';
                        }else{
                            $var_lluF_si='';
                        }
                        if ($lluvia_fiebre=='0') {
                            $var_lluF_no='selected';
                        }else{
                            $var_lluF_no='';
                        }
                        // CONSULTA DENGUE
                        $sql2 = "SELECT * from datos_maximos where id=2";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result2 = $mysqli->query($sql2);
                        $row2 = $result2->fetch_array(MYSQLI_NUM);
                        $temp_max_dengue = $row2[2];
                        $hum_max_dengue = $row2[3];
                        $lluvia_dengue = $row2[4];
                        if ($lluvia_dengue=='1') {
                            $var_lluD_si='selected';
                        }else{
                            $var_lluD_si='';
                        }
                        if ($lluvia_dengue=='0') {
                            $var_lluD_no='selected';
                        }else{
                            $var_lluD_no='';
                        }
                        if ((isset($_GET["mensaje"]))){
                            $mensaje = $_GET["mensaje"];
                            echo '<tr>
                            <td bgcolor="#EEEEFF" align=center colspan=2>
                            <font FACE="arial" SIZE=2 color="#000044"> <b>'.$mensaje.'</b></font>
                            </td>
                            </tr>';
                        }
                    ?>

                    <form method=POST action="rangos.php">
                        <tr>
                            <td bgcolor="#EEEEEE" align=center>
                                <font FACE="arial" SIZE=2 color="#000044">
                                    <b>Valor Maximo Temperatura:</b>
                                </font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="number" name="temp_max_fiebre" value="<?php echo $temp_max_fiebre; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center>
                                <font FACE="arial" SIZE=2 color="#000044">
                                    <b>Valor Maximo Humedad:</b>
                                </font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="number" name="hum_max_fiebre" value="<?php echo $hum_max_fiebre; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center>
                                <font FACE="arial" SIZE=2 color="#000044">
                                    <b>Presencia de lluvia:</b>
                                </font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <div class="dropdown">
                                    <select class="btn btn-secondary" name="opt_fiebre">
                                        <option value="1" <?php echo $var_lluF_si;?>>Si</option>
                                        <option value="0" <?php echo $var_lluF_no;?>>No</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" align=center width=80& colspan=6 bgcolor="#281E5D">
                                <h1>
                                    <font color=white>Dengue</font>
                                </h1>
                            </td>
                        </tr><tr>
                            <td bgcolor="#EEEEEE" align=center>
                                <font FACE="arial" SIZE=2 color="#000044">
                                    <b>Valor Maximo Temperatura:</b>
                                </font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="number" name="temp_max_dengue" value="<?php echo $temp_max_dengue; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center>
                                <font FACE="arial" SIZE=2 color="#000044">
                                    <b>Valor Maximo Humedad:</b>
                                </font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="number" name="hum_max_dengue" value="<?php echo $hum_max_dengue; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center>
                                <font FACE="arial" SIZE=2 color="#000044">
                                    <b>Presencia de lluvia:</b>
                                </font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <div class="dropdown">
                                    <select class="btn btn-secondary" name="opt_dengue">
                                        <option value="1" <?php echo $var_lluD_si;?>>Si</option>
                                        <option value="0" <?php echo $var_lluD_no;?>>No</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=2>
                                <input type="hidden" name="enviado" value="S1">
                                <input type="submit" value="Actualizar" name="Actualizar">
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
