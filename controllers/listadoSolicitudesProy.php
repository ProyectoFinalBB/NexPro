<?php
include("../includes/conexion.php");

header('Content-Type: application/json');


$conn = conectar_bd();


if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos"]));
}

$sql = "SELECT id, titulo, descripcion FROM proyectos WHERE estado = 'pendiente'";
$result = $conn->query($sql);

$proyectos = [];

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $proyectos[] = [
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion']
        ];
    }
}


echo json_encode($proyectos);

$conn->close();
?>
