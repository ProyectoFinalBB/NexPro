<?php
if (!isset($_SESSION['ci']) && $_SESSION["rol"] !== "administrador") {
    header('Location: ../public/login.php'); 
    exit();
}
?>
<div class="form-container-modificar">
    <div class="logo-boton">
        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
    </div>
    <h2 id="tituloPantalla" class="titulo-pantalla">EDITAR UN PERFIL</h2> <!-- Agregado id="tituloPantalla" -->
    <img class="profile-image" src="../assets/img/PerfilM.png" alt="User Image">
    <div class="user-info" id="user-info"></div>

    <form>
        <input id="inNames" type="text" placeholder="NOMBRES" required class="input-modificar"> <!-- Agregado id="inNames" -->
        <input id="inLastname" type="text" placeholder="APELLIDOS" required class="input-modificar"> <!-- Agregado id="inLastname" -->
        <input id="inCedula" type="text" placeholder="CÉDULA" required class="input-modificar"> <!-- Agregado id="inCedula" -->
        
        <select name="rol" id="inRol" required>
            <option value="alumno" id="rolEstudiante">Estudiante</option> <!-- Agregado id="rolEstudiante" -->
            <option value="profesor" id="rolProfesor">Profesor</option> <!-- Agregado id="rolProfesor" -->
            <option value="administrador" id="rolAdministrador">Administrador</option> <!-- Agregado id="rolAdministrador" -->
        </select>

        <p id="mensajeResultado"></p>
        <button type="button" onclick="guardarCambios(param)" id="btnGuardarCambios" class="boton-enviar">GUARDAR CAMBIOS</button> <!-- Agregado id="btnGuardarCambios" -->
    </form>
</div>

<script src="../assets/js/modificarUsr.js"></script>
<script src="../assets/js/darkMode.js"></script>
<script src="../assets/js/traduccion.js"></script>
