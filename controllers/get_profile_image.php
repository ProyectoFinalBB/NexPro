<?php
session_start();
include('../includes/conexion.php'); 
$conn = conectar_bd();  

$response = [
    'success' => false,
    'imagePath' => ''
];

if (isset($_SESSION['id_usr'])) {
    $id_usuario = $_SESSION['id_usr'];

    $sql = "SELECT ruta_img FROM usuarios WHERE id_usr = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($ruta_img);
    $stmt->fetch();
    $stmt->close();

    if ($ruta_img) {
        $response['success'] = true;
        $response['imagePath'] = $ruta_img;
    } else {
        $response['imagePath'] = '../assets/img/sinIMg.jpg'; 
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();  
?>
