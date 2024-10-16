<?php
session_start();

if (isset($_SESSION['rol'])) {
    echo json_encode(['rol' => $_SESSION['rol']]);
} else {
    echo json_encode(['rol' => 'guest']); 
}
?>
