<?php
session_start();
if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="administrador") {
    header('Location: ../public/login.php'); 
    exit();
}

header('Content-Type: application/json');

include("../includes/conexion.php");

$mysqli = conectar_bd();


$sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci 
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_usr = roles.id_usr 
        WHERE roles.rol = 'administrador' AND usuarios.id_usr != 1";

$result = $mysqli->query($sql);

$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
 
    echo json_encode(['Error en la consulta']);
    exit;
}


$mysqli->close();

echo json_encode($users);

?>

