<?php 

if(isset($_POST["Inicio"])){
    $_SESSION["seccion"] = $_POST["Inicio"];
} elseif(isset($_POST["Control"])){
    $_SESSION["seccion"] = $_POST["Control"];
}elseif(isset($_POST["Solicitudes"])){
    $_SESSION["seccion"] = $_POST["Solicitudes"];
}
if (isset($_SESSION["errRegistro"])){
    $err = $_SESSION['err'];
    echo "<p> $err </p>";
}

if(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Inicio"): ?>
<!-- INICIO -->
<?php elseif(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Control"): ?>
<form action="administrador/adminFunciones.php" method="post">
<button type="submit" name="PROFESORBTN" value="PROFESORBTN">Profesor</button>
<button type="submit" name="ADMINISTRADORBTN" value="ADMINISTRADORBTN">Administrador</button>
<button type="submit" name="ALUMNOBTN" value="ALUMNOBTN">Alumno</button>

<h3>Lista de usuarios</h3>
<?php
if (isset($_SESSION['salida'])) {
    // Imprimir el contenido de 'salida'
    echo $_SESSION['salida'];
} else {
    // Mensaje si 'salida' no está definida
    echo "No hay datos disponibles para mostrar.";
}

?>
 
 <button type="submit" name="addusr" value="addusr">Agregar Usuario</button>
 </form>

 <?php elseif(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Solicitudes"): ?>
 <!-- Solicitudes -->
 <?php endif; ?>