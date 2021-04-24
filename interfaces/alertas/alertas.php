<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/conexion.php";
    include $root;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <?php
            $head = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/head.php";
            include $head;
        ?>

        <meta http-equiv="refresh" content="15"/>
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
                        <td valign="center" align=center width=80% colspan=9>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
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
                        <td valign="center" align=center>
                            <?php echo $contador; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $ID_TARJ_fiebre; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $fecha_fiebre; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $hora_fiebre; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $temp_fiebre." *C"; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $hum_fiebre." %"; ?>
                        </td>
                        <td valign="center" align=center>

                            <?php
                                if ($temp_fiebre > $temp_max_fiebre){
                            ?>

                            <img src="/ehealth/static/img/warning_y.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/ehealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        <td valign="center" align=center>

                            <?php
                                if ($hum_fiebre > $hum_max_fiebre){
                            ?>

                            <img src="/ehealth/static/img/warning_r.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/ehealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        </td>
                        <td valign="center" align=center>

                          <?php
                              if ($pre_lluv_fiebre==1){
                                  if ($lluvia_fiebre == 1){
                          ?>

                          <img src="/ehealth/static/img/wet.png" width=80 height=80>

                          <?php
                                  }
                                  else{
                          ?>

                          <img src="/ehealth/static/img/dry.png" width=80 height=80>

                          <?php
                                  }
                              }
                              else{
                          ?>

                          <img src="/ehealth/static/img/cancelar.png" width=80 height=80>

                          <?php
                              }
                          ?>

                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                    <tr>
                        <td valign="center" align=center width=80% colspan=9 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Dengue</font>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>#</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
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
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Alerta Temperatura</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Alerta Humedad</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
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
                        <td valign="center" align=center>
                            <?php echo $contador1; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $ID_TARJ_dengue; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $fecha_dengue; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $hora_dengue; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $temp_dengue." *C"; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $hum_dengue." %"; ?>
                        </td>
                        <td valign="center" align=center>

                            <?php
                                if ($temp_dengue > $temp_max_dengue){
                            ?>

                            <img src="/ehealth/static/img/warning_y.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/ehealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        <td valign="center" align=center>

                            <?php
                                if ($hum_dengue > $hum_max_dengue){
                            ?>

                            <img src="/ehealth/static/img/warning_r.png" width=80 height=80>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/ehealth/static/img/comprobado.png" width=80 height=80>

                            <?php
                                }
                            ?>

                        </td>
                        <td valign="center" align=center>

                            <?php
                                if ($pre_lluv_dengue==1){
                                    if ($lluvia_dengue == 1){
                            ?>

                            <img src="/ehealth/static/img/wet.png" width=80 height=80>

                            <?php
                                    }
                                    else{
                            ?>

                            <img src="/ehealth/static/img/dry.png" width=80 height=80>

                            <?php
                                    }
                                }
                                else{
                            ?>

                            <img src="/ehealth/static/img/cancelar.png" width=80 height=80>

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
        <div id="jscripts">
            <?php
                $jscripts = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/jscripts.php";
                include $jscripts;
            ?>
        </div>
    </body>
</html>
