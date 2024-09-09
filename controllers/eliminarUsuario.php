<?php
session_start();
include("../includes/conexion.php");
$con = conectar_bd();

header('Content-Type: application/json'); // Asegurarse de que la respuesta sea JSON

// Leer los datos JSON enviados por AJAX
$input = json_decode(file_get_contents('php://input'), true);

// Verificar que se ha recibido la acción y el ID del usuario desde la solicitud AJAX
if (isset($input["eliminarUsr"]) && isset($input['userId'])) {
    $id_usr = intval($input['userId']);
    
    // Iniciar una transacción
    mysqli_begin_transaction($con);
    
    try {
        // Eliminar el rol del usuario
        $consulta_eliminar_rol = "DELETE FROM roles WHERE id_usr = ?";
        $stmt_rol = mysqli_prepare($con, $consulta_eliminar_rol);
        mysqli_stmt_bind_param($stmt_rol, 'i', $id_usr);
        mysqli_stmt_execute($stmt_rol);
        
        // Verificar si se eliminó el rol correctamente
        if (mysqli_stmt_affected_rows($stmt_rol) > 0) {
            
            // Eliminar el usuario
            $consulta_eliminar_usuario = "DELETE FROM usuarios WHERE id_usr = ?";
            $stmt_usr = mysqli_prepare($con, $consulta_eliminar_usuario);
            mysqli_stmt_bind_param($stmt_usr, 'i', $id_usr);
            mysqli_stmt_execute($stmt_usr);
            
            // Verificar si se eliminó el usuario correctamente
            if (mysqli_stmt_affected_rows($stmt_usr) > 0) {
                // Confirmar la transacción
                mysqli_commit($con);
                echo json_encode(['status' => 'success', 'message' => 'Usuario eliminado correctamente']);
            } else {
                // Si falla la eliminación del usuario, revertir la transacción
                mysqli_rollback($con);
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el usuario']);
            }
        } else {
            // Si falla la eliminación del rol, revertir la transacción
            mysqli_rollback($con);
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el rol del usuario']);
        }
    } catch (Exception $e) {
        // En caso de error, revertir la transacción
        mysqli_rollback($con);
        echo json_encode(['status' => 'error', 'message' => 'Ocurrió un error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción o ID de usuario no proporcionados']);
}
?>
