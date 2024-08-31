<?php 
session_start();
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


if(isset($_POST["PROFESORBTN"])){
    $_SESSION["listadoElección"] = $_POST["PROFESORBTN"];
    $le = $_SESSION["listadoElección"] ;
    listados ($le, $con);
} elseif(isset($_POST["ADMINISTRADORBTN"])){
    $_SESSION["listadoElección"] = $_POST["ADMINISTRADORBTN"];
    $le = $_SESSION["listadoElección"] ;
    listados ($le, $con);
}elseif(isset($_POST["ALUMNOBTN"])){
    $_SESSION["listadoElección"] = $_POST["ALUMNOBTN"];
    $le = $_SESSION["listadoElección"] ;
    listados ($le, $con);
}

function listados ($le, $con){

    session_start();
switch ($le){
    case "PROFESORBTN":
                     listaProfesor($con);
                    break;
    case "ADMINISTRADORBTN":
                     listaAdministradores($con);
                    break;
    case "ALUMNOBTN":
                     listaAlumnos($con);
                    break;
}
header("Location: ../index.php");
exit();
}

function listaProfesor($con) {
    session_start();
    $sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci 
            FROM usuarios 
            INNER JOIN roles ON usuarios.id_usr = roles.id_usr 
            WHERE roles.rol = 'profesor'";
    $result = mysqli_query($con, $sql);

    $salida = '';

    if ($result && mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            $salida .= "<div class='usuario-item'>";
            $salida .= "<img src='ruta_a_imagen_perfil.png' alt='Foto de perfil' class='icono-perfil'>";
            $salida .= "<span class='nombre-usuario'>" . htmlspecialchars($fila['nombrecompleto']) . "</span>";
            $salida .= "<span class='ci-usuario'>" . htmlspecialchars($fila['ci']) . "</span>";
            $salida .= "<img src='ruta_a_icono_lapiz.png' alt='Modificar' class='icono-modificar'>";
            $salida .= "<img src='ruta_a_icono_basura.png' alt='Eliminar' class='icono-eliminar'>";
            $salida .= "</div>";
        }
    } else {
        $salida = "No se encontraron profesores.";
    }

    $_SESSION['salida'] = $salida;
}



function listaAdministradores($con) {
    session_start();
    $sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci 
            FROM usuarios 
            INNER JOIN roles ON usuarios.id_usr = roles.id_usr 
            WHERE roles.rol = 'administrador'";
    $result = mysqli_query($con, $sql);

    $salida = '';

    if ($result && mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            $salida .= "<div class='usuario-item'>";
            $salida .= "<img src='ruta_a_imagen_perfil.png' alt='Foto de perfil' class='icono-perfil'>";
            $salida .= "<span class='nombre-usuario'>" . htmlspecialchars($fila['nombrecompleto']) . "</span>";
            $salida .= "<span class='ci-usuario'>" . htmlspecialchars($fila['ci']) . "</span>";
            $salida .= "<img src='ruta_a_icono_lapiz.png' alt='Modificar' class='icono-modificar'>";
            $salida .= "<img src='ruta_a_icono_basura.png' alt='Eliminar' class='icono-eliminar'>";
            $salida .= "</div>";
        }
    } else {
        $salida = "No se encontraron Administradores.";
    }

    $_SESSION['salida'] = $salida;
}
function listaAlumnos($con) {
    session_start();
    $sql = "SELECT usuarios.id_usr, usuarios.nombrecompleto, usuarios.ci 
            FROM usuarios 
            INNER JOIN roles ON usuarios.id_usr = roles.id_usr 
            WHERE roles.rol = 'alumno'";
    $result = mysqli_query($con, $sql);

    $salida = '';

    if ($result && mysqli_num_rows($result) > 0) {
        while ($fila = mysqli_fetch_assoc($result)) {
            $salida .= "<div class='usuario-item'>";
            $salida .= "<img src='ruta_a_imagen_perfil.png' alt='Foto de perfil' class='icono-perfil'>";
            $salida .= "<span class='nombre-usuario'>" . htmlspecialchars($fila['nombrecompleto']) . "</span>";
            $salida .= "<span class='ci-usuario'>" . htmlspecialchars($fila['ci']) . "</span>";
            $salida .= "<img src='ruta_a_icono_lapiz.png' alt='Modificar' class='icono-modificar'>";
            $salida .= "<img src='ruta_a_icono_basura.png' alt='Eliminar' class='icono-eliminar'>";
            $salida .= "</div>";
        }
    } else {
        $salida = "No se encontraron Alumnos.";
    }

    $_SESSION['salida'] = $salida;
}
?>