<?php
session_start(); 
if (!isset($_SESSION['id_usr']) ) {
 header("Location: login.php"); 
    exit(); 
}
include('../includes/conexion.php');  
$conn = conectar_bd(); 


if ($conn === false) {
    echo json_encode(['success' => false,'message' => 'Error en la conexión a la base de datos.' ]);
    exit();
}


if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $id_usuario = $_SESSION['id_usr'];  
    $targetDir = "../uploads/img/";  
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array(strtolower($fileType), $allowedTypes)) {
        
        list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
        if ($width <= 1000 && $height <= 1000) {
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
               
                $ruta_img = "../uploads/img/" . $fileName;
                $sql = "UPDATE usuarios SET ruta_img = ? WHERE id_usr = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $ruta_img, $id_usuario);

                if ($stmt->execute()) {
                    echo json_encode(['success' => true,'imagePath' => $ruta_img]);
                } else {
                    echo json_encode(['success' => false,'message' => 'Error al guardar la ruta en la base de datos.']);
                }
                $stmt->close();
            } else {
                echo json_encode(['success' => false,'message' => 'Error al subir la imagen.']);
            }
        } else {
            echo json_encode(['success' => false,'message' => 'Las dimensiones de la imagen deben ser menores de 1000x1000 píxeles.' ]);
        }
    } else {
        echo json_encode(['success' => false,'message' => 'Solo se permiten imágenes JPG, JPEG, PNG o GIF.']);
    }
} else {
    echo json_encode(['success' => false,'message' => 'No se recibió ninguna imagen.'
    ]);
}

$conn->close(); 
?>
