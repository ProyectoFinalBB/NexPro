<?php
session_start();
include('../includes/conexion.php');  // Incluye la conexión a la base de datos
$conn = conectar_bd();  // Llama a la función para conectar

// Verificar si la conexión es exitosa
if ($conn === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la conexión a la base de datos.'
    ]);
    exit();
}

// Verificar si se recibió el archivo
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $id_usuario = $_SESSION['id_usr'];  // Obtener el ID del usuario desde la sesión
    $targetDir = "../uploads/img/";     // Directorio de destino
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Validar tipo de archivo
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array(strtolower($fileType), $allowedTypes)) {
        // Validar dimensiones de la imagen
        list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
        if ($width <= 1000 && $height <= 1000) {
            // Subir el archivo al servidor
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                // Guardar la ruta en la base de datos
                $ruta_img = "../uploads/img/" . $fileName;
                $sql = "UPDATE usuarios SET ruta_img = ? WHERE id_usr = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $ruta_img, $id_usuario);

                if ($stmt->execute()) {
                    echo json_encode([
                        'success' => true,
                        'imagePath' => $ruta_img
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error al guardar la ruta en la base de datos.'
                    ]);
                }
                $stmt->close();
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al subir la imagen.'
                ]);
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Las dimensiones de la imagen deben ser menores de 1000x1000 píxeles.'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Solo se permiten imágenes JPG, JPEG, PNG o GIF.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió ninguna imagen.'
    ]);
}

$conn->close();  // Cierra la conexión a la base de datos
?>