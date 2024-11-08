<?php
include("../includes/conexion.php");

header('Content-Type: application/json');
session_start(); 
if (!isset($_SESSION['id_usr']) || $_SESSION['rol'] !== 'administrador') {
 header("Location: login.php"); 
    exit(); 
}

$conn = conectar_bd();


if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit();
}


$input = json_decode(file_get_contents('php://input'), true);

$id_proyecto = $input['id'];
$estado_proyecto = $input['estado'];


if (!isset($id_proyecto) || !isset($estado_proyecto)) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit();
}


$sql = "UPDATE proyectos SET estado = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('si', $estado_proyecto, $id_proyecto);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Estado del proyecto actualizado']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el proyecto']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta']);
}

$conn->close();
?>
