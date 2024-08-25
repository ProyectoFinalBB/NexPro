<?php
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexPro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if ($rol === 'alumno'): ?>
        <header> 
    <form method="POST" action="" class="" id="">
            <i class="fas fa-user-circle"></i>
            <button type="submit" name="pagina" value="Inicio">Inicio</button>
            <button type="submit" name="pagina" value="subir-proyecto">Subir Proyecto</button>
            <button type="submit" name="pagina" value="Cerrar">Cerrar sesión</button>
        </form> 
    </header>
    <?php elseif ($rol === 'profesor'): ?>
        <header> 
    <form method="POST" action="" class="" id="">
            <i class="fas fa-user-circle"></i>
            <button type="submit" name="pagina" value="Inicio">Inicio</button>
            <button type="submit" name="pagina" value="Cerrar">Cerrar sesión</button>
        </form> 
    </header>
    <?php elseif ($rol === 'administrador'): ?>
        <header> 
    <form method="POST" action="" class="" id="">
            <i class="fas fa-user-circle"></i>
            <button type="submit" name="pagina" value="Inicio">Inicio</button>
            <button type="submit" name="pagina" value="Control">Control</button>
            <button type="submit" name="pagina" value="Solicitudes">Solicitudes</button>
            <button type="submit" name="pagina" value="Cerrar">Cerrar sesión</button>
        </form> 
    </header>
    <?php else: ?>
        <header>
            <h1>Bienvenido</h1>
            <nav>
                <ul>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </header>
    <?php endif; ?>
</body>
</html>

