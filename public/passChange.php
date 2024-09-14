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
        <form class="formulario">
            <img src="../assets/img/logo.png" alt="Logo de NexPro" class="logo1">
            <h3 class="titulo-login">CAMBIAR CONTRASEÑA</h3>
            <input type="text" id="ci" name="ci" placeholder="CEDULA" class="input-cedula">
            <input type="password" id="olderPass" placeholder="ANTIGUA CONTRASEÑA" class="input-contrasenia"><br>
            <input type="password" id="newPass" placeholder="CONTRASEÑA NUEVA" class="input-contrasenia"><br>
            <input type="password" id="newPass2" placeholder="REPITE LA CONTRASEÑA" class="input-contrasenia"><br>
            <button type="submit" onclick="cambiarContraseña()" class="boton-enviar">CAMBIAR</button>
        </form>

<div id="mensajeResultado"></div> 
    </div>

    <div class="container-frases">
        <img src="../assets/img/frases.png" alt="Frase motivacional" class="logo2">
    </div>
</div>
<script src="../assets/js/passChange.js"></script>
</body>
</html>
