<?php
session_start();
if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="administrador") {
    header('Location: ../public/login.php'); 
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
include('../includes/conexion.php');
$conn = conectar_bd();

if (isset($data['nombre'], $data['apellido'], $data['ci'], $data['rol'])) {

    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $ci = $data['ci'];
    $rol = $data['rol'];
    $id_usr = $data['id_usr'];

    $nombreCompleto = "$nombre $apellido";

    $sql_usuarios = "UPDATE usuarios SET nombrecompleto = '$nombreCompleto', ci = '$ci' WHERE id_usr = $id_usr";
    $resultado_usuarios = mysqli_query($conn, $sql_usuarios);

    if ($resultado_usuarios) {
        $sql_roles = "UPDATE roles SET rol = '$rol' WHERE id_usr = $id_usr";
        $resultado_roles = mysqli_query($conn, $sql_roles);

        if ($resultado_roles) {
            echo json_encode(['Rol actualizado']);
        } else {
            echo json_encode(['Error al actualizar el rol.']);
        }
    } else {
        echo json_encode(['Error al actualizar los datos del usuario.']);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['Datos incompletos.']);
}
