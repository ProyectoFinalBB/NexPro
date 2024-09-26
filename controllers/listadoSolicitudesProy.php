<?php
include("../includes/conexion.php");

header('Content-Type: application/json');

// Conexión a la base de datos
$conn = conectar_bd();

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos"]));
}

// Consulta para obtener los proyectos con estado "pendiente"
$sql = "SELECT id, titulo, descripcion FROM proyectos WHERE estado = 'pendiente'";
$result = $conn->query($sql);

$proyectos = [];

if ($result->num_rows > 0) {
    // Recorrer los resultados y agregar los proyectos al array
    while ($row = $result->fetch_assoc()) {
        $proyectos[] = [
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion']
        ];
    }
}

// Devolver los proyectos en formato JSON
echo json_encode($proyectos);

// Cerrar la conexión
$conn->close();
?>
