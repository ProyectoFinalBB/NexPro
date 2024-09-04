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
            <img src="../assets/img/logo.png" alt="Logo de NexPro" class="logo1">
            <h3 class="titulo-login">INICIO DE SESION</h3>
            <input type="text" name="ci" placeholder="CEDULA" class="input-cedula">
            <input type="password" name="contrasenia" placeholder="CONTRASEÑA" class="input-contrasenia"><br>
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
    </div>
</div>

</body>
</html>
