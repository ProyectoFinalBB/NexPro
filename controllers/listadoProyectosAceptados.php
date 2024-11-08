
<?php
include("../includes/conexion.php");
session_start(); 
if (!isset($_SESSION['id_usr']) ) {
 header("Location: login.php"); 
    exit(); 
}
header('Content-Type: application/json');

$conn = conectar_bd();

if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión a la base de datos"]));
}

$sql = "SELECT id, titulo, descripcion, id_integrantes, tags, ruta, id_usr_creador FROM proyectos WHERE estado = 'aceptado'";
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

    

   

        $tags = explode(',', $row['tags']);

        $proyectos[] = [
            'id' => $row['id'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion'],
            'miembros' => $integrantesNombres,  
            'tags' => $tags,
            'ruta' => $row['ruta']  
        ];
    }
}

echo json_encode($proyectos);


$conn->close();
?>
