<?php 


session_start();
// Para la Seguridad

define('MY_APP', true);
if (isset($_SESSION['ci'])) {
include("../includes/header.php");
include("../includes/nav.php");
include("../includes/footer.php");



 
} else {
    include("login.php");
}


?>

