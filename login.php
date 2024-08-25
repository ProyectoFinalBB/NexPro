
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
    <h1>Log in</h1>
    <input type="text" name="ci" placeholder="Usuario">
    <input type="password" name="contrasenia" placeholder="Contraseña">
    <input type="submit" name="envio" value="envio"> 
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