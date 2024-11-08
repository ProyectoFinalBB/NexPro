<?php
include('../includes/conexion.php'); 
session_start(); 
if (!isset($_SESSION['id_usr']) || $_SESSION['rol'] !== 'administrador') {
 header("Location: login.php"); 
    exit(); 
}

header('Content-Type: application/json');



$conn = conectar_bd();

if ($conn === false) {
    echo json_encode(['status' => 'error', 'message' => 'Error en la conexión a la base de datos.']);
    exit();  
}

try {
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents("php://input"), true);
        
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'administrador') {
        
            $proyectoId = isset($input['id']) ? intval($input['id']) : 0;

            if ($proyectoId > 0) {
         
                $stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
                if ($stmt === false) {
                    
                    throw new Exception("Error en la preparación de la consulta: " . $conn->error);
                }

               
                $stmt->bind_param('i', $proyectoId);
                if ($stmt->execute()) {
             
                    echo json_encode(['status' => 'success', 'message' => 'Proyecto eliminado exitosamente']);
                } else {
                 
                    throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
                }
            } else {
               
                echo json_encode(['status' => 'error', 'message' => 'ID de proyecto inválido']);
            }
        } else {
      
            echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para eliminar proyectos']);
        }
    } else {
  
        echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    }
} catch (Exception $e) {

    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
