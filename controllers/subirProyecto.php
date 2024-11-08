<?php
session_start(); 
if (!isset($_SESSION['id_usr'])) {
 header("Location: login.php"); 
    exit(); 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../includes/conexion.php';
    $conn = conectar_bd();

    $titulo = $_POST['nombreProyecto'];
    $descripcion = $_POST['descProyecto'];
    $integrantes = json_decode($_POST['integrantesIDs'], true);  
    $tags = json_decode($_POST['tagsProyecto'], true);  
    $archivoProyecto = $_FILES['archivoProyecto']; 
    $id_usr_creador = $_SESSION['id_usr'];  

    if (empty($titulo) || empty($descripcion)) {
        echo "Por favor, completa todos los campos requeridos.";
        exit;
    }

    if (empty($tags) || !is_array($tags)) {
        echo "Por favor, selecciona al menos un tag.";
        exit;
    }

    if (empty($archivoProyecto['name'])) {
        echo "Por favor, sube un archivo PDF.";
        exit;
    }

    if ($archivoProyecto['type'] !== 'application/pdf') {
        echo "Solo se permiten archivos PDF.";
        exit;
    }

    if ($archivoProyecto['size'] > 250000000) {
        echo "El archivo es demasiado grande. El límite es de 250MB.";
        exit;
    }
    
    $query = "SELECT COUNT(*) as count FROM proyectos WHERE titulo = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $titulo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] > 0) {
        echo "Ya existe un proyecto con ese nombre. Por favor, elige un nombre diferente.";
        exit;
    }

    mysqli_stmt_close($stmt);

    $uploadDir = '../uploads/pdfs/';
    $uploadFile = $uploadDir . basename($archivoProyecto['name']);

    if (file_exists($uploadFile)) {
        echo "Ya existe un archivo PDF con ese nombre. Por favor, renómbralo y vuelve a intentarlo.";
        exit;
    }

    $integrantes[] = $id_usr_creador;  
    $integrantesStr = implode(",", array_map('intval', $integrantes));  

    $query = "SELECT estado FROM proyectos WHERE id_usr_creador IN ($integrantesStr) OR id_integrantes REGEXP ?";
    $regexp = implode('|', array_map('intval', $integrantes)); 

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $regexp);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['estado'] === 'pendiente' || $row['estado'] === 'aceptado') {
            echo "Ya tienes un proyecto pendiente o aceptado. No puedes enviar otro proyecto.";
            exit;
        }
    }

    mysqli_stmt_close($stmt);

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); 
    }

    if (move_uploaded_file($archivoProyecto['tmp_name'], $uploadFile)) {
        $tagsStr = implode(",", $tags);
        $integrantesStr = implode(",", $integrantes);  

        $sql = "INSERT INTO proyectos (titulo, descripcion, ruta, id_integrantes, tags, estado, id_usr_creador) VALUES (?, ?, ?, ?, ?, 'pendiente', ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            echo "Error al preparar la consulta: " . mysqli_error($conn);
            exit;
        }

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