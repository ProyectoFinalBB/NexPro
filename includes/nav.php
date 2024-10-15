<?php 
$rol = $_SESSION["rol"];
if ($rol === 'alumno'): ?>
    <div id="menuPerfil" class="menu">
        <div class="menu-header">
            <h2 id="tituloPerfil"></h2>
            <button id="cerrarMenu" class="cerrar">✖</button>
        </div>
        <div class="perfil-info">
            <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="perfil-img">
            <p id="nombreUsuario"></p>
            <button class="btn-subir" onclick="redirectToView('../views/subirProyectos.php')" id="btnSubirProyecto">Subir Proyecto</button>
        </div>
        <div class="configuracion">
            <div class="opcion">
                <span id="temaOscuro">Tema Oscuro</span>
                <label class="switch">
                    <input type="checkbox" id="temaOscuroCheckbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="opcion">
                <span id="ingles">Inglés</span>
                <label class="switch">
                    <input type="checkbox" id="inglesCheckbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <button class="cerrar-sesion" id="cerrarSesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
    </div>

<?php elseif ($rol === 'profesor'): ?>
    <div id="menuPerfil" class="menu">
        <div class="menu-header">
            <h2 id="tituloPerfil"></h2>
            <button id="cerrarMenu" class="cerrar">✖</button>
        </div>
        <div class="perfil-info">
            <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="perfil-img">
            <p id="nombreUsuario"></p>
        </div>
        <div class="configuracion">
            <div class="opcion">
                <span id="temaOscuro">Tema Oscuro</span>
                <label class="switch">
                    <input type="checkbox" id="temaOscuroCheckbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="opcion">
                <span id="ingles">Inglés</span>
                <label class="switch">
                    <input type="checkbox" id="inglesCheckbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <button class="cerrar-sesion" id="cerrarSesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
    </div>

<?php elseif ($rol === 'administrador'): ?>
    <div id="menuPerfil" class="menu">
        <div class="menu-header">
            <h2 id="tituloPerfil"></h2>
            <button id="cerrarMenu" class="cerrar">✖</button>
        </div>
        <div class="perfil-info">
            <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="perfil-img">
            <p id="nombreUsuario"></p>
            <button class="btn-subir" onclick="toggleMenu('controlUsuarios')" id="btnControlUsuarios"></button>
            <button class="btn-subir" onclick="toggleMenu('solicitudProyectos')" id="btnSolicitudProyectos"></button>
        </div>
        
        <div class="configuracion">
            <div class="opcion">
                <span id="temaOscuro"></span>
                <label class="switch">
                    <input type="checkbox" id="temaOscuroCheckbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div class="opcion">
                <span id="ingles"></span>
                <label class="switch">
                    <input type="checkbox" id="inglesCheckbox">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <button class="cerrar-sesion" id="cerrarSesion"><a href="../public/logout.php"></a></button>

    </div>

<?php endif; ?>
