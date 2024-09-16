<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<div class="container">
    <div class="form-container">
        <form action="../controllers/ControlLogin.php" method="post" class="formulario">
            <img src="../assets/img/logo.png" alt="Logo de NexPro" class="logo-login">
            <h3 class="titulo-pantalla">INICIO DE SESION</h3>
            <input type="text" name="ci" placeholder="CEDULA" class="input-login">
            <input type="password" name="contrasenia" placeholder="CONTRASEÑA" class="input-login"><br>
            <p>Cambiar contraseña</p>
            <input type="submit" name="envio" value="ENVIAR" class="boton-enviar"> 
        </form>
        <?php 
        if (!isset($_SESSION['ci']) && isset($_SESSION['err'])){
            $err = $_SESSION['err'];
            echo "<p class='mensaje-error'>$err</p>";
        }
        ?>
    </div>

    <div class="container-frases">
    <img src="../assets/img/frases.png" alt="Frase motivacional" class="logo2">
    <p class="texto-pie">©2024 DESARROLLADORES CLAJ</p>
    <img src="../assets/img/bannerUtu.png" alt="Banner UTU" class="banner-utu">
</div>


</div>
</body>
</html>
