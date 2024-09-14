<?php
include("../includes/conexion.php");
include("existeUsr.php");
$con = conectar_bd();
$data = json_decode(file_get_contents('php://input'), true);

if(isset($data["registrarUsr"])) {
    $nombre = $data["nombreUsrRegistro"];
    $apellido = $data["apellidoUsrRegistro"];
    $ci = $data["ciUsrRegistro"];
    $rol = $data["rolRegistro"];
    $contrasenia = $ci;
    $nombreCompleto = $nombre . " " . $apellido;

    $existe_usr = consultar_existe_usr($con, $ci);

    registrarUsr($con, $nombreCompleto, $ci, $contrasenia, $rol, $existe_usr);
}


function registrarUsr($con, $nombreCompleto, $ci, $contrasenia, $rol, $existe_usr) {
    if (!$existe_usr) {
        $ci = mysqli_real_escape_string($con, $ci);
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
        $consulta_insertar = "INSERT INTO usuarios (nombrecompleto, ci, contrasenia) VALUES ('$nombreCompleto', '$ci', '$contrasenia')";
        if (mysqli_query($con, $consulta_insertar)) {
            $id_usr = mysqli_insert_id($con);
            $mensaje = "Usuario registrado con éxito";
            $consulta_insertarRol = "INSERT INTO roles (id_usr, rol) VALUES ('$id_usr', '$rol')";
            if(mysqli_query($con, $consulta_insertarRol)) {
                $mensaje .= " - Rol insertado correctamente";
                echo $mensaje;
            } else {
                echo "Error al insertar el rol: " . mysqli_error($con); 
            }
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($con);
        }
    } else {
        echo "El usuario ya existe."; 
    }
}
?>


