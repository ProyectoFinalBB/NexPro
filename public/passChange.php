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
        <div class="logo-boton">
        <button type="button" onclick="window.history.back();" class="boton-retroceder"><img src="../assets/img/retroceso.png"></button>
        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
        </div>

            <h3 class="titulo-login">CAMBIAR CONTRASEÑA</h3>
            <input type="number" id="ci" name="ci" placeholder="CEDULA" class="input-login" minlength="8" maxlength="8"  required>
            <input type="password" id="olderPass" placeholder="ANTIGUA CONTRASEÑA" class="input-login"  required>
            <input  type="password" id="newPass" placeholder="CONTRASEÑA NUEVA" class="input-login" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y un número.">
            <input  type="password" id="newPass2" placeholder="REPITE LA CONTRASEÑA" class="input-login" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y un número." >
            <button type="submit" onclick="cambiarContraseña()" class="boton-enviar">CAMBIAR</button>
            <div id="mensajeResultado" class="mensajeResultado"></div> 
        </form>


    </div>

    <div class="container-frases">
        <div class="foot-form" >
        <p class="texto-pie">©2024 DESARROLLADORES CLAJ</p>
        <img src="../assets/img/bannerUtu.png" alt="Banner UTU" class="banner-utu">
        </div>

        <img src="../assets/img/frases.png" alt="Frase motivacional" class="logo2">
    </div>
</div>
<script src="../assets/js/passChange.js"></script>
<script src="../assets/js/darkMode.js"></script>
<script src="../assets/js/traduccion.js"></script>
</body>
</html>
