<?php 


session_start();
// Para la Seguridad

define('MY_APP', true);
if (isset($_SESSION['ci'])) {
   
    include("header.php");
    
    include("footer.php");
 
} else {
    include("login.php");
}





?>

