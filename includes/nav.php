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

    <p id="nombreUsuario"><?php echo $nombre; ?></p> 
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
                <input type="checkbox" id="ingles"  >
                <span class="slider"></span>
            </label>
        </div>
    </div>
  <a href="../public/logout.php" id="cerrarSesionBtn3" class="cerrar-sesion">Cerrar Sesión</a>
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

    <p id="nombreUsuario"><?php echo $nombre; ?></p> 
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
                <input type="checkbox"  id="ingles" >
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <a href="../public/logout.php" id="cerrarSesionBtn2" class="cerrar-sesion">Cerrar Sesión</a>
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

    <p id="nombreUsuario"><?php echo $nombre; ?></p>
    <div class="menubtns">
    <button id="controlUsuariosBtn" class="btn-subir" onclick="toggleMenu('controlUsuarios')">Control de Usuarios</button>
    <button id="solicitudesProyectosBtn" class="btn-subir" onclick="toggleMenu('solicitudProyectos')">Solicitudes de Proyectos</button>
    </div>
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
                <input type="checkbox" id="ingles" >
                <span class="slider"></span>
            </label>
        </div>
    </div>
   <a href="../public/logout.php" id="cerrarSesionBtn1" class="cerrar-sesion">Cerrar Sesión</a>
</div>
<?php endif; ?>

<script src="../assets/js/fotoPerfil.js"></script>


