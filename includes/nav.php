
<?php 
$rol = $_SESSION["rol"];
$nombre = $_SESSION["nombrecompleto"]; 

if ($rol === 'alumno'): ?>
<div id="menuPerfil" class="menu">
    <div class="menu-header">
        <h2>Mi Perfil</h2>
        <button id="cerrarMenu" class="cerrar">✖</button>
    </div>
    <div class="perfil-info">
        <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="perfil-img">
        <p><?php echo $nombre; ?></p> <!-- Aquí se muestra el nombre dinámico -->
        <button class="btn-subir" onclick="redirectToView('../views/subirProyectos.php')" >Subir Proyecto</button>
    </div>
    <div class="configuracion">
        <div class="opcion">
            <span>Tema Oscuro</span>
            <label class="switch">
                <input type="checkbox" id="temaOscuro">
                <span class="slider"></span>
            </label>
        </div>
        <div class="opcion">
            <span>Ingles</span>
            <label class="switch">
                <input type="checkbox" id="ingles">
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <button class="cerrar-sesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
</div>
<?php elseif ($rol === 'profesor'): ?>
    <div id="menuPerfil" class="menu">
    <div class="menu-header">
        <h2>Mi Perfil</h2>
        <button id="cerrarMenu" class="cerrar">✖</button>
    </div>
    <div class="perfil-info">
        <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="perfil-img">
        <p><?php echo $nombre; ?></p> <!-- Aquí se muestra el nombre dinámico -->
    </div>
    <div class="configuracion">
        <div class="opcion">
            <span>Tema Oscuro</span>
            <label class="switch">
                <input type="checkbox" id="temaOscuro">
                <span class="slider"></span>
            </label>
        </div>
        <div class="opcion">
            <span>Ingles</span>
            <label class="switch">
                <input type="checkbox" id="ingles">
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <button class="cerrar-sesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
</div>
<?php elseif ($rol === 'administrador'): ?>
    <div id="menuPerfil" class="menu">
    <div class="menu-header">
        <h2>Mi Perfil</h2>
        <button id="cerrarMenu" class="cerrar">✖</button>
    </div>
    <div class="perfil-info">
        <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="perfil-img">
        <p><?php echo $nombre; ?></p> <!-- Aquí se muestra el nombre dinámico -->
        <button class="btn-subir" onclick="toggleMenu('controlUsuarios')">Control de Usuarios</button>
<button class="btn-subir" onclick="toggleMenu('solicitudProyectos')">Solicitudes de Proyectos</button>


    </div>
    <div class="configuracion">
        <div class="opcion">
            <span>Tema Oscuro</span>
            <label class="switch">
                <input type="checkbox" id="temaOscuro">
                <span class="slider"></span>
            </label>
        </div>
        <div class="opcion">
            <span>Ingles</span>
            <label class="switch">
                <input type="checkbox" id="ingles">
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <button class="cerrar-sesion"><a href="../public/logout.php">Cerrar Sesión</a></button>
</div>

<?php endif; ?>