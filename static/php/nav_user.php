<?php
    echo '
        <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #281E5D;">
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/ehealth/interfaces/estadisticas/probabilidad.php">
                            Probabilidad
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Consultas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/ehealth/interfaces/consultas/registros.php">Registros</a>
                            <a class="dropdown-item" href="/ehealth/interfaces/consultas/fechas.php">Fechas</a>
                            <a class="dropdown-item" href="/ehealth/interfaces/consultas/usuarios/dispositivos.php">Dispositivos</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ehealth/interfaces/alertas/alertas.php">Alertas</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <strong>
                                <i class="fas fa-user"></i>
                                <span class="pl-1">'.$_SESSION["nombre_usuario"].'</span>
                            </strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ehealth/procesos/cerrar_sesion.php">
                            <span class="pr-2">Salir</span>
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    ';
?>
