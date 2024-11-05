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
       
        <form class="formulario">
            <img src="../assets/img/logo.png" alt="Logo de NexPro">
            <h3 class="titulo-login">INICIO DE SESION</h3>
            <input type="number" id="ci" placeholder="CEDULA" class="input-login" minlength="8" maxlength="8" required>
            <input type="password" id="contrasenia" placeholder="CONTRASEÑA" class="input-login" required>
            <a href="passChange.php" class="texto-contrasena">Cambiar Contraseña</a>
            <button type="button" class="boton-enviar" onclick="enviarLogin()">ENVIAR</button> 

        </form>

        <div id="mensajeResultado" class="mensaje-error"></div>

    </div>

    <div class="container-frases">
        <div class="foot-form" >
        <p class="texto-pie">©2024 DESARROLLADORES CLAJ</p>
        <img src="../assets/img/bannerUtu.png" alt="Banner UTU" class="banner-utu">
        </div>

        <img src="../assets/img/frases.png" alt="Frase motivacional" class="logo2">
    </div>
</div>
<script src="../assets/js/controlLogin.js"></script> 
<script src="../assets/js/darkMode.js"></script>
<script src="../assets/js/traduccion.js"></script>
</body>
</html>
