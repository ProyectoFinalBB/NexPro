<?php 


session_start();
// Para la Seguridad

define('MY_APP', true);
if (isset($_SESSION['ci'])) {
   
    include("header.php");
    if($rol == "administrador"){
        include("administrador/adminGI.php");
    } elseif($rol == "alumno"){
        include("alumnoGI.php");
    }elseif($rol == "profesor"){
        include("profesorGI.php");
    }
    include("footer.php");
 
} else {
    include("login.php");
}





?>

