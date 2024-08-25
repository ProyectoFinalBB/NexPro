<?php
include("../conexion.php");
$con = conectar_bd();


// Consulta para seleccionar los usuarios con contraseñas en texto plano
$consulta = "SELECT id_usr, contrasenia FROM usuarios";
$resultado = mysqli_query($con, $consulta);

if ($resultado) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $id_usuario = $fila['id_usr'];
        $contraseña_texto_plano = $fila['contrasenia'];

        // Hashear la contraseña en texto plano
        $hash = password_hash($contraseña_texto_plano, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos con el hash
        $consulta_actualizar = "UPDATE usuarios SET contrasenia = '$hash' WHERE id_usr = '$id_usuario'";
        
        if (mysqli_query($con, $consulta_actualizar)) {
            echo "Contraseña del usuario con ID $id_usuario actualizada con éxito.<br>";
        } else {
            echo "Error al actualizar la contraseña del usuario con ID $id_usuario: " . mysqli_error($con) . "<br>";
        }
    }
} else {
    echo "Error en la consulta: " . mysqli_error($con);
}

// Cierra la conexión a la base de datos
$con->close();
?>