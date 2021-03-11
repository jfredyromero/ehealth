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
                                <a class="dropdown-item" href="/eHealth/interfaces/consultas/fechas.php">Fecha</a>
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
                        <!--
                        {% if user.is_authenticated %}
                            <li class="nav-item">
                                <a class="nav-link" href="#"><strong>Username</strong></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Moderar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Salir</a>
                            </li>
                        {% else %}
                            <li class="nav-item">
                                <a class="nav-link" href="#">Aporta</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Ingresa</a>
                            </li>
                        {% endif %}
                        -->
                    </ul>
                </div>
            </nav>
            <div id="page-content">
                <table width="80%" align=center cellpadding=5 border=1>
                    <tr>
                        <td valign="top" align=center width=80& colspan=7>
                            <img src="/eHealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center width=80& colspan=7 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Ultimos datos medidos del Invernadero Automatizado # 1</font>
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
                            <b>Presencia de lluvia</b>
                        </td>
                    </tr>

                    <?php
                    // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
                    $sql1 = "SELECT * from datos_medidos order by id DESC LIMIT 12"; // Aqu� se ingresa el valor recibido a la base de datos.
                    // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                    $result1 = $mysqli->query($sql1);
                    // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
                    // tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
                    // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
                    $contador = 0;
                    while($row1 = $result1->fetch_array(MYSQLI_NUM)){
                        $ID_TARJ = $row1[1];
                        $temp = $row1[2];
                        $hum = $row1[3];
                        $fecha = $row1[4];
                        $hora = $row1[5];
                        if($row1[6] == 1){
                            $lluvia='Si';
                        }else{
                            $lluvia='No';
                        }
                        $contador++;
                    ?>

                    <tr>
                        <td valign="top" align=center>
                            <?php echo $contador; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $ID_TARJ; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $fecha; ?>
                        </td>
                        <td valign="top" align=center>
                        <?php echo $hora; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $temp." *C"; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $hum." %"; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php echo $lluvia; ?>
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
