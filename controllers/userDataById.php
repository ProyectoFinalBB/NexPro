<?php
header('Content-Type: application/json');

// Incluir archivo de conexión
include("../includes/conexion.php");

// Conectar a la base de datos
$mysqli = conectar_bd();

// Leer los datos JSON enviados por AJAX
$input = json_decode(file_get_contents('php://input'), true);

// Verificar que se ha recibido el ID del usuario desde la solicitud AJAX
if (isset($input['userId'])) {
    $userId = intval($mysqli->real_escape_string($input['userId']));

    // Consulta SQL para obtener los datos del usuario específico
    $sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci, roles.rol
            FROM usuarios 
            INNER JOIN roles ON usuarios.id_usr = roles.id_usr
            WHERE usuarios.id_usr = '$userId'";

    // Ejecutar la consulta
    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
        // Obtener el resultado de la consulta
        $user = $result->fetch_assoc();
        
        // Enviar los datos en formato JSON
        echo json_encode($user);
    } else {
        // Si no se encuentra el usuario o hay un error en la consulta
        echo json_encode(['error' => 'Usuario no encontrado o error en la consulta']);
    }

    // Cerrar la conexión
    $mysqli->close();
} else {
    echo json_encode(['error' => 'ID de usuario no proporcionado']);
}
?>
