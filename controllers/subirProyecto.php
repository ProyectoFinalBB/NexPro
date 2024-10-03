<?php
session_start();
require '../includes/conexion.php';  
$conn = conectar_bd(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['nombreProyecto'];  
    $descripcion = $_POST['descProyecto'];  
    $archivoProyecto = $_FILES['archivoProyecto'];
    $tags = $_POST['tagsProyecto'];  
    $integrantesIDs = isset($_POST['integrantesIDs']) ? $_POST['integrantesIDs'] : [];  
     $idLogueado = $_SESSION['id_usr'];  


    $uploadDir = '../uploads/';
    $uploadFile = $uploadDir . basename($archivoProyecto['name']);
    
    if (move_uploaded_file($archivoProyecto['tmp_name'], $uploadFile)) {
        $idIntegrantes = implode(',', $integrantesIDs);

        $sqlProyecto = "INSERT INTO proyectos (titulo, descripcion, ruta, id_integrantes, tags) VALUES (?, ?, ?, ?, ?)";
        $stmtProyecto = mysqli_prepare($conn, $sqlProyecto);

        if ($stmtProyecto === false) {
            die("Error al preparar la consulta: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmtProyecto, 'sssss', $titulo, $descripcion, $archivoProyecto['name'], $idIntegrantes, $tags);
        mysqli_stmt_execute($stmtProyecto);

        echo "Proyecto guardado correctamente.";
    } else {
        echo "Error al subir el archivo.";
    }

    mysqli_close($conn);
}
?>
