<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexPro</title>
    <link rel="icon" href="../assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="container">
    <div class="form-container">
        <form action="../controllers/ControlLogin.php" method="post" class="formulario">
            <img src="../assets/img/logo.png" alt="Logo de NexPro" class="logo1">
            <h3 class="titulo-login">INICIO DE SESION</h3>
            <input type="number" name="ci" placeholder="CEDULA" class="input-cedula" minlength="8" maxlength="8"  required>
            <input type="password" name="contrasenia" placeholder="CONTRASEÑA" class="input-contrasenia"  required >
            <input type="submit" name="envio" value="ENVIAR" class="boton-enviar"> 
        </form>
        <a href="passChange.php">Cambiar Contraseña</a>

        <?php 
        if (!isset($_SESSION['ci']) && isset($_SESSION['err'])){
            $err = $_SESSION['err'];
            echo "<p class='mensaje-error'>$err</p>";
        }
        ?>
    </div>

    <div class="container-frases">
        <img src="../assets/img/frases.png" alt="Frase motivacional" class="logo2">
    </div>
</div>

</body>
</html>
