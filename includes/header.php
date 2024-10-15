<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="titulo">NexPro</title>
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
        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-img">
    </div>
    
    <div class="search-bar">
        <button id="btnFiltros" class="btn-filters"></button>
        <input type="text" placeholder="Buscar" id="inputBuscar" class="search-input">
        <button id="btnBuscar" class="btn-search">
            <span class="search-icon">🔍</span>
        </button>
    </div>

    <div class="profile" id="nav-btn">
        <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="profile-img">
    </div>

</header>

<div id="proyectosAceptados">
    <ul id="proyectosAceptadosList">
    
    </ul>
</div>
</div>

<div class="menuCTRLUsuario" id="menuCTRLUsuario">
<header class="headerCTRLUSR">
    <div class="logoCTRLUSR">
        <img src="../assets/img/logo.png" alt="NexPro Logo" onclick="toggleMenu('headerInicio')" class="logo-imgCTRLUSR">
    </div>
    <h2 id="tituloUsuarios" class="titleCTRLUSR"></h2>
    <div class="user-iconCTRLUSR">
        <img src="https://cdn-icons-png.freepik.com/512/359/359657.png" onclick="redirectToView('../views/registrarUsuario.php')" alt="User Icon" class="icon-imgCTRLUSR">
    </div>
</header>
<nav class="navCTRLUSR">
    <ul class="nav-listCTRLUSR">
        <li class="nav-item active"><a href="#" onclick="Listado('../controllers/listarEstudiante.php')" id="linkEstudiantes" class="nav-link"></a></li>
        <li class="nav-item"><a href="#" onclick="Listado('../controllers/listarProfesor.php')" id="linkProfesores" class="nav-link"></a></li>
        <li class="nav-item"><a href="#" onclick="Listado('../controllers/listarAdministrador.php')" id="linkAdministradores" class="nav-link"></a></li>
    </ul>
</nav>
<div id="userData">
    <ul id="userList">
        <!-- list -->
    </ul>
</div>
</div>

<div class="menuSolicitudProyectos" id="menuSolicitudProyectos">
<header class="headerSoli">
    <div class="logoCTRLUSR">
        <img src="../assets/img/logo.png" alt="NexPro Logo" onclick="toggleMenu('headerInicio')" class="logo-imgCTRLUSR">    
    </div>
    <h2 id="tituloSolicitudes" class="titleCTRLUSR"></h2> 
</header>
<div id="proyectosPendientes">
    <ul id="proyectosPendientesList">
        <!-- list -->
    </ul>
</div>
</div>

<!-- Contenedor del Modal (oculto por defecto) -->
<div id="modalProyecto" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="tituloVisualizacionProyecto"></h2>
        <div class="modal-body">
            <img src="../assets/img/pdfimg.png" alt="PDF Icon" class="pdf-icon" id="pdf-icon">
            <div class="modal-data">
                <p id="nombreProyectoLabel"> <span id="nombreProyecto"></span></p>
                <p id="miembrosProyectoLabel"></p>
                <ul id="miembrosProyecto"></ul>
            </div>
        </div>
        <div class="modal-footer">
            <button id="aprobarBtn"></button>
            <button id="rechazarBtn"></button>
        </div>
    </div>
</div>

<!-- Contenedor del Modal INICIO (oculto por defecto) -->
<div id="modalProyectoInicio" class="modal">
    <div class="modal-content">
        <span class="closeI">&times;</span>
        <h2 id="tituloVisualizacionProyectoInicio"></h2>
        <div class="modal-body">
            <img src="../assets/img/pdfimg.png" alt="PDF Icon" class="pdf-icon" id="pdf-icon-inicio">
            <div class="modal-data">
                <p id="nombreProyectoInicioLabel"> <span id="nombreProyectoInicio"></span></p>
                <p id="miembrosProyectoInicioLabel"></p>
                <ul id="miembrosProyectoInicio"></ul>
            </div>
        </div>
    </div>
</div>

<div id="modalPDF" class="modal-pdf">
    <div class="modal-pdf-content">
        <span class="close-pdf" onclick="cerrarModalPDF()">&times;</span>
        <embed id="pdfFrame" class="pdf-frame" type="application/pdf" />
    </div>
</div>
<script src="../assets/js/script.js"></script>

</body>
</html>
