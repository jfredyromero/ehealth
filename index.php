
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>eHealth: Dispositivo IoT</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="static/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="static/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="static/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="static/img/favicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="static/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="static/img/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader --> 
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header" >
         <div class="container">
            <div class="row" >
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo"> <a class="inicio" href="index.html">Ehealth</a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <ul class="menu-area-main">
                              <li class="active"> <a class="sesion" href="procesos/iniciar_sesion.php">Iniciar Sesión</a> </li>
                              <li> <a class="sesion" href="interfaces\usuarios\consulta\registrar.php">Registrar</a> </li>                              
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end header inner --> 
      </header>
      <!-- end header -->
      <section class="slider_section">
         <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide" src="static/img/Inicio.png" alt="First slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                     <h1><FONT style= COLOR="White">Cuidar tu salud, es una prioridad </FONT>
                     <br></h1>
                     <p><B><FONT COLOR="white">Actúa de forma temprana </FONT></B></p>   
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide" src="static/img/Slide.png" alt="Second slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                        <h1><FONT COLOR="black">Prevenir el dengue, está en tus manos </FONT>
                        <br></h1>
                        
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="third-slide" src="static/img/mosco.png" alt="Third slide">
                  <div class="container">
                     <div class="carousel-caption relative">
                     <h1><FONT COLOR="black">Tu salud, no es un juego </FONT>
                        <br></h1>
                        
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <i class='fa fa-angle-left'></i>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <i class='fa fa-angle-right'></i>
            </a>
         </div>
      </section>
      <!-- about  -->
      <div id="about" class="about top_layer">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Descripción del sistema</h2>
                     <span>El proyecto Ehealth de la Universidad del Cauca, consiste en un sistema que, mediante la recolección de 
                      variables del ambiente en determinados sectores de la ciudad de Popayán, indica la probabilidad de que
                      los habitantes adquieran enfermedades como  <i> dengue  </i> o  <i> fiebre amarilla </i> . 
                      Las variables recolectadas del entorno son: presencia de lluvia, humedad y temperatura.</span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="img-box">
                     <figure><img src="static/img/logo.png"width="500" alt="img"/></figure>
                     <a href="#">Inicio</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end abouts -->
       <!-- about  -->
       <div id="about" class="about top_layer">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Servicios</h2>
                     <span> <ul>Muestreo de variables que influyen en la probabilidad de adquirir
                     dengue o fiebre amarilla</u>
                     <ul>Evidencia gráfica de las probabilidades de adquirir <i>  dengue </i>  o  <i> fiebre amarilla </i> .</ul></span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="img-box">
                     <figure><img src="static/img/servicios.png"width="500" alt="img"/></figure>
                     <a href="#">Inicio</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end abouts -->
       <!-- about  -->
       <div id="about" class="about top_layer">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Quienes somos</h2>
                     <span>Somos un grupo de seis (6) estudiantes de séptimo semestre de la Universidad del Cauca, 
                           con el objetivo de crear un proyecto que suministre a los ciudadanos  el 
                           indice de probabilidad de contagio de  <i> dengue  </i> o  <i> fiebre amarilla </i>  en la ciudad de Popayán y
                            del mismo modo que promueva el cuidado de su salud.</span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="img-box">
                     <figure><img src="static/img/collage.jpg" width="700" alt="img"/></figure>
                     <a href="#">Inicio</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end abouts -->
      
     
     
      <!-- Javascript files--> 
      <script src="static/js/jquery.min.js"></script> 
      <script src="static/js/popper.min.js"></script> 
      <script src="static/js/bootstrap.bundle.min.js"></script> 
      <script src="static/js/jquery-3.0.0.min.js"></script> 
      <script src="static/js/plugin.js"></script> 
      <!-- sidebar --> 
      <script src="static/js/jquery.mCustomScrollbar.concat.min.js"></script> 
      <script src="static/js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         $(".zoom").hover(function(){
         
         $(this).addClass('transition');
         }, function(){
         
         $(this).removeClass('transition');
         });
         });
         
      </script> 
       <div class="header">
       </div>
   </body>
</html>