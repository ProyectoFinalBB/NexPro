<?php
include("../includes/conexion.php");
include("existeUsr.php");
include("validarCI.php");
session_start();

if (!isset($_SESSION['ci']) || $_SESSION["rol"] !== "administrador") {
    header('Location: ../public/login.php'); 
    exit();
}

$con = conectar_bd();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data["registrarUsr"])) {
    $nombre = $data["nombreUsrRegistro"];
    $apellido = $data["apellidoUsrRegistro"];
    $ci = $data["ciUsrRegistro"];
    $rol = $data["rolRegistro"];
    $contrasenia = $ci;
    $nombreCompleto = $nombre . " " . $apellido;

   
    $limiteNombre = 50; 
    $limiteApellido = 50;

  
    $soloLetras = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";

    if (!preg_match($soloLetras, $nombre) || !preg_match($soloLetras, $apellido)) {
        echo ('El nombre y el apellido solo pueden contener letras.');
        exit();
    }

    if (strlen($nombre) > $limiteNombre || strlen($apellido) > $limiteApellido) {
        echo ('El nombre o apellido exceden el límite de caracteres.');
        exit();
    }

    $existe_usr = consultar_existe_usr($con, $ci);

    if (validarCI($ci)) {
        registrarUsr($con, $nombreCompleto, $ci, $contrasenia, $rol, $existe_usr);
    } else {
        echo ('Cedula invalida');
    }
}

function registrarUsr($con, $nombreCompleto, $ci, $contrasenia, $rol, $existe_usr) {
    if (!$existe_usr) {
        $ci = mysqli_real_escape_string($con, $ci);
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
        $consulta_insertar = "INSERT INTO usuarios (nombrecompleto, ci, contrasenia) VALUES ('$nombreCompleto', '$ci', '$contrasenia')";
        
        if (mysqli_query($con, $consulta_insertar)) {
            $id_usr = mysqli_insert_id($con);
            echo ('Usuario insertado correctamente');
            $consulta_insertarRol = "INSERT INTO roles (id_usr, rol) VALUES ('$id_usr', '$rol')";
            if(mysqli_query($con, $consulta_insertarRol)) {
                
            } else {
                echo ('Error al insertar el rol');
            }
        } else {
            echo ('Error al insertar el usuario');
        }
    } else {
        echo ('El usuario ya existe');
    }
}
?>
