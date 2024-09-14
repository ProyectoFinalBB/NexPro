<?php
header('Content-Type: application/json');

include("../includes/conexion.php");

$mysqli = conectar_bd();


$sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci 
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_usr = roles.id_usr 
        WHERE roles.rol = 'administrador'";

$result = $mysqli->query($sql);

$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
 
    echo json_encode(['error' => 'Error en la consulta']);
    exit;
}


$mysqli->close();

echo json_encode($users);
?>
