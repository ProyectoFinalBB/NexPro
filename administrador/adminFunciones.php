<?php 
session_start();
require("../conexion.php");
$con = conectar_bd();





if (isset($_GET['id'])) {
//pasa el valor a int
    $id_usr = intval($_GET['id']);
    $consulta_eliminar_rol = "DELETE FROM roles WHERE id_usr = $id_usr";
    $resultado_eliminar_rol = mysqli_query($con, $consulta_eliminar_rol);

    if ($resultado_eliminar_rol) {
        // Eliminar el usuario
        $consulta_eliminar_usuario = "DELETE FROM usuarios WHERE id_usr = $id_usr";
        $resultado_eliminar_usuario = mysqli_query($con, $consulta_eliminar_usuario);

        if ($resultado_eliminar_usuario) {
            // Redirigir a la página de listado de usuarios
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION["err"] = "Error al eliminar el usuario: " . mysqli_error($con);
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION["err"] = "Error al eliminar el rol: " . mysqli_error($con);
        header("Location: ../index.php");
        exit();
    }
} else {
    echo "ID de usuario no proporcionado.";
}


//modificar usuario

if (isset($_POST['modificarUsr'])) {
    $id_usr = $_POST['id_usr']; 
    $nombre = $_POST['nombreUsrModificar'];
    $apellido = $_POST['apellidoUsrModificar'];
    $ci = $_POST['ciUsrModificar'];
    $rol = $_POST['rolModificar'];

    echo $id_usr, $nombre,$apellido,$ci, $rol ;

    modificarUsuario($con, $id_usr, $nombre, $apellido,$ci, $rol);
}

function modificarUsuario($con, $id_usr, $nombre, $apellido,$ci, $rol) {
    // Iniciar la sesión
   
    $nombreCompleto = $nombre . " " . $apellido;

    // Actualizar la tabla usuarios
    $sqlUsuarios = "UPDATE usuarios 
                    SET nombrecompleto = '$nombreCompleto', ci = '$ci'
                    WHERE id_usr = '$id_usr'";

    // Ejecutar la consulta de actualización de usuarios
    if (mysqli_query($con, $sqlUsuarios)) {
        // Actualizar la tabla roles
        $sqlRoles = "UPDATE roles 
                     SET rol = '$rol' 
                     WHERE id_usr = '$id_usr'";

        // Ejecutar la consulta de actualización de roles
        if (mysqli_query($con, $sqlRoles)) {
            $_SESSION['err'] = "Usuario modificado correctamente.";
        } else {
            $_SESSION['err'] = "Error al actualizar el rol: " . mysqli_error($con);
        }
    } else {
        $_SESSION['err'] = "Error al modificar el usuario: " . mysqli_error($con);
    }
    header("location: ../index.php");
}

?>
