<?php

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

    $sql_usuarios = "UPDATE usuarios SET nombrecompleto = ?, ci = ? WHERE id_usr = ?";
    $stmt_usuarios = $conn->prepare($sql_usuarios);
    $stmt_usuarios->bind_param("ssi", $nombreCompleto, $ci, $id_usr);

    if ($stmt_usuarios->execute()) {
        $sql_roles = "UPDATE roles SET rol = ? WHERE id_usr = ?";
        $stmt_roles = $conn->prepare($sql_roles);
        $stmt_roles->bind_param("si", $rol, $id_usr);

        if ($stmt_roles->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el rol.']);
        }

        $stmt_roles->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos del usuario.']);
    }


    $stmt_usuarios->close();
    $conn->close();
} else {
   
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
