<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexPro</title>
    <link rel="icon" href="../assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css"> 
</head>
<body>
<div id="header" class="inicioConten">
<header class="header">
    <div class="h-conten">
        <div class="menuImgDiv">
            <img src="../assets/img/icon-menu.webp" alt="Perfil" class="menu-img" id="menu-img">
        </div>
        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-img" id="logo-img">
    </div>
    <div class="search-bar">
        <button class="btn-filters" id="filtrosBtn">Filtros</button>
        <input type="text" placeholder="Buscar" class="search-input" id="buscarInput">
        <button class="btn-search" id="buscarBtn">
            <span class="search-icon">🔍</span>
        </button>
    </div>
    <div class="profile" id="nav-btn">
        <img src="../assets/img/sinIMg.jpg" alt="Perfil" class="profile-img" id="profile-img">
    </div>
</header>

<div id="proyectosAceptados">
    <ul id="proyectosAceptadosList">
        <!-- Aquí se insertarán los proyectos aceptados -->
    </ul>
</div>
</div>

<div class="menuCTRLUsuario" id="menuCTRLUsuario">
<header class="headerCTRLUSR">
    <div class="logoCTRLUSR">
        <img src="../assets/img/logo.png" alt="NexPro Logo" onclick="toggleMenu('headerInicio')" class="logo-imgCTRLUSR" id="logoCTRLUSR">
    </div>
    <h2 class="titleCTRLUSR" id="controlUsuariosTitulo">CONTROL DE USUARIOS</h2>
    <div class="user-iconCTRLUSR">
        <img src="https://cdn-icons-png.freepik.com/512/359/359657.png" onclick="redirectToView('../views/registrarUsuario.php')" alt="User Icon" class="icon-imgCTRLUSR" id="userIconCTRLUSR">
    </div>
</header>
<nav class="navCTRLUSR">
    <ul class="nav-listCTRLUSR" id="navListCTRLUSR">
        <li class="nav-item active">
            <a href="#" onclick="Listado('../controllers/listarEstudiante.php')" class="nav-link" id="navEstudiantes">Estudiantes</a>
        </li>
        <li class="nav-item">
            <a href="#" onclick="Listado('../controllers/listarProfesor.php')" class="nav-link" id="navProfesores">Profesores</a>
        </li>
        <li class="nav-item">
            <a href="#" onclick="Listado('../controllers/listarAdministrador.php')" class="nav-link" id="navAdministrador">Administrador</a>
        </li>
    </ul>
</nav>
<div id="userData">
    <ul id="userList">
        <!--list-->
    </ul>
</div>
</div>

<div class="menuSolicitudProyectos" id="menuSolicitudProyectos">
<header class="headerSoli">
    <div class="logoCTRLUSR">
        <img src="../assets/img/logo.png" alt="NexPro Logo" onclick="toggleMenu('headerInicio')" class="logo-imgCTRLUSR" id="logoSolicitudProyectos">    
    </div>
    <h2 class="titleCTRLUSR" id="solicitudesProyectosTitulo">SOLICITUDES DE PROYECTOS</h2> 
</header>

<div id="proyectosPendientes">
    <ul id="proyectosPendientesList">
        <!-- Proyectos pendientes -->
    </ul>
</div>
</div>
<!-- Contenedor del Modal (oculto por defecto) -->
<div id="modalProyecto" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModalProyecto">&times;</span>
        <h2 id="modalProyectoTitulo">Visualización del Proyecto</h2>
        <div class="modal-body">
            <img src="../assets/img/pdfimg.png" alt="PDF Icon" class="pdf-icon" id="pdf-icon">
            <div class="modal-data">
                <p id="nombreProyectoLabel">NOMBRE DEL PROYECTO: </p> <span id="nombreProyecto"></span>
                <p id="miembrosLabel">MIEMBROS:</p>
                <ul id="miembrosProyecto"></ul>
            </div>
        </div>
        <div class="modal-footer">
            <button id="aprobarBtn">Aprobar</button>
            <button id="rechazarBtn">Rechazar</button>
        </div>
    </div>
</div>

<!-- Contenedor del Modal INICIO (oculto por defecto) -->
<div id="modalProyectoInicio" class="modal">
    <div class="modal-content">
        <span class="closeI" id="closeModalProyectoInicio">&times;</span>
        <h2 id="modalProyectoInicioTitulo">Visualización del Proyecto</h2>
        <div class="modal-body">
            <img src="../assets/img/pdfimg.png" alt="PDF Icon" class="pdf-icon" id="pdf-icon-inicio">
            <div class="modal-data">
                <p id="nombreProyectoInicioLabel">NOMBRE DEL PROYECTO: </p> <span id="nombreProyectoInicio"></span>
                <p id="miembrosInicioLabel">MIEMBROS:</p>
                <ul id="miembrosProyectoInicio"></ul>
            </div>
        </div>
    </div>
</div>

<div id="modalPDF" class="modal-pdf">
    <div class="modal-pdf-content">
        <span class="close-pdf" onclick="cerrarModalPDF()" id="closeModalPDF">&times;</span>
        <embed id="pdfFrame" class="pdf-frame" type="application/pdf" />
    </div>
</div>

<script src="../assets/js/script.js"></script>
</body>
</html>
