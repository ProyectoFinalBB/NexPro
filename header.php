<?php
$rol = $_SESSION["rol"];

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
            <a href="logout.php">Cerrar Sesion</a>
        </form> 
    </header>
    <?php elseif ($rol === 'profesor'): ?>
        <header> 
    <form method="POST" action="" class="" id="">
            <i class="fas fa-user-circle"></i>
            <button type="submit" name="pagina" value="Inicio">Inicio</button>
            <a href="logout.php">Cerrar Sesion</a>
        </form> 
    </header>
    <?php elseif ($rol === 'administrador'): ?>
        <header> 
    <form method="POST" action="" class="" id="">
            <i class="fas fa-user-circle"></i>
            <button type="submit" name="Inicio" value="Inicio">Inicio</button>
            <button type="submit" name="Control" value="Control">Control</button>
            <button type="submit" name="Solicitudes" value="Solicitudes">Solicitudes</button>
            <a href="logout.php">Cerrar Sesion</a>
        </form> 
    </header>

    <?php endif; ?>
</body>
</html>

