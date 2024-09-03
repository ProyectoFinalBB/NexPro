<?php 

if(isset($_POST["Inicio"])){
    $_SESSION["seccion"] = $_POST["Inicio"];
} elseif(isset($_POST["Control"])){
    $_SESSION["seccion"] = $_POST["Control"];
} elseif(isset($_POST["Solicitudes"])){
    $_SESSION["seccion"] = $_POST["Solicitudes"];
}

if (isset($_SESSION["errRegistro"])){
    $err = $_SESSION['err'];
    echo "<p> $err </p>";
}

if(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Inicio"): ?>
<!-- INICIO -->
<?php elseif(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Control"): ?>
<form action="administrador/adminFunciones.php" method="post" class="user-list-form">
    <div class="role-buttons">
        <button type="submit" name="PROFESORBTN" value="PROFESORBTN" class="role-btn">Profesor</button>
        <button type="submit" name="ADMINISTRADORBTN" value="ADMINISTRADORBTN" class="role-btn">Administrador</button>
        <button type="submit" name="ALUMNOBTN" value="ALUMNOBTN" class="role-btn">Alumno</button>
    </div>

    <h3 class="user-list-heading">Lista de usuarios</h3>
    <?php
    if (isset($_SESSION['salida'])) {
        echo '<div class="user-list-content">' . $_SESSION['salida'] . '</div>';
    } else {
        echo '<div class="user-list-content">No hay datos disponibles para mostrar.</div>';
    }
    ?>
 
    <button type="submit" name="addusr" value="addusr" class="submit-btn">Agregar Usuario</button>
</form>

<?php elseif(isset($_SESSION["seccion"]) && $_SESSION["seccion"] == "Solicitudes"): ?>
<!-- Solicitudes -->
<?php endif; ?>
