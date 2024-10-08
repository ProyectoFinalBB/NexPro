
<?php
include("../includes/conexion.php");

header('Content-Type: application/json');

$conn = conectar_bd();

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos"]));
}

// Consulta para obtener los proyectos aceptados junto con los integrantes y tags
$sql = "SELECT id, titulo, descripcion, id_integrantes, tags, ruta FROM proyectos WHERE estado = 'pendiente'";
$result = $conn->query($sql);

$proyectos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
  
        $integrantesIDs = explode(',', $row['id_integrantes']);
        
        $integrantesNombres = [];
        foreach ($integrantesIDs as $id) {
            $sqlIntegrantes = "SELECT nombrecompleto FROM usuarios WHERE id_usr = ?";
            $stmtIntegrantes = $conn->prepare($sqlIntegrantes);
            $stmtIntegrantes->bind_param('i', $id);
            $stmtIntegrantes->execute();
            $stmtIntegrantes->bind_result($nombrecompleto);
            if ($stmtIntegrantes->fetch()) {
                $integrantesNombres[] = $nombrecompleto;
            }
            $stmtIntegrantes->close();
        }

        // Convertir los tags en un array
        $tags = explode(',', $row['tags']);

        // Agregar el proyecto al array de respuesta
        $proyectos[] = [
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion'],
            'miembros' => $integrantesNombres,  // Nombres de los integrantes
            'tags' => $tags,
            'ruta' => $row['ruta']  // Ruta del archivo PDF
        ];
    }
}

echo json_encode($proyectos);

$conn->close();
?>
