<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $autenticacion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/autenticacion_sesion.php";
    include $autenticacion;
    $validacion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/validar_acceso.php";
    include $validacion;
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
                        <td valign="center" align=center width=100% colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Consulta de usuarios eHealth</font>
                            </h1>
                        </td>
                    </tr>
                </table>
                <table width="90%" align=center cellpadding=5 border=0>
                    <tr height=20>
                    </tr>
                    <tr>
                        <form method="POST">
                            <td style="border: none;" valign="center" align=center colspan=2>
                                <input type="Text" class="form-control" name="nombre_buscar" placeholder="Buscar por nombre...">
                            </td>
                            <td style="border: none;" valign="center" align=right colspan=2>
                                <input type="number" class="form-control" name="iden_buscar" placeholder="Buscar por Identificación...">
                            </td>
                            <td style="border: none;" valign="center" align=right colspan=2>
                                <button style="background-color:#281E5D; color:white" value="Buscar" type="submit" class="btn btn-lg" name="submit"><i style="background-color:#281E5D; color:white" class="fas fa-search"></i><span class="pl-3">Buscar</span></button>
                            </td>
                        </form>
                    </tr>
                </table>
                <table width="90%" align=center cellpadding=5 border=1>
                    <tr>
                        <?php
                            $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                            if (isset($_POST["submit"])) {
                                $nombre_buscar=$_POST["nombre_buscar"];
                                $identi_buscar=$_POST["iden_buscar"];
                                if ($nombre_buscar==null && $identi_buscar==null) { 
                                    // Si los campos estan vacios....
                        ?>
                                    <tr height=20>
                                    </tr>
                                    <tr>
                                        <td valign="center" align=center bgcolor="#E1E1E1" colspan=6>
                                            <b>No se puede realizar búsqueda - Por favor ingrese un valor</b>
                                        </td>
                                    </tr>
                                    <tr height=20>
                                    </tr>
                                    <tr height=50>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Nombre de usuario</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Identificacion</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1" width=140>
                                            <b>Direccion</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1" width=80>
                                            <b>Login</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Tipo de Usuario</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Editar</b>
                                        </td>
                                <?php
                                    $sql1 = "SELECT * from datos_usuarios"; // Aqu� se ingresa el valor recibido a la base de datos.
                                    $result1 = $mysqli->query($sql1);
                                    $contador=0;
                                    //$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                    $sql2 = "SELECT * from datos_usuarios"; // Aqu� se ingresa el valor recibido a la base de datos.
                                    $result2 = $mysqli->query($sql2);
                                    while ($row1 = $result2->fetch_array(MYSQLI_NUM)) {
                                        $NombreDeUsuario = $row1[1];
                                        $Numero_Id = $row1[2];
                                        $Direccion = $row1[3];
                                        $Login = $row1[4];
                                        $tipoDeUsuario=$row1[6];
                                        $contador ++;
                                ?>
                                    <tr height=60>
                                        <td valign="center" align=center>
                                            <?php echo $NombreDeUsuario; ?>
                                        </td>
                                        <td valign="center" align=center>
                                            <?php echo $Numero_Id; ?>
                                        </td>
                                        <td valign="center" align=center width=140>
                                            <?php echo $Direccion; ?>
                                        </td>
                                        <td valign="center" align=center width=80>
                                            <?php echo $Login; ?>
                                        </td>
                                        <td valign="center" align=center>
                                            <?php
                                                if($tipoDeUsuario==1){
                                                    echo 'Administrador';
                                                }else {
                                                    echo 'Consulta';
                                                }
                                            ?>
                                        </td>
                                        <td valign="center" align=center>
                                            <?php
                                                if ($tipoDeUsuario == 0){
                                            ?>
                                                <a class="btn btn-lg btn-block" href="/ehealth/interfaces/usuarios/consulta/editar.php?identificacion=<?php echo $Numero_Id; ?>" role="button">
                                                    <img src="/ehealth/static/img/dibujar.png" width=32 height=32>
                                                </a>

                                            <?php 
                                                } 
                                            ?>
                                        </td>
                                <?php 
                                }
                            }else{
                                // Si alguno de los campos tiene texto 
                                ?>
                            </tr>
                                    <?php
                                        if($identi_buscar!=null){
                                        // Si se busca por identificacion
                                        $sql5 = "SELECT * from datos_usuarios WHERE identificacion LIKE '%$identi_buscar%' order by identificacion";
                                        $result5=$mysqli->query($sql5);
                                        $row5 = $result5->fetch_array(MYSQLI_NUM);
                                            if($row5 == NULL){
                                                $sql1 = "SELECT * from datos_usuarios";
                                    ?>
                                                <tr height=20>
                                                </tr>
                                                 <tr>
                                                    <td valign="center" align=center bgcolor="#E1E1E1" colspan=6>
                                                        <b>No hay usuarios con un identificador similar a:<?php echo $identi_buscar?></b>
                                                    </td>
                                                </tr>

                                    <?php

                                            }else{
                                            $sql1 = "SELECT * from datos_usuarios WHERE identificacion LIKE '%$identi_buscar%' order by identificacion";
                                            }
                                    }
                                    if($nombre_buscar!=null){
                                        // Si se busca por nombre
                                        $sql5 = "SELECT * from datos_usuarios where nombre_completo LIKE '%$nombre_buscar%' order by nombre_completo";
                                        $result5=$mysqli->query($sql5);
                                        $row5 = $result5->fetch_array(MYSQLI_NUM);
                                            if($row5 == NULL){
                                                $sql1 = "SELECT * from datos_usuarios";
                                                ?>
                                                <tr height=20>
                                                </tr>
                                                <tr>
                                                   <td valign="center" align=center bgcolor="#E1E1E1" colspan=6>
                                                       <b>No hay usuarios con un nombre similar a: <?php echo $nombre_buscar?></b>
                                                   </td>
                                               </tr>

                                   <?php
                                            }else{
                                            $sql1 = "SELECT * from datos_usuarios where nombre_completo LIKE '%$nombre_buscar%' order by nombre_completo";
                                            }
                                    }?>
                                    <tr height=20>
                                    </tr>
                                    <tr height=50>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Nombre de usuario</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Identificacion</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1" width=140>
                                            <b>Direccion</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1" width=80>
                                            <b>Login</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Tipo de Usuario</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Editar</b>
                                        </td>
                                    <?php
                                    $result3 = $mysqli->query($sql1);
                                    while ($row1 = $result3->fetch_array(MYSQLI_NUM)) {
                                        $NombreDeUsuario = $row1[1];
                                        $Numero_Id = $row1[2];
                                        $Direccion = $row1[3];
                                        $Login = $row1[4];
                                        $tipoDeUsuario=$row1[6];
                                    ?>
                                        <tr height=60>
                                            <td valign="center" align=center>
                                                <?php echo $NombreDeUsuario; ?>
                                            </td>
                                            <td valign="center" align=center>
                                                <?php echo $Numero_Id; ?>
                                            </td>
                                            <td valign="center" align=center width=140>
                                                <?php echo $Direccion; ?>
                                            </td>
                                            <td valign="center" align=center width=80>
                                                <?php echo $Login; ?>
                                            </td>
                                            <td valign="center" align=center>
                                                <?php
                                                    if($tipoDeUsuario==1){
                                                        echo 'Administrador';
                                                    }else {
                                                        echo 'Consulta';
                                                    }
                                                ?>
                                            </td>
                                            <td valign="center" align=center>
                                                <?php
                                                    if ($tipoDeUsuario == 0){
                                                ?>
                                                    <a class="btn btn-lg btn-block" href="/ehealth/interfaces/usuarios/consulta/editar.php?identificacion=<?php echo $Numero_Id; ?>" role="button">
                                                        <img src="/ehealth/static/img/dibujar.png" width=32 height=32>
                                                    </a>

                                                <?php } ?>
                                            </td>
                                <?php } ?>
                                <tr height=20>
                                </tr>
                            </table>
                            <table width="90%" align=center cellpadding=5 border=0>
                                <tr>
                                    <td style="border: none;" valign="center" align=left colspan=3>
                                        <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/usuarios.php" role="button">
                                            <i class="fas fa-angle-double-left"></i>
                                            <span class="pl-3">Volver</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr height=20>
                                </tr>
                            <?php }

                            }else{ ?>

                            <tr height=20>
                            </tr>
                            <tr height=50>
                                <td valign="center" align=center bgcolor="#E1E1E1">
                                    <b>Nombre de usuario</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1">
                                    <b>Identificacion</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1" width=140>
                                    <b>Direccion</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1" width=80>
                                    <b>Login</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1">
                                    <b>Tipo de Usuario</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1">
                                    <b>Editar</b>
                                </td>
                        <?php
                            $sql1 = "SELECT * from datos_usuarios"; // Aqu� se ingresa el valor recibido a la base de datos.
                            $result1 = $mysqli->query($sql1);
                            $contador=0;
                            //$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                            $sql2 = "SELECT * from datos_usuarios"; // Aqu� se ingresa el valor recibido a la base de datos.
                            $result2 = $mysqli->query($sql2);
                            while ($row1 = $result2->fetch_array(MYSQLI_NUM)) {
                                $NombreDeUsuario = $row1[1];
                                $Numero_Id = $row1[2];
                                $Direccion = $row1[3];
                                $Login = $row1[4];
                                $tipoDeUsuario=$row1[6];
                                $contador ++;
                        ?>
                            <tr height=60>
                                <td valign="center" align=center>
                                    <?php echo $NombreDeUsuario; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $Numero_Id; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $Direccion; ?>
                                </td>
                                <td valign="center" align=center width=80>
                                    <?php echo $Login; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php
                                        if($tipoDeUsuario==1){
                                            echo 'Administrador';
                                        }else {
                                            echo 'Consulta';
                                        }
                                    ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php
                                        if ($tipoDeUsuario == 0){
                                    ?>
                                        <a class="btn btn-lg btn-block" href="/ehealth/interfaces/usuarios/consulta/editar.php?identificacion=<?php echo $Numero_Id; ?>" role="button">
                                            <img src="/ehealth/static/img/dibujar.png" width=32 height=32>
                                        </a>

                                    <?php } ?>
                                </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
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
