<?php
if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="alumno") {
    header('Location: ../public/login.php'); 
    exit();
}
?>
<form id="formularioProyecto" class="formulario-proyecto">
    <div>
        <div class="logo-boton">
            <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
        </div>
        <h2 class="titulo-pantalla">Subir Proyecto</h2>
        <input type="text" id="nombreProyecto" name="nombreProyecto" placeholder="Nombre del Proyecto" required class="input-proyecto">
        <input type="text" id="tagsProyecto" name="tagsProyecto" placeholder="Tags del Proyecto" required class="input-proyecto">
        <input type="file" id="archivoProyecto" name="archivoProyecto" accept=".pdf" required class="input-proyecto">
        <input type="text" id="integrantesProyecto" name="integrantesProyecto" placeholder="Etiquetar Integrantes" required class="input-proyecto">
        
        <button type="submit" class="boton-enviar" id="solicitarRevisionBtn">Solicitar Revisión</button>
    </div>
</form>
<div id="mensajeResultado"></div> 
<script src="../assets/js/??????.js"></script>
