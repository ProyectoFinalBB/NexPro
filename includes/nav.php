<?php 
$rol = $_SESSION["rol"];
$nombre = $_SESSION["nombrecompleto"]; 

if ($rol === 'alumno'): ?>
<div id="menuPerfil" class="menu">
    <div class="menu-header">
        <h2 id="miPerfil">Mi Perfil</h2>
        <button id="cerrarMenu" class="cerrar">✖</button>
    </div>
    <div class="perfil-info">
    <div class="perfil-info-imagen">
        <img id="profileImage" class="perfil-img" src="../assets/img/sinIMg.jpg" alt="Foto de perfil">

        <input type="file" id="fileInput" accept="image/*" style="display: none;">

        <button id="uploadButton" class="upload-icon">
            <img src="../assets/img/addimg.png" alt="Subir imagen">
        </button>
    </div>

    <p id="nombreUsuario"><?php echo $nombre; ?></p> <!-- Aquí se muestra el nombre dinámico -->
        <button id="subirProyectoBtn" class="btn-subir" onclick="redirectToView('../views/subirProyectos.php')">Subir Proyecto</button>
    </div>
    <div class="configuracion">
        <div class="opcion">
            <span id="temaOscuroTexto">Tema Oscuro</span>
            <label class="switch">
                <input type="checkbox" id="temaOscuro">
                <span class="slider"></span>
            </label>
        </div>
        <div class="opcion">
            <span id="inglesTexto">Inglés</span>
            <label class="switch">
                <input type="checkbox" id="ingles">
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <button id="cerrarSesionBtn" class="cerrar-sesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
</div>
<?php elseif ($rol === 'profesor'): ?>
<div id="menuPerfil" class="menu">
    <div class="menu-header">
        <h2 id="miPerfil">Mi Perfil</h2>
        <button id="cerrarMenu" class="cerrar">✖</button>
    </div>
    <div class="perfil-info">
    <div class="perfil-info-imagen">
        <img id="profileImage" class="perfil-img" src="../assets/img/sinIMg.jpg" alt="Foto de perfil">

        <input type="file" id="fileInput" accept="image/*" style="display: none;">

        <button id="uploadButton" class="upload-icon">
            <img src="../assets/img/addimg.png" alt="Subir imagen">
        </button>
    </div>

    <p id="nombreUsuario"><?php echo $nombre; ?></p> <!-- Aquí se muestra el nombre dinámico -->
    </div>
    <div class="configuracion">
        <div class="opcion">
            <span id="temaOscuroTexto">Tema Oscuro</span>
            <label class="switch">
                <input type="checkbox" id="temaOscuro">
                <span class="slider"></span>
            </label>
        </div>
        <div class="opcion">
            <span id="inglesTexto">Inglés</span>
            <label class="switch">
                <input type="checkbox" id="ingles">
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <button id="cerrarSesionBtn" class="cerrar-sesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
</div>
<?php elseif ($rol === 'administrador'): ?>
<div id="menuPerfil" class="menu">
    <div class="menu-header">
        <h2 id="miPerfil">Mi Perfil</h2>
        <button id="cerrarMenu" class="cerrar">✖</button>
    </div>
    <div class="perfil-info">
    <div class="perfil-info-imagen">
        <img id="profileImage" class="perfil-img" src="../assets/img/sinIMg.jpg" alt="Foto de perfil">

        <input type="file" id="fileInput" accept="image/*" style="display: none;">

        <button id="uploadButton" class="upload-icon">
            <img src="../assets/img/addimg.png" alt="Subir imagen">
        </button>
    </div>

    <p id="nombreUsuario"><?php echo $nombre; ?></p> <!-- Aquí se muestra el nombre dinámico -->

    <button id="controlUsuariosBtn" class="btn-subir" onclick="toggleMenu('controlUsuarios')">Control de Usuarios</button>
    <button id="solicitudesProyectosBtn" class="btn-subir" onclick="toggleMenu('solicitudProyectos')">Solicitudes de Proyectos</button>
</div>

    <div class="configuracion">
        <div class="opcion">
            <span id="temaOscuroTexto">Tema Oscuro</span>
            <label class="switch">
                <input type="checkbox" id="temaOscuro">
                <span class="slider"></span>
            </label>
        </div>
        <div class="opcion">
            <span id="inglesTexto">Inglés</span>
            <label class="switch">
                <input type="checkbox" id="ingles">
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <button id="cerrarSesionBtn" class="cerrar-sesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
</div>
<?php endif; ?>

<script src="../assets/js/fotoPerfil.js"></script>
<script src="../assets/js/traduccion.js"></script>
