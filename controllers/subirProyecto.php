<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require '../includes/conexion.php';
    $conn = conectar_bd();

  
    $titulo = $_POST['nombreProyecto'];
    $descripcion = $_POST['descProyecto'];
    $integrantes = json_decode($_POST['integrantesIDs'], true);  
    $tags = json_decode($_POST['tagsProyecto'], true);  
    $archivoProyecto = $_FILES['archivoProyecto']; 

   
    if (empty($titulo) || empty($descripcion) || empty($archivoProyecto['name'])) {
        echo "Por favor, completa todos los campos requeridos.";
        exit;
    }


    if ($archivoProyecto['type'] !== 'application/pdf') {
        echo "Solo se permiten archivos PDF.";
        exit;
    }

    if ($archivoProyecto['size'] > 5000000) {
        echo "El archivo es demasiado grande. El límite es de 5MB.";
        exit;
    }

 
    $uploadDir = '../uploads/pdfs/';
 
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); 
    }

 
    $uploadFile = $uploadDir . basename($archivoProyecto['name']);

   
    if (move_uploaded_file($archivoProyecto['tmp_name'], $uploadFile)) {
     
        $tagsStr = implode(",", $tags);
   
        $integrantesStr = implode(",", $integrantes);

        $sql = "INSERT INTO proyectos (titulo, descripcion, ruta, id_integrantes, tags, estado, id_usr_creador) VALUES (?, ?, ?, ?, ?, 'pendiente', ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo "Error al preparar la consulta: " . mysqli_error($conn);
            exit;
        }
        $id_usr_creador = $_SESSION['id_usr'] ;

        mysqli_stmt_bind_param($stmt, 'ssssss', $titulo, $descripcion, $archivoProyecto['name'], $integrantesStr, $tagsStr, $id_usr_creador);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Proyecto guardado correctamente.";
        } else {
            echo "No se pudo guardar el proyecto.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error al subir el archivo.";
    }

    mysqli_close($conn);
} else {
    echo "Método no permitido.";
}
?>
