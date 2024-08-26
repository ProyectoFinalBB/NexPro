<?php 
if(isset($_POST["Inicio"])){
    $_SESSION["seccion"] = $_POST["Inicio"];
} elseif(isset($_POST["Control"])){
    $_SESSION["seccion"] = $_POST["Control"];
}elseif(isset($_POST["Solicitudes"])){
    $_SESSION["seccion"] = $_POST["Solicitudes"];
}
if (isset($_SESSION["errRegistro"])){
    $errRegistro = $_SESSION['errRegistro'];
    echo "<p> $errRegistro </p>";
   
    
}

if(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Inicio"): ?>
<!-- INICIO -->
<?php elseif(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Control"): ?>
<form action="administrador/adminFunciones.php" method="post">
<button type="submit" name="" value="">Profesor</button>
<button type="submit" name="" value="">Administrador</button>
<button type="submit" name="" value="">Alumno</button>

<p>Lista de usuarios</p>
<!-- Incluir dependiendo el boton prof o alumno -->
 
 <button type="submit" name="addusr" value="addusr">Agregar Usuario</button>
 </form>

 <?php elseif(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Solicitudes"): ?>
 <!-- Solicitudes -->
 <?php endif; ?>