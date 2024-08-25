<?php
include("../conexion.php");
$con = conectar_bd();
// ID del usuario al que se le cambiará la contraseña
$id_usuario = 1;

// Nueva contraseña en texto plano
$contraseña_nueva = '55353758';

// Hashear la nueva contraseña
$hash = password_hash($contraseña_nueva, PASSWORD_DEFAULT);

// Consulta para actualizar la contraseña del usuario
$consulta_actualizar = "UPDATE usuarios SET contrasenia = '$hash' WHERE id_usr = $id_usuario";

// Ejecutar la consulta
if (mysqli_query($con, $consulta_actualizar)) {
    echo "Contraseña del usuario con ID $id_usuario actualizada con éxito.";
} else {
    echo "Error al actualizar la contraseña: " . mysqli_error($con);
}

// Cierra la conexión a la base de datos
$con->close();
?>