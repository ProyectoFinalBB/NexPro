<?php

session_start();

if (isset($_GET['ruta'])) {

    $ruta = $_GET['ruta'];

} else {
    header("location: ../public/index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexPro</title>
    <link rel="icon" href="../assets/img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/styles.css"> 
  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</head>

<body>
<div class="container">
<div class="form-container">
<div class="formContenedor">
    <button type="button" onclick="window.history.back();" class="boton-retroceder"><img src="../assets/img/retroceso.png"></button>
<?php include($ruta); ?>
<p id="mensajeResultado" class="mensajeResultado"></p>
</div>

</div>
    <div class="container-frases">
        <div class="foot-form" >
        <p class="texto-pie">©2024 DESARROLLADORES CLAJ</p>
        <img src="../assets/img/bannerUtu.png" alt="Banner UTU" class="banner-utu">
        </div>

        <img src="../assets/img/frases.png" alt="Frase motivacional" class="logo2" id="logoFrase">
    </div>
</div>




</body>
</html>