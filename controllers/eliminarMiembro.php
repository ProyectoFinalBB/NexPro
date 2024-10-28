<?php
include("../includes/conexion.php");

header('Content-Type: application/json');

$conn = conectar_bd();

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos"]));
}

$projectId = $_POST['project_id'];
$memberId = $_POST['member_id'];

if (!$projectId || !$memberId) {
    echo json_encode(["error" => "Faltan parámetros"]);
    $conn->close();
    exit;
}

// Obtener los integrantes actuales del proyecto
$sql = "SELECT id_integrantes FROM proyectos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $projectId);
$stmt->execute();
$stmt->bind_result($id_integrantes);
$stmt->fetch();
$stmt->close();

$integrantes = explode(',', $id_integrantes);
$integrantes = array_filter($integrantes, fn($id) => $id != $memberId);  // Eliminar el miembro
$id_integrantes_nuevo = implode(',', $integrantes);

// Actualizar los integrantes del proyecto
$sqlUpdate = "UPDATE proyectos SET id_integrantes = ? WHERE id = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param('si', $id_integrantes_nuevo, $projectId);

if ($stmtUpdate->execute()) {
    echo json_encode(["success" => "Miembro eliminado correctamente"]);
} else {
    echo json_encode(["error" => "Error al eliminar el miembro"]);
}

$stmtUpdate->close();
$conn->close();
?>
