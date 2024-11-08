<?php
include('../includes/conexion.php');
include("existeUsr.php");
session_start(); 


header('Content-Type: text/plain; charset=UTF-8');

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
                    echo 'Contraseña actualizada correctamente';
                } else {
                    echo 'Error en la actualización de la contraseña';
                }

            } else {
                echo 'La contraseña antigua no coincide';
            }

        } else {
            echo 'El usuario con esa cedula no existe';
        }

    } else {
        echo 'El usuario con esa cedula no existe';
    }

} else {
    echo 'Datos incompletos';
}

$conn->close();
