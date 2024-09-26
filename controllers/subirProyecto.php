<?php
session_start();

if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="alumno") {
    header('Location: ../public/login.php'); 
    exit();
}

include("../includes/conexion.php");
$con = conectar_bd();


if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreProyecto = $_POST['nombreProyecto'];
    $descProyecto = $_POST['descProyecto'];
    $tagsProyecto = $_POST['tagsProyecto']; 
    $integrantesProyecto = $_POST['integrantesProyecto'];

  
    if (isset($_FILES['archivoProyecto']) && $_FILES['archivoProyecto']['error'] === UPLOAD_ERR_OK) {
        $archivoTmp = $_FILES['archivoProyecto']['tmp_name'];
        $nombreArchivo = $_FILES['archivoProyecto']['name'];
        $rutaDestino = '../uploads/pdfs/' . $nombreArchivo;

 
        if (move_uploaded_file($archivoTmp, $rutaDestino)) {

            $stmt = $con->prepare("INSERT INTO proyectos (titulo, descripcion, ruta, id_integrantes, tags) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nombreProyecto, $descProyecto, $rutaDestino, $integrantesProyecto, $tagsProyecto);


            if ($stmt->execute()) {
                $_SESSION["err"] = "Proyecto subido y guardado en la base de datos exitosamente.";
            } else {
                $_SESSION["err"] = "Error al guardar el proyecto en la base de datos: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION["err"] = "Error al subir el archivo.";
        }
    } else {
        $_SESSION["err"] = "No se pudo subir el archivo PDF.";
    }
} else {
    $_SESSION["err"] = "Solicitud inválida.";
}

$con->close();
?>
