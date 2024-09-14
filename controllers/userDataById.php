<?php
header('Content-Type: application/json');

include("../includes/conexion.php");

$mysqli = conectar_bd();

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['userId'])) {
    $userId = intval($mysqli->real_escape_string($input['userId']));

    $sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci, roles.rol
            FROM usuarios 
            INNER JOIN roles ON usuarios.id_usr = roles.id_usr
            WHERE usuarios.id_usr = '$userId'";

    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
 
        $user = $result->fetch_assoc();
        
        echo json_encode($user);
    } else {

        echo json_encode(['error' => 'Usuario no encontrado o error en la consulta']);
    }

    $mysqli->close();
} else {
    echo json_encode(['error' => 'ID de usuario no proporcionado']);
}
?>
