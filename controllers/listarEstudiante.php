<?php
header('Content-Type: application/json');

// Incluir archivo de conexión
include("../includes/conexion.php");

// Conectar a la base de datos
$mysqli = conectar_bd();

// Consulta SQL
$sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci 
        FROM usuarios 
        INNER JOIN roles ON usuarios.id_usr = roles.id_usr 
        WHERE roles.rol = 'alumno'";

// Ejecutar la consulta
$result = $mysqli->query($sql);

$users = [];
if ($result) {
    // Obtener los resultados
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    // Si hay un error en la consulta
    echo json_encode(['error' => 'Error en la consulta']);
    exit;
}

// Cerrar la conexión
$mysqli->close();

// Enviar los datos en formato JSON
echo json_encode($users);
?>
