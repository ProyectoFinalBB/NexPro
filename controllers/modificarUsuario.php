<?php

// Recibir los datos enviados desde el frontend
$data = json_decode(file_get_contents('php://input'), true);
include('../includes/conexion.php');
$conn = conectar_bd();
if (isset($data['nombre'], $data['apellido'], $data['ci'], $data['rol'])) {
    // Conectar a la base de datos

    // Limpiar y asignar los datos recibidos
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $ci = $data['ci'];
    $rol = $data['rol'];

    // Suponiendo que tienes el id_usr en la sesión o lo pasas desde el frontend
    $id_usr = $data['id_usr']; 

    // Preparar los datos combinados para el nombre completo
    $nombreCompleto = "$nombre $apellido";

    // Actualizar los datos en la tabla usuarios
    $sql_usuarios = "UPDATE usuarios SET nombrecompleto = ?, ci = ? WHERE id_usr = ?";
    $stmt_usuarios = $conn->prepare($sql_usuarios);
    $stmt_usuarios->bind_param("ssi", $nombreCompleto, $ci, $id_usr);

    // Ejecutar la actualización de usuarios
    if ($stmt_usuarios->execute()) {
        // Actualizar el rol en la tabla roles
        $sql_roles = "UPDATE roles SET rol = ? WHERE id_usr = ?";
        $stmt_roles = $conn->prepare($sql_roles);
        $stmt_roles->bind_param("si", $rol, $id_usr);

        if ($stmt_roles->execute()) {
            // Si ambas consultas se ejecutan correctamente
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el rol.']);
        }

        $stmt_roles->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar los datos del usuario.']);
    }

    // Cerrar la conexión
    $stmt_usuarios->close();
    $conn->close();
} else {
    // Si faltan datos, enviamos un error
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
