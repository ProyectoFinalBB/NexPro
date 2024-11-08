<?php
require("../includes/conexion.php");

$con = conectar_bd();

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (isset($data["ci"]) && isset($data["contrasenia"])) {
    $ci = $data["ci"];
    $pass = $data["contrasenia"];

    logear($con, $ci, $pass);
} else {
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos en el formato esperado.']);
}


function logear($con, $ci, $pass) {
    session_start();

    
    $consulta_login = "SELECT * FROM usuarios WHERE ci = '$ci'";
    $resultado_login = mysqli_query($con, $consulta_login);

    if ($resultado_login) {
        if (mysqli_num_rows($resultado_login) > 0) {
            $fila = mysqli_fetch_assoc($resultado_login);

            $password_bd = $fila["contrasenia"];
            $id_usr = $fila["id_usr"];
            $nombre = $fila["nombrecompleto"]; 
            if (password_verify($pass, $password_bd)) {

                $consulta_rol = "SELECT rol FROM roles WHERE id_usr = $id_usr";
                $resultado_rol = mysqli_query($con, $consulta_rol);

                if ($resultado_rol && mysqli_num_rows($resultado_rol) > 0) {
                    $fila_rol = mysqli_fetch_assoc($resultado_rol);
                    $rol = $fila_rol["rol"];

                    $_SESSION["ci"] = $ci;
                    $_SESSION["rol"] = $rol;
                    $_SESSION['id_usr'] = $id_usr;
                    $_SESSION["nombrecompleto"] = $nombre;

                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se encontró el rol para el usuario.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . mysqli_error($con)]);
    }

    mysqli_close($con);
}
?>
