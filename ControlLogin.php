
<?php 
require("conexion.php");
$con = conectar_bd();
  


if (isset($_POST["envio"])) {

    $ci = $_POST["ci"];
    $pass = $_POST["contrasenia"];


    logear($con, $ci, $pass);
}
function logear($con, $ci, $pass) {
    session_start();

    $consulta_login = "SELECT * FROM usuarios WHERE ci = '$ci'";
    $resultado_login = mysqli_query($con, $consulta_login);

    if ($resultado_login) {
        if (mysqli_num_rows($resultado_login) > 0) {
            
            // Se crea una variable con el objeto fetch_assoc para acceder a las columnas que necesite
            $fila = mysqli_fetch_assoc($resultado_login);

            
            $password_bd = $fila["contrasenia"];
            $id_usr = $fila["id_usr"]; 

            // Uso la función password_verify para comparar lo que ingresa el usuario con lo que tengo en la BD
            if (password_verify($pass, $password_bd)) {
                
                // Consulta para obtener el rol del usuario desde la tabla 'roles'
                $consulta_rol = "SELECT rol FROM roles WHERE id_usr = $id_usr";
                $resultado_rol = mysqli_query($con, $consulta_rol);

                if ($resultado_rol && mysqli_num_rows($resultado_rol) > 0) {
                    $fila_rol = mysqli_fetch_assoc($resultado_rol);
                    $rol = $fila_rol["rol"];

                    // Guardar el CI y el rol en la sesión
                    $_SESSION["ci"] = $ci;
                    $_SESSION["rol"] = $rol;
                    
                    // Redirigir a la página principal o al área de usuario
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION["err"] = "No se encontró el rol para el usuario.";
                    header("Location: index.php");
                }
            } else {
                $_SESSION["err"] = "Contraseña incorrecta";
                header("Location: index.php");
            }
        } else {
            $_SESSION["err"] = "Usuario no encontrado";
            header("Location: index.php");
        }
    } else {
        // Manejo de errores en la consulta SQL
        $_SESSION["err"] = "Error en la consulta: " . mysqli_error($con);
        header("Location: index.php");
    }
}


?>