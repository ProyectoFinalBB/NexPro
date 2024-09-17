<?php 
session_start();
if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="administrador") {
    header('Location: ../public/login.php'); 
    exit();
}

function consultar_existe_usr($con, $ci) {
    $ci = mysqli_real_escape_string($con, $ci);
    $consulta_existe_usr = "SELECT ci FROM usuarios WHERE ci = '$ci'";
    $resultado_existe_usr = mysqli_query($con, $consulta_existe_usr);

    return mysqli_num_rows($resultado_existe_usr) > 0;
}
?>