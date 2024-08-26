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

   if (validarCI($ci)) {
    $existe_usr = consultar_existe_usr($con, $ci);
   registrarUsr($con, $nombreCompleto, $ci, $contrasenia, $rol, $existe_usr);
} else {
    echo "<p>La cédula $ci no es válida.</p>";
    
}

   
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

function validarCI($ci) {
    // Verificar que la ci tenga 8 dígitos si o si:)
    if (strlen($ci) !== 8) {
        return false;
    }

    // sacar el número de la cédula
    $numero = "";
    for ($i = 0; $i < 7; $i++) {
        if ($ci[$i] < 1 || $ci[$i] > 9) {
            return false; 
        }
        $numero .= $ci[$i]; // agrega los números de la cédula a la variable numero uno x uno
    }
    $digito_verificador = $ci[7];

    
    $digito_verificador_esperado = calcularDigitoVerificador($numero);

   
    if ($digito_verificador == $digito_verificador_esperado) { // Compara el dígito verificador ingresado con el esperado
       
        return true; // si los dígitos verificadores son iguals entonces la cédula es valida
    } else {
        return false;
    }
}


function calcularDigitoVerificador($numero) {
   
    if (strlen($numero) !== 7) { // verificar que la cedula tenga 7 dígitos
        return false;
    }

    
    $multiplicadores = [2, 9, 8, 7, 6, 3, 4];// numeros que se multiplican para cada posicion 
    $suma = 0;

 
    for ($i = 0; $i < 7; $i++) {
        if ($numero[$i] < 0 || $numero[$i] > 9) {
            return false; // si encuentra un carácter que no es un numero tiene que retornar falso
        }
        $suma = $suma + ($numero[$i] * $multiplicadores[$i]);
    }


    $mayor_que_termina_en_0 = ceil($suma / 10) * 10; //ceil lo q hace es ponele 23.1 lo sube  a 24 directamente y multiplica x 10

    $digito_verificador = $mayor_que_termina_en_0 - $suma;

    return $digito_verificador;
}

?>
