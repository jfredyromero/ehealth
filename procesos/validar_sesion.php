<?php

// PROGRAMA DE VALIDACION DE USUARIOS
                   
                                                       
$login = $_POST["user"];
$passwd = $_POST["contrasena"];

$passwd_comp = md5($passwd);
session_start();

//echo "login es...".$login;
//echo "password es...".$passwd;

include ("conexion.php");

$mysqli = new mysqli($host, $user, $pw, $db);
       
$sql = "SELECT * from datos_usuarios where login = '$login'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$numero_filas = $result1->num_rows;
if ($numero_filas > 0)
  {
    $passwdc = $row1[5];

    if ($passwdc == $passwd_comp)
      {
        $_SESSION["autenticado"]= "AUTxxfffxx";
        $tipo_usuario = $row1[6];
        $nombre_usuario = $row1[1];
        $_SESSION["tipo_usuario"]= $tipo_usuario;
        $_SESSION["nombre_usuario"]= $nombre_usuario;  
        $_SESSION["id_usuario"]= $row1[0];;  
        
        header("Location: /ehealth/interfaces/consultas/registros.php");
      }
    else 
     {
      header("Location: /ehealth/procesos/iniciar_sesion.php?mensaje=1");
     }
  }
else
  {
    header("Location: /ehealth/procesos/iniciar_sesion.php?mensaje=2");
 }  
?>