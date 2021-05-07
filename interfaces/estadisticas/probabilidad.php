<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $autenticacion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/autenticacion_sesion.php";
    include $autenticacion;
    //style="border: solid 2px;" -- Para el borde de las tablas.
?>

<!DOCTYPE HTML>
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
                        <td valign="center" align=center width=80% colspan=9>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center width=80%  bgcolor="#281E5D">
                            <h1>
                                <font color=white>Probabilidad de contagio en una fecha específica</font>
                            </h1>
                        </td>
                    </tr>
                </table>

                <?php
                    $mysqli = new mysqli($host, $user, $pw, $db);
                    $sql1="SELECT id_tarjeta from datos_dispositivos where estado=1";
                    $result1 = $mysqli->query($sql1);
                    $contador=0;
                    if(isset($_GET["confir"])){
                        $confir=$_GET["confir"];
                        if ($confir==1) {
                                $probabilidad_fa_dia=$_GET["mensaje"];
                                if($probabilidad_fa_dia<0.5){
                                    $var_nivel_fa_dia=1;
                                    $var_color_fa_dia=0;
                                }else if ($probabilidad_fa_dia>0.5 && $probabilidad_fa_dia<0.75) {
                                    $var_nivel_fa_dia=2;
                                    $var_color_fa_dia=1;
                                }else{
                                    $var_nivel_fa_dia=3;
                                    $var_color_fa_dia=2;
                                }
                                $probabilidad_dengue_dia=$_GET["mensaje1"];
                                if($probabilidad_dengue_dia<0.5){
                                    $var_nivel_d_dia=1;
                                    $var_color_d_dia=0;
                                }else if ($probabilidad_dengue_dia>0.5 && $probabilidad_dengue_dia<0.75) {
                                    $var_nivel_d_dia=2;
                                    $var_color_d_dia=1;
                                }else{
                                    $var_nivel_d_dia=3;
                                    $var_color_d_dia=2;
                                }
                                $probabilidad_fa_noche=$_GET["mensaje2"];
                                if($probabilidad_fa_noche<0.5){
                                    $var_nivel_fa_noche=1;
                                    $var_color_fa_noche=0;
                                }else if ($probabilidad_fa_noche>0.5 && $probabilidad_fa_noche<0.75) {
                                    $var_nivel_fa_noche=2;
                                    $var_color_fa_noche=1;
                                }else{
                                    $var_nivel_fa_noche=3;
                                    $var_color_fa_noche=2;
                                }
                                $probabilidad_dengue_noche=$_GET["mensaje3"];
                                if($probabilidad_dengue_noche<0.5){
                                    $var_nivel_d_noche=1;
                                    $var_color_d_noche=0;
                                }else if ($probabilidad_dengue_noche>0.5 && $probabilidad_dengue_noche<0.75) {
                                    $var_nivel_d_noche=2;
                                    $var_color_d_noche=1;
                                }else{
                                    $var_nivel_d_noche=3;
                                    $var_color_d_noche=2;
                                }
                                ?>
                                <table width="80%" align=center cellpadding=5 border=0>
                                    <tr height="20"></tr>
                                    <tr >
                                    <td style="border: none" valign="center" align=center width=80% colspan=9>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm-5" align=center><font FACE="arial" SIZE=4 color="#000044"><b>Escoja una de las tarjetas activas:</b></font><br>
                                                    <form method=POST action="/ehealth/procesos/calculo_probabilidad.php">
                                                        <div class="row-sm-1 justify-content-center">
                                                            <div class="dropdown">
                                                                <select class="btn btn-primary" name="tarj_activa" required>
                                                                    <option value="">Id</option>
                                                                    <?php while ($row2 = $result1->fetch_array(MYSQLI_NUM)) {
                                                                        $id_tarj=$row2[0];
                                                                        $contador++; ?>
                                                                    <option value="<?php echo $id_tarj;?>"><?php echo $id_tarj?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row-sm-1 justify-content-center" >
                                                            <font FACE="arial" SIZE=4 color="#000044"> <b>Fecha Inicial:</b></font><br>
                                                                <input type="date" name="fecha_ini" value="" required>
                                                        </div>
                                                        <div class="row-sm-1 justify-content-center" >
                                                            <font FACE="arial" SIZE=4 color="#000044"> <b>Fecha Final:</b></font><br>
                                                                <input type="date" name="fecha_fin" value="" required>
                                                        </div><br>
                                                        <div class="row-sm-1 justify-content-center">
                                                            <input type="hidden" name="enviado" value="graficar">
                                                            <button style="background-color:#281E5D; color:white" value="graficar" type="submit" class="btn btn-lg" name="graficar"><i style="background-color:#281E5D; color:white" class="fas fa-sync"></i><span class="pl-3">Graficar</span></button>
                                                        </div> <br>
                                                        <div class="row-sm-1 justify-content-center" style="background-color:#281E5D">
                                                            <font FACE="arial" SIZE=4 color="white"> <b>-Datos consultados-</b></font><br>
                                                        </div>
                                                        <div class="row-sm-1 justify-content-left" style="background-color:#35287d">
                                                            <font FACE="arial" SIZE=3 color="white"><u><b>Id:</b></u> <?php echo $_GET["id"]?></font><br>
                                                        </div>
                                                        <div class="row-sm-1 justify-content-center" style="background-color:#35287d">
                                                            <font FACE="arial" SIZE=3 color="white"><u><b>Propietario:</b></u> <?php echo $_GET["nombre"]?></font><br>
                                                        </div>
                                                        <div class="row-sm-1 justify-content-center" style="background-color:#35287d">
                                                            <font FACE="arial" SIZE=3 color="white"><u><b>Fecha inicial:</b></u> <?php echo $_GET["fe_ini"]?></font><br>
                                                        </div>
                                                        <div class="row-sm-1 justify-content-center" style="background-color:#35287d">
                                                            <font FACE="arial" SIZE=3 color="white"><u><b>Fecha final:</b></u> <?php echo $_GET["fe_fin"]?></font><br>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-sm-7" >
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <div id="container" style="width: 350px; height: 305px;"></div>
                                                            <br><br>
                                                        </div>
                                                        <div class="col-sm-1 justify-content-left">
                                                            <img src="/ehealth/static/img/sunny.png" width=70 height=70>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <div id="container2" style="width: 350px; height: 305px;"></div>
                                                            <br><br>
                                                        </div>
                                                        <div class="col-sm-1 justify-content-left">
                                                            <img src="/ehealth/static/img/moon.png" width=70 height=70>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                </table>
                    <?php
                        }else{ ?>
                            <table width="80%" align=center cellpadding=5 border=0>
                            <tr height="20"></tr>
                            <tr>
                            <td style="border: none"valign="center" align=center width=80% colspan=9>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-5" align=center><font FACE="arial" SIZE=4 color="#000044"><b>Escoja una de las tarjetas activas:</b></font><br>
                                            <form method=POST action="/ehealth/procesos/calculo_probabilidad.php">
                                                <div class="row-sm-1 justify-content-center">
                                                    <div class="dropdown">
                                                        <select class="btn btn-primary" name="tarj_activa" required>
                                                            <option value="">Id</option>
                                                            <?php while ($row2 = $result1->fetch_array(MYSQLI_NUM)) {
                                                                $id_tarj=$row2[0];
                                                                $contador++; ?>
                                                            <option value="<?php echo $id_tarj;?>"><?php echo $id_tarj?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row-sm-1 justify-content-center" >
                                                    <font FACE="arial" SIZE=4 color="#000044"> <b>Fecha Inicial:</b></font><br>
                                                        <input type="date" name="fecha_ini" value="" required>
                                                </div>
                                                <div class="row-sm-1 justify-content-center" >
                                                    <font FACE="arial" SIZE=4 color="#000044"> <b>Fecha Final:</b></font><br>
                                                        <input type="date" name="fecha_fin" value="" required>
                                                </div><br>
                                                <div class="row-sm-1 justify-content-center">
                                                    <input type="hidden" name="enviado" value="graficar">
                                                    <button style="background-color:#281E5D; color:white" value="graficar" type="submit" class="btn btn-lg" name="graficar"><i style="background-color:#281E5D; color:white" class="fas fa-sync"></i><span class="pl-3">Graficar</span></button>
                                                </div><br>
                                                <div class="row-sm-1 justify-content-center" style="background-color:#a61308">
                                                    <font FACE="arial" SIZE=4 color="white"> <b>-ERROR-</b></font><br>
                                                </div>
                                                <div class="row-sm-1 justify-content-center" style="background-color:#b51f14">
                                                    <font FACE="arial" SIZE=3 color="white"><b>No hay registros en las fechas seleccionadas:</b></font><br>
                                                </div>
                                                <div class="row-sm-1 justify-content-center" style="background-color:#b51f14">
                                                    <font FACE="arial" SIZE=3 color="white"><u><b>Fecha inicial:</b></u> <?php echo $_GET["fe_ini"]?></font><br>
                                                </div>
                                                <div class="row-sm-1 justify-content-center" style="background-color:#b51f14">
                                                    <font FACE="arial" SIZE=3 color="white"><u><b>Fecha final:</b></u> <?php echo $_GET["fe_fin"]?></font><br>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-5" >
                                            <div class="row">
                                            <img src="/ehealth/static/img/probabilidad.png" width=450 height=350>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            </tr>
                        </table>
                <?php }
                    }else{ ?>
                        <table width="80%" align=center cellpadding=5 border=0>
                            <tr height="20"></tr>
                            <tr>
                            <td style="border: none"valign="center" align=center width=80% colspan=9>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-4" align=center><font FACE="arial" SIZE=4 color="#000044"><b>Escoja una de las tarjetas activas:</b></font><br>
                                            <form method=POST action="/ehealth/procesos/calculo_probabilidad.php">
                                                <div class="row-sm-1 justify-content-center">
                                                    <div class="dropdown">
                                                        <select class="btn btn-primary" name="tarj_activa" required>
                                                            <option value="">Id</option>
                                                            <?php while ($row2 = $result1->fetch_array(MYSQLI_NUM)) {
                                                                $id_tarj=$row2[0];
                                                                $contador++; ?>
                                                            <option value="<?php echo $id_tarj;?>"><?php echo $id_tarj?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row-sm-1 justify-content-center" >
                                                    <font FACE="arial" SIZE=4 color="#000044"> <b>Fecha Inicial:</b></font><br>
                                                        <input type="date" name="fecha_ini" value="" required>
                                                </div>
                                                <div class="row-sm-1 justify-content-center" >
                                                    <font FACE="arial" SIZE=4 color="#000044"> <b>Fecha Final:</b></font><br>
                                                        <input type="date" name="fecha_fin" value="" required>
                                                </div><br>
                                                <div class="row-sm-1 justify-content-center">
                                                    <input type="hidden" name="enviado" value="graficar">
                                                    <button style="background-color:#281E5D; color:white" value="graficar" type="submit" class="btn btn-lg" name="graficar"><i style="background-color:#281E5D; color:white" class="fas fa-sync"></i><span class="pl-3">Graficar</span></button>
                                                </div><br>
                                            </form>
                                        </div>
                                        <div class="col-sm-5" >
                                            <div class="row">
                                            <img src="/ehealth/static/img/probabilidad.png" width=450 height=350>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            </tr>
                        </table>
                <?php  } ?>
            </div>
        </div>

        <div id="jscripts">
            <?php
                $jscripts = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/jscripts.php";
                include $jscripts;
            ?>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.js"></script>
            <script type="text/javascript">
                $(function () {
                    var color=["green","orange","red"];
                    var labels=['Bajo','Medio','Alto'];
                    //DIA
                    var nivel_dia_fa=<?php echo $var_nivel_fa_dia;?>;
                    var color_dia_fa_pos=<?php echo $var_color_fa_dia;?>;
                    var nivel_dia_d=<?php echo $var_nivel_d_dia;?>;
                    var color_dia_d_pos=<?php echo $var_color_d_dia;?>;
                    //NOCHE
                    var nivel_noche_fa=<?php echo $var_nivel_fa_noche;?>;
                    var color_noche_fa_pos=<?php echo $var_color_fa_noche;?>;
                    var nivel_noche_d=<?php echo $var_nivel_d_noche;?>;
                    var color_noche_d_pos=<?php echo $var_color_d_noche;?>;

                    $('#container').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            style: {
                                color: '#281E5D',
                                fontWeight: 'bold'
                            },
                            text: 'Probabilidad de contraer una enfermedad'
                        },
                        xAxis: {
                            categories: ['Fiebre Amarilla','Dengue']
                        },
                        yAxis: {
                            title: {
                                style: {
                                    color: '#281E5D',
                                    fontWeight: 'bold'
                                },
                                text: 'Probabilidad'
                            },
                            labels:{
                                formatter: function(){
                                    return labels[this.pos -1]
                                }
                            }
                        },
                        plotOptions: {
                            series: {
                                colorByPoint: true
                            }
                        },
                        series: [{
                            name:'Riesgo',
                            data: [
                                {y:nivel_dia_fa,color:color[color_dia_fa_pos]},
                                {y:nivel_dia_d,color:color[color_dia_d_pos]},
                            ]
                        }]
                    });
                    $('#container2').highcharts({
                        chart: {
                            type: 'column'
                        },
                        title: {
                            style: {
                                color: '#281E5D',
                                fontWeight: 'bold'
                            },
                            text: 'Probabilidad de contraer una enfermedad'
                        },
                        xAxis: {
                            categories: ['Fiebre Amarilla','Dengue']
                        },
                        yAxis: {
                            title: {
                                style: {
                                    color: '#281E5D',
                                    fontWeight: 'bold'
                                },
                                text: 'Probabilidad'
                            },
                            labels:{
                                formatter: function(){
                                    return labels[this.pos -1]
                                }
                            }
                        },
                        plotOptions: {
                            series: {
                                colorByPoint: true
                            }
                        },
                        series: [{
                            name:'Riesgo',
                            data: [
                                {y:nivel_noche_fa,color:color[color_noche_fa_pos]},
                                {y:nivel_noche_d,color:color[color_noche_d_pos]},
                            ]
                        }]
                    });
                });
            </script>
        </div>
    </body>
</html>
