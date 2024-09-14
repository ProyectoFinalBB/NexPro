<?php
session_start();
include("../includes/conexion.php");
$con = conectar_bd();

header('Content-Type: application/json'); 

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input["eliminarUsr"]) && isset($input['userId'])) {
    $id_usr = intval($input['userId']);
    
    mysqli_begin_transaction($con);
    
    try {
        $consulta_eliminar_rol = "DELETE FROM roles WHERE id_usr = ?";
        $stmt_rol = mysqli_prepare($con, $consulta_eliminar_rol);
        mysqli_stmt_bind_param($stmt_rol, 'i', $id_usr);
        mysqli_stmt_execute($stmt_rol);
        
        if (mysqli_stmt_affected_rows($stmt_rol) > 0) {
            
            $consulta_eliminar_usuario = "DELETE FROM usuarios WHERE id_usr = ?";
            $stmt_usr = mysqli_prepare($con, $consulta_eliminar_usuario);
            mysqli_stmt_bind_param($stmt_usr, 'i', $id_usr);
            mysqli_stmt_execute($stmt_usr);
            
    
            if (mysqli_stmt_affected_rows($stmt_usr) > 0) {

                mysqli_commit($con);
                echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado correctamente']);
            } else {
        
                mysqli_rollback($con);
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el usuario']);
            }
        } else {

            mysqli_rollback($con);
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el rol del usuario']);
        }
    } catch (Exception $e) {
        mysqli_rollback($con);
        echo json_encode(['status' => 'error', 'message' => 'Ocurrió un error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción o ID de usuario no proporcionados']);
}
?>
