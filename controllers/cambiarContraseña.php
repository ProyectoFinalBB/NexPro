<?php
include('../includes/conexion.php');
include("existeUsr.php");

$data = json_decode(file_get_contents('php://input'), true);
$conn = conectar_bd();

if (isset($data['ci'], $data['oldPass'], $data['newPass'])) {

    $ci = $data['ci'];
    $oldPass = $data['oldPass'];
    $newPass = $data['newPass'];

    $existe_usr = consultar_existe_usr($conn, $ci);

    if ($existe_usr) {
        $queryPass = "SELECT contrasenia FROM usuarios WHERE ci = '$ci'";
        $resultPass = $conn->query($queryPass);

        if ($resultPass && $resultPass->num_rows > 0) {
            $userData = mysqli_fetch_assoc($resultPass);
            $hashedPass = $userData['contrasenia'];

            if (password_verify($oldPass, $hashedPass)) {
                $contrasenia = password_hash($newPass, PASSWORD_DEFAULT);

                $sql = "UPDATE usuarios SET contrasenia = '$contrasenia' WHERE ci = '$ci'";
                $result = $conn->query($sql);

                if ($result) {
                    echo json_encode(['Contraseña actualizada correctamente']);
                } else {
                    echo json_encode(['Error en la actualización de la contraseña']);
                }

            } else {
                echo json_encode(['La contraseña antigua no coincide']);
            }

        } else {
            echo json_encode(['El usuario con esa cédula no existe']);
        }

    } else {
        echo json_encode(['El usuario con esa cédula no existe']);
    }

} else {
    echo json_encode(['Datos incompletos']);
}

$conn->close();
