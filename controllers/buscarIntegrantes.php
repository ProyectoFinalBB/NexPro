<?php
session_start(); 
if (!isset($_SESSION['id_usr'])) {
 header("Location: login.php"); 
    exit(); 
}

include('../includes/conexion.php'); 
$conn = conectar_bd(); 

if ($conn === false) {
    echo 'Error en la conexión a la base de datos.';
    exit();
}

$query = $_POST['query'] ?? '';
$idLogueado = $_SESSION['id_usr'];  

if (!empty($query)) {
  $sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto 
          FROM usuarios 
          INNER JOIN roles ON usuarios.id_usr = roles.id_usr 
          WHERE roles.rol = 'alumno' 
          AND usuarios.id_usr != ? 
          AND usuarios.nombrecompleto LIKE ?
          AND usuarios.id_usr NOT IN (
              SELECT usuarios.id_usr 
              FROM proyectos 
              WHERE estado IN ('pendiente', 'aceptado') 
              AND FIND_IN_SET(usuarios.id_usr, proyectos.id_integrantes) > 0
          )";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        $param = '%' . $query . '%';
        mysqli_stmt_bind_param($stmt, 'is', $idLogueado, $param);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            while ($usuario = mysqli_fetch_assoc($result)) {
                echo '<li class="integrante-item" data-id="' . $usuario['id_usr'] . '">' . htmlspecialchars($usuario['nombrecompleto']) . '</li>';
            }
        } else {
            echo '<li>No se encontraron resultados.</li>';
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
