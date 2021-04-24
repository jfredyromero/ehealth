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
                            <a class="dropdown-item" href="/ehealth/interfaces/consultas/dispositivos.php">Dispositivos</a>
                            <a class="dropdown-item" href="/ehealth/interfaces/consultas/usuarios.php">Usuarios</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Estadísticas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/ehealth/interfaces/estadisticas/probabilidad.php">Probabilidad</a>
                            <a class="dropdown-item" href="/ehealth/interfaces/estadisticas/rangos.php">Rangos</a>
                            <a class="dropdown-item" href="/ehealth/interfaces/estadisticas/ponderados.php">Ponderados</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ehealth/interfaces/alertas/alertas.php">Alertas</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><strong>'.$_SESSION["nombre_usuario"].'</strong></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Crear
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/ehealth/interfaces/usuarios/administrador/añadir.php">Usuario</a>
                            <a class="dropdown-item" href="/ehealth/interfaces/dispositivos/añadir.php">Dispositivo</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Salir</a>
                    </li>
                </ul>
            </div>
        </nav>
    ';
?>
