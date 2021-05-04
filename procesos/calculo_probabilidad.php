<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db);
    //SELECT round(AVG(temperatura),2) as promedio from datos_medidos where fecha >= '2018-02-15' and fecha <= '2021-03-20' and id_tarjeta='1' GROUP BY EXTRACT(HOUR FROM hora) ORDER BY hora
    //SELECT * from datos_medidos where fecha >= '2018-02-15' and fecha <= '2021-03-20' and id_tarjeta='1' order by fecha
    //Dia
        //SELECT round(AVG(temperatura),2) as promedio from datos_medidos where fecha >= '2018-02-15' and fecha <= '2021-03-20' and id_tarjeta='1' and hora>='06:00:00' and hora<='18:00:00'
    //Noche
        //SELECT round(AVG(temperatura),2) as promedio from datos_medidos where fecha >= '2018-02-15' and fecha <= '2021-03-20' and id_tarjeta='1' and NOT(hora>='06:00:00' and hora<='18:00:00')
    $tarjeta_activa=$_POST["tarj_activa"];
    $fecha_ini=$_POST["fecha_ini"];
    $fecha_fin=$_POST["fecha_fin"];

    //DATOS DEL PROPIETARIO DE LA TARJETA
    $sql="SELECT propietario from datos_dispositivos where id_tarjeta='$tarjeta_activa'";
        $result1 = $mysqli->query($sql);
        $row1 = $result1->fetch_array(MYSQLI_NUM);
        $nombre = $row1[0];

    //CONSULTA VALORES MAXIMOS FIEBRE AMARILLA
    $sql1 = "SELECT * from datos_maximos where id=1";
        $result1 = $mysqli->query($sql1);
        $row1 = $result1->fetch_array(MYSQLI_NUM);
        $temp_max_fiebre = $row1[2];
        $hum_max_fiebre = $row1[3];
        $max_lluvia_fiebre = $row1[4];
    //CONSULTA PONDERADOS FIEBRE
    $sql2 = "SELECT * from datos_ponderados where id=1";
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_array(MYSQLI_NUM);
        $proba_temp_fiebre = $row2[2]/100;
        $proba_hum_fiebre = $row2[3]/100;
        $proba_lluvia_fiebre = $row2[4]/100;
    //CONSULTA VALORES MAXIMOS DENGUE
    $sql3 = "SELECT * from datos_maximos where id=2";
        $result3 = $mysqli->query($sql3);
        $row3 = $result3->fetch_array(MYSQLI_NUM);
        $temp_max_dengue = $row3[2];
        $hum_max_dengue = $row3[3];
        $max_lluvia_dengue = $row3[4];
    //CONSULTA PONDERADOS DENGUE
    $sql4 = "SELECT * from datos_ponderados where id=2";
        $result4 = $mysqli->query($sql4);
        $row4 = $result4->fetch_array(MYSQLI_NUM);
        $proba_temp_dengue = $row4[2]/100;
        $proba_hum_dengue = $row4[3]/100;
        $proba_lluvia_dengue = $row4[4]/100;

    /******************************************************************
    *CONSULTA DE PROMEDIOS DE VARIABLES EN EL DÍA PARA FIEBRE AMARILLA*
    *******************************************************************/

    $sql="SELECT round(AVG(temperatura),2) as promedio FROM datos_medidos WHERE fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and hora>='06:00:00' and hora<='18:00:00'";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $prom_temp_dia = $row[0];
        $PROB_TEMP_DIA=$prom_temp_dia/$temp_max_fiebre;
        if ($PROB_TEMP_DIA>1) {
            $PROB_TEMP_DIA=1;
        }

    $sql="SELECT round(AVG(humedad),2) as promedio FROM datos_medidos WHERE fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and hora>='06:00:00' and hora<='18:00:00'";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $prom_hum_dia = $row[0];
        $PROB_HUM_DIA=$prom_hum_dia/$hum_max_fiebre;
        if ($PROB_HUM_DIA>1) {
            $PROB_HUM_DIA=1;
        }

    $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and hora>='06:00:00' and hora<='18:00:00'";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $conteo_lluvia_dia = $row[0];

    if ($max_lluvia_fiebre=='1') {
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and hora>='06:00:00' and hora<='18:00:00' and lluvia='1'";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_DIA=$aux_conteo_lluvia/$conteo_lluvia_dia;
        if ($PROB_LLUVIA_DIA>1) {
            $PROB_LLUVIA_DIA=1;
        }
    }else{
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and hora>='06:00:00' and hora<='18:00:00' and lluvia='0'";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_DIA=$aux_conteo_lluvia/$conteo_lluvia_dia;
        if ($PROB_LLUVIA_DIA>1) {
            $PROB_LLUVIA_DIA=1;
        }
    }
    if ($max_lluvia_dengue=='1') {
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and hora>='06:00:00' and hora<='18:00:00' and lluvia='1'";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_DIA=$aux_conteo_lluvia/$conteo_lluvia_dia;
        if ($PROB_LLUVIA_DIA>1) {
            $PROB_LLUVIA_DIA=1;
        }
    }else{
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and hora>='06:00:00' and hora<='18:00:00' and lluvia='0'";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_DIA=$aux_conteo_lluvia/$conteo_lluvia_dia;
        if ($PROB_LLUVIA_DIA>1) {
            $PROB_LLUVIA_DIA=1;
        }
    }

    //PROBABILIDAD DE ENFERMEDAD PARA FIEBRE AMARILLA Y DENGUE EN UN DÍA
    $PROB_FIEBRE_DIA=round($proba_temp_fiebre*$PROB_TEMP_DIA + $proba_hum_fiebre*$PROB_HUM_DIA + $proba_lluvia_fiebre*$PROB_LLUVIA_DIA,4);
    $PROB_DENGUE_DIA=round($proba_temp_dengue*$PROB_TEMP_DIA + $proba_hum_dengue*$PROB_HUM_DIA + $proba_lluvia_dengue*$PROB_LLUVIA_DIA,4);

    /*******************************************************************
    *CONSULTA DE PROMEDIOS DE VARIABLES EN LA NOCHE PARA FIEBRE AMARILLA*
    *******************************************************************/

    $sql="SELECT round(AVG(temperatura),2) as promedio FROM datos_medidos WHERE fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and NOT(hora>='06:00:00' and hora<='18:00:00')";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $prom_temp_noche = $row[0];
        $PROB_TEMP_NOCHE=$prom_temp_noche/$temp_max_fiebre;
        if ($PROB_TEMP_NOCHE>1) {
            $PROB_TEMP_NOCHE=1;
        }

    $sql="SELECT round(AVG(humedad),2) as promedio FROM datos_medidos WHERE fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and NOT(hora>='06:00:00' and hora<='18:00:00')";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $prom_hum_noche = $row[0];
        $PROB_HUM_NOCHE=$prom_hum_noche/$hum_max_fiebre;
        if ($PROB_HUM_NOCHE>1) {
            $PROB_HUM_NOCHE=1;
        }

    $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and NOT(hora>='06:00:00' and hora<='18:00:00')";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $conteo_lluvia_noche = $row[0];

    if ($max_lluvia_fiebre=='1') {
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and NOT(hora>='06:00:00' and hora<='18:00:00' and lluvia='1')";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_NOCHE=$aux_conteo_lluvia/$conteo_lluvia_noche;
        if ($PROB_LLUVIA_NOCHE>1) {
            $PROB_LLUVIA_NOCHE=1;
        }
    }else{
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and NOT(hora>='06:00:00' and hora<='18:00:00' and lluvia='0')";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_NOCHE=$aux_conteo_lluvia/$conteo_lluvia_noche;
        if ($PROB_LLUVIA_NOCHE>1) {
            $PROB_LLUVIA_NOCHE=1;
        }
    }
    if ($max_lluvia_dengue=='1') {
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and NOT(hora>='06:00:00' and hora<='18:00:00' and lluvia='1')";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_NOCHE=$aux_conteo_lluvia/$conteo_lluvia_noche;
        if ($PROB_LLUVIA_NOCHE>1) {
            $PROB_LLUVIA_NOCHE=1;
        }
    }else{
        $sql="SELECT count(lluvia) from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' and id_tarjeta='$tarjeta_activa'
        and NOT(hora>='06:00:00' and hora<='18:00:00' and lluvia='0')";
        $result= $mysqli->query($sql);
        $row = $result->fetch_array(MYSQLI_NUM);
        $aux_conteo_lluvia = $row[0];
        $PROB_LLUVIA_NOCHE=$aux_conteo_lluvia/$conteo_lluvia_noche;
        if ($PROB_LLUVIA_NOCHE>1) {
            $PROB_LLUVIA_NOCHE=1;
        }
    }

    //PROBABILIDAD DE ENFERMEDAD PARA FIEBRE AMARILLA Y DENGUE EN UN DÍA
    $PROB_FIEBRE_NOCHE=round($proba_temp_fiebre*$PROB_TEMP_NOCHE + $proba_hum_fiebre*$PROB_HUM_NOCHE + $proba_lluvia_fiebre*$PROB_LLUVIA_NOCHE,4);
    $PROB_DENGUE_NOCHE=round($proba_temp_dengue*$PROB_TEMP_NOCHE + $proba_hum_dengue*$PROB_HUM_NOCHE + $proba_lluvia_dengue*$PROB_LLUVIA_NOCHE,4);

    header('Location: /ehealth/interfaces/estadisticas/probabilidad.php?nombre='.$nombre.'&id='.$tarjeta_activa.'&fe_ini='.$fecha_ini.'&fe_fin='.$fecha_fin.'&mensaje='.$PROB_FIEBRE_DIA.'&mensaje1='.$PROB_DENGUE_DIA.'&mensaje2='.$PROB_FIEBRE_NOCHE.'&mensaje3='.$PROB_DENGUE_NOCHE);
?>
