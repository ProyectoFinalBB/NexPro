<?php
session_start();

if (!isset($_SESSION['ci']) && $_SESSION["rol"] !== "administrador") {
    header('Location: ../public/login.php');
    exit();
}

include("../includes/conexion.php");
$con = conectar_bd();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_usr']) && isset($data['restablecerContrasenia'])) {
    $id_usr = intval($data['id_usr']);

  
    $consulta_ci = "SELECT ci FROM usuarios WHERE id_usr = $id_usr";
    $resultado_ci = mysqli_query($con, $consulta_ci);

    if ($resultado_ci && mysqli_num_rows($resultado_ci) > 0) {
        $row = mysqli_fetch_assoc($resultado_ci);
        $ci = $row['ci'];

       
        $nuevaContrasenia = password_hash($ci, PASSWORD_DEFAULT);
        $consulta_actualizar = "UPDATE usuarios SET contrasenia = '$nuevaContrasenia' WHERE id_usr = $id_usr";

        if (mysqli_query($con, $consulta_actualizar)) {
            echo json_encode(['status' => 'success', 'message' => 'Contraseña restablecida correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la contraseña']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
}
?>
