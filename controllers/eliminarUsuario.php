<?php
session_start();

if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="administrador") {
    header('Location: ../public/login.php'); 
    exit();
}

include("../includes/conexion.php");
$con = conectar_bd();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input["eliminarUsr"]) && isset($input['userId'])) {
    $id_usr = intval($input['userId']);

    $consulta_eliminar_rol = "DELETE FROM roles WHERE id_usr = $id_usr";
    $resultado_rol = mysqli_query($con, $consulta_eliminar_rol);

    if ($resultado_rol) {

        $consulta_eliminar_usuario = "DELETE FROM usuarios WHERE id_usr = $id_usr";
        $resultado_usr = mysqli_query($con, $consulta_eliminar_usuario);

        if ($resultado_usr) {
            echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el usuario']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el rol del usuario']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción o ID de usuario no proporcionados']);
}
?>
