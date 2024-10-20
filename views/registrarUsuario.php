<?php
if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="administrador") {
    header('Location: ../public/login.php'); 
    exit();
}
?>
<form id="registroUsuarioForm" class="formulario-registro">
    <div>
        <div class="logo-boton">

        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
</div>
        <h2 class="titulo-pantalla">Registra un Usuario</h2>
        <input type="text" id="nombreUsrRegistro" name="nombreUsrRegistro" placeholder="NOMBRES" required class="input-registro">
        <input type="text" id="apellidoUsrRegistro" name="apellidoUsrRegistro" placeholder="APELLIDOS" required class="input-registro"> 
        <input type="text" id="ciUsrRegistro" name="ciUsrRegistro" placeholder="CEDULA" required class="input-registro">
        <label for="rol">Rol</label>
        <select id="rolRegistro" name="rolRegistro" required>
            <option value="administrador">Administrador</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>
        <button type="submit" class="boton-enviar" id="registrarUsrBtn" onclick="registrarUsuario()">Registrar</button>
    </div>
</form>
<div id="mensajeResultado"></div> 
<script src="../assets/js/registrarUsr.js"></script> 
<script src="../assets/js/darkMode.js"></script>




