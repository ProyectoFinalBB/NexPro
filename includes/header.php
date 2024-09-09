
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexPro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css"> 
</head>
<body>

    <header class="header" id="header">
    <div class="logo">
        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-img">
    </div>
    <div class="search-bar">
        <button class="btn-filters">Filtros</button>
        <input type="text" placeholder="Buscar" class="search-input">
        <button class="btn-search">
            <span class="search-icon">🔍</span>
        </button>
    </div>
    <div class="profile" id="nav-btn">
        <img src="https://i.pinimg.com/564x/c6/89/95/c68995aa24906a1320b4d7d10aa374b2.jpg" alt="Perfil" class="profile-img">
    </div>
</header>

<div class="menuCTRLUsuario" id="menuCTRLUsuario">
<header class="headerCTRLUSR">
        <div class="logoCTRLUSR">
            <img src="../assets/img/logo.png" alt="NexPro Logo" onclick="toggleMenu()" class="logo-imgCTRLUSR">
        </div>
        <h2 class="titleCTRLUSR">CONTROL DE USUARIOS</h2>
        <div class="user-iconCTRLUSR">
            <img src="https://cdn-icons-png.freepik.com/512/359/359657.png" onclick="redirectToView('../views/registrarUsuarios.php') alt="User Icon" class="icon-imgCTRLUSR">
        </div>
    </header>
    <nav class="navCTRLUSR">
        <ul class="nav-listCTRLUSR">
            <li class="nav-item active"><a href="#" onclick="studentList()" class="nav-link">Estudiantes</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Profesores</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Administrador</a></li>
        </ul>
    </nav>
</div>

<script>
    // Iniciar con el header visible y el menú de control de usuarios oculto
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('header').style.display = 'flex';
    document.getElementById('menuCTRLUsuario').style.display = 'none';
});
function toggleMenu() {
    const header = document.getElementById('header');
    const menuCTRLUsuario = document.getElementById('menuCTRLUsuario');

    // Alternar la visibilidad del header y el menú de control de usuarios
    if (header.style.display === 'none') {
        header.style.display = 'flex';
        menuCTRLUsuario.style.display = 'none';
    } else {
        header.style.display = 'none';
        menuCTRLUsuario.style.display = 'block';
    }
    document.getElementById('menuPerfil').style.display = 'none';
}
</script>

