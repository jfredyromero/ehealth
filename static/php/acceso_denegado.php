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
                      <td valign="top" align=center width=80& colspan=6 bgcolor="#281E5D">
                          <h1>
                              <font color=white>Acceso Denegado</font>
                          </h1>
                          <img src="/ehealth/static/img/acceso_denegado.png" alt="Acceso Denegado">
                      </td>
                  </tr>
                  <tr>
                      <td bgcolor="#EEEEEE" align=center colspan=3>
                          <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/registros.php" role="button">
                              <i class="fas fa-angle-double-left"></i>
                              <span class="pl-3">Volver al Inicio</span>
                          </a>
                      </td>
                      <td bgcolor="#EEEEEE" align=center colspan=3>
                          <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/procesos/cerrar_sesion.php" role="button">
                              <i class="fas fa-sign-out-alt"></i>
                              <span class="pl-2">Cerrar Sesión</span>
                          </a>
                      </td>
                  </tr>
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
