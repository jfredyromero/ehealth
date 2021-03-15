<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/eHealth/static/php/conexion.php";
    include $root;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>eHealth</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="/eHealth/static/css/styles.css" rel="stylesheet">
        <meta http-equiv="refresh" content="15"/>
    </head>
    <body background="/eHealth/static/img/background.jpg">
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
                            <a class="nav-link" href="/eHealth/interfaces/consultas/ultimos.php">
                                Últimos
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Consultas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/eHealth/interfaces/consultas/ultimos.php">Últimos</a>
                                <a class="dropdown-item" href="/eHealth/interfaces/consultas/fechas.php">Fechas</a>
                                <a class="dropdown-item" href="/eHealth/interfaces/consultas/dispositivos.php">Dispositivos</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/eHealth/interfaces/probabilidades/probabilidades.php">Probabilidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/eHealth/interfaces/rangos/rangos.php">Rangos</a>
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
                        <td valign="center" align=center width=80% colspan=9>
                            <img src="/eHealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center width=80% colspan=9 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Fiebre Amarilla</font>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center bgcolor="#E1E1E1" width=40>
                            <b>#</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1" width=40>
                            <b>ID</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Fecha</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Hora</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Temperatura</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Humedad</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1" width=120>
                            <b>Alerta Temperatura</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1" width=120>
                            <b>Alerta Humedad</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1" width=120>
                            <b>Alerta Lluvia</b>
                        </td>
                    </tr>

                    <?php
                        // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
                        // CONSULTA TEMPERATURA MAXIMA
                        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                        $sql1_fiebre = "SELECT max_temp from datos_maximos where id=1";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result2_fiebre = $mysqli->query($sql1_fiebre);
                        $row2_fiebre = $result2_fiebre->fetch_array(MYSQLI_NUM);
                        $temp_max_fiebre = $row2_fiebre[0];

                        // CONSULTA HUMEDAD MAXIMA
                        $sql3_fiebre = "SELECT max_hum from datos_maximos where id=1";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result3_fiebre = $mysqli->query($sql3_fiebre);
                        $row3_fiebre = $result3_fiebre->fetch_array(MYSQLI_NUM);
                        $hum_max_fiebre = $row3_fiebre[0];

                        // CONSULTA PRESENCIA DE LLUVIA OJO: no es necesario en este caso pero para la probabilidad SI
                        $sql4_fiebre = "SELECT pre_lluvia from datos_maximos where id=1";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result4_fiebre = $mysqli->query($sql4_fiebre);
                        $row4_fiebre = $result4_fiebre->fetch_array(MYSQLI_NUM);
                        $pre_lluv_fiebre = $row4_fiebre[0];

                        $sql1_fiebre = "SELECT * from datos_medidos order by id DESC LIMIT 5"; // Aqu� se ingresa el valor recibido a la base de datos.
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result1_fiebre = $mysqli->query($sql1_fiebre);
                        // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
                        // tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
                        // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
                        $contador = 0;
                        while($row1 = $result1_fiebre->fetch_array(MYSQLI_NUM)){
                        $ID_TARJ_fiebre = $row1[1];
                        $temp_fiebre = $row1[2];
                        $hum_fiebre = $row1[3];
                        $fecha_fiebre = $row1[4];
                        $hora_fiebre = $row1[5];
                        $lluvia_fiebre=$row1[6];
                        $contador++;
                    ?>

                    <tr>
                        <td valign="top" align=center>
                            <?php echo $contador; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $ID_TARJ_fiebre; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $fecha_fiebre; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $hora_fiebre; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $temp_fiebre." *C"; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $hum_fiebre." %"; ?>
                        </td>
                        <td valign="top" align=center>

                            <?php
                                if ($temp_fiebre > $temp_max_fiebre){
                            ?>

                            <img src="/eHealth/static/img/warning_y.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/eHealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        <td valign="top" align=center>

                            <?php
                                if ($hum_fiebre > $hum_max_fiebre){
                            ?>

                            <img src="/eHealth/static/img/warning_r.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/eHealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        </td>
                        <td valign="top" align=center>

                            <?php
                                if ($lluvia_fiebre == $pre_lluv_fiebre){
                            ?>

                            <img src="/eHealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/eHealth/static/img/cancelar.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                    <tr>
                        <td valign="top" align=center width=80% colspan=9 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Dengue</font>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>#</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Id de la Tarjeta</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Fecha</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Hora</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Temperatura</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Humedad</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Alerta Temperatura</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Alerta Humedad</b>
                        </td>
                        <td valign="top" align=center bgcolor="#E1E1E1">
                            <b>Alerta Lluvia</b>
                        </td>
                    </tr>
                    <?php
                        // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
                        // CONSULTA TEMPERATURA MAXIMA
                        $mysqli1 = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                        $sql1_dengue = "SELECT max_temp from datos_maximos where id=2";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result2_dengue = $mysqli1->query($sql1_dengue);
                        $row2_dengue = $result2_dengue->fetch_array(MYSQLI_NUM);
                        $temp_max_dengue = $row2_dengue[0];

                        // CONSULTA HUMEDAD MAXIMA
                        $sql3_dengue = "SELECT max_hum from datos_maximos where id=2";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result3_dengue = $mysqli1->query($sql3_dengue);
                        $row3_dengue = $result3_dengue->fetch_array(MYSQLI_NUM);
                        $hum_max_dengue = $row3_dengue[0];

                       // CONSULTA PRESENCIA DE LLUVIA OJO: no es necesario en este caso pero para la probabilidad SI
                       $sql4_dengue = "SELECT pre_lluvia from datos_maximos where id=2";
                       // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                       $result4_dengue = $mysqli1->query($sql4_dengue);
                       $row4_dengue = $result4_dengue->fetch_array(MYSQLI_NUM);
                       $pre_lluv_dengue = $row4_dengue[0];

                        $sql1_dengue = "SELECT * from datos_medidos order by id DESC LIMIT 5"; // Aqu� se ingresa el valor recibido a la base de datos.
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result1_dengue = $mysqli1->query($sql1_dengue);
                        // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
                        // tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
                        // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
                        $contador1 = 0;
                        while($row11 = $result1_dengue->fetch_array(MYSQLI_NUM)){
                        $ID_TARJ_dengue = $row11[1];
                        $temp_dengue = $row11[2];
                        $hum_dengue = $row11[3];
                        $fecha_dengue = $row11[4];
                        $hora_dengue = $row11[5];
                        $lluvia_dengue=$row11[6];
                        $contador1++;
                    ?>

                    <tr>
                        <td valign="top" align=center>
                            <?php echo $contador1; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $ID_TARJ_dengue; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $fecha_dengue; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $hora_dengue; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $temp_dengue." *C"; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $hum_dengue." %"; ?>
                        </td>
                        <td valign="top" align=center>

                            <?php
                                if ($temp_dengue > $temp_max_dengue){
                            ?>

                            <img src="/eHealth/static/img/warning_y.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/eHealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        <td valign="top" align=center>

                            <?php
                                if ($hum_dengue > $hum_max_dengue){
                            ?>

                            <img src="/eHealth/static/img/warning_r.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/eHealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        <td valign="top" align=center>

                            <?php
                                if ($lluvia_dengue == $pre_lluv_dengue){
                            ?>

                            <img src="/eHealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/eHealth/static/img/cancelar.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
