<?php 


session_start();


define('MY_APP', true);

if (!defined('MY_APP')) {
    die('Acceso denegado');
}
if (isset($_SESSION['ci'])) {
include("../includes/header.php");
include("../includes/nav.php");
include("../includes/footer.php");



 
} else {
    include("login.php");
}


?>

