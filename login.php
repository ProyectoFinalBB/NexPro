
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


<div class="contenC">
<form action="ControlLogin.php" method="post">
<img src="img/logo.png" alt="Logo de NexPro" class="logo">
    <h3>INICIO DE SESION</h3>
    <input type="text" name="ci" placeholder="CEDULA">
    <input type="password" name="contrasenia" placeholder="CONTRASEÑA"><br>
    <input type="submit" name="envio" value="ENVIAR"> 
    </form>
<?php 

if (!isset($_SESSION['ci']) && isset($_SESSION['err'])){
    $err = $_SESSION['err'];
    echo "<p> $err </p>";
}

?>


</div>


</body>
</html>