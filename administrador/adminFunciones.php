<?php 
require("../conexion.php");
$con = conectar_bd();
if(isset($_POST["addusr"])){
    header("location: registrarUsuario.php");
}

if(isset($_POST["registrarUsr"])){
   $nombre = $_POST["nombreUsrRegistro"];
   $apellido = $_POST["apellidoUsrRegistro"];
   $ci = $_POST["ciUsrRegistro"];
   $rol = $_POST["rolRegistro"];
   $contrasenia = $ci;
   $nombreCompleto = $nombre . " " . $apellido;

   $existe_usr = consultar_existe_usr($con, $ci);
   registrarUsr($con, $nombreCompleto, $ci, $contrasenia, $rol, $existe_usr);
}

function consultar_existe_usr($con, $ci) {

    $ci = mysqli_real_escape_string($con, $ci); // Escapar los campos para evitar inyección SQL
    $consulta_existe_usr = "SELECT ci FROM usuarios WHERE ci = '$ci'";
    $resultado_existe_usr = mysqli_query($con, $consulta_existe_usr);

    if (mysqli_num_rows($resultado_existe_usr) > 0) {
        return true;
    } else {
        return false;
    }
}
function registrarUsr($con, $nombreCompleto, $ci, $contrasenia, $rol, $existe_usr) {
    session_start();
    if ($existe_usr == false) {
        $ci = mysqli_real_escape_string($con, $ci);

        // Encripto la contraseña usando la función password_hash
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

        // Consulta para insertar en la tabla usuarios
        $consulta_insertar = "INSERT INTO usuarios (nombrecompleto, ci, contrasenia) VALUES ('$nombreCompleto', '$ci', '$contrasenia')";

        // Ejecuto la consulta y verifico si la inserción fue exitosa
        if (mysqli_query($con, $consulta_insertar)) {
            // Obtengo el ID del usuario recién insertado
            $id_usr = mysqli_insert_id($con);
            $_SESSION["errRegistro"] = "Usuario registrado con Exito ";
            header("Location: ../index.php");
            exit();
            // Inserto el rol del usuario en la tabla roles
            $consulta_insertarRol = "INSERT INTO roles (id_usr, rol) VALUES ('$id_usr', '$rol')";
            if(mysqli_query($con, $consulta_insertarRol)) {
                $_SESSION["errRegistro"] = " - Rol insertado correctamente";
                header("Location: ../index.php");
                exit();
            } else {
                $_SESSION["errRegistro"] = " - Error al insertar el rol: " . mysqli_error($con);
                header("Location: ../index.php");
                exit();
            }
        } else {
            $_SESSION["errRegistro"] = "Error al registrar el usuario: " . mysqli_error($con);
            header("Location: ../index.php");
            exit();
        }
    } else {
       $_SESSION["errRegistro"] = "El usuario ya existe.";
       header("Location: ../index.php");
       exit();
    }
}

?>
