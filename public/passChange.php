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
<button onclick="window.history.back();" class="boton-retroceder"><--</button>
<div class="container">
    
    <div class="form-container">
        <form class="formulario">
            <img src="../assets/img/logo.png" alt="Logo de NexPro" class="logo1">
            <h3 class="titulo-login">CAMBIAR CONTRASEÑA</h3>
            <input type="number" id="ci" name="ci" placeholder="CEDULA" class="input-cedula" minlength="8" maxlength="8"  required>
            <input type="password" id="olderPass" placeholder="ANTIGUA CONTRASEÑA" class="input-contrasenia" required>
            <input type="password" id="newPass" placeholder="CONTRASEÑA NUEVA" class="input-contrasenia" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y un número.">
            <input type="password" id="newPass2" placeholder="REPITE LA CONTRASEÑA" class="input-contrasenia" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y un número.">
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
