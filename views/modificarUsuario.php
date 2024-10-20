<?php
if (!isset($_SESSION['ci']) && $_SESSION["rol"]!=="administrador") {
    header('Location: ../public/login.php'); 
    exit();
}
?>
<div class="form-container-modificar">
<div class="logo-boton">
        
        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
</div>
    <h2 class="titulo-pantalla">EDITAR UN PERFIL</h2>
    <img class="profile-image" src="../assets/img/PerfilM.png" alt="User Image">
    <div class="user-info" id="user-info"></div>

        <form >
            <input id="inNames" type="text" placeholder="NOMBRES"  required class="input-modificar">
            <input id="inLastname" type="text" placeholder="APELLIDOS"  required class="input-modificar">
            <input id="inCedula" type="text" placeholder="CEDULA"  required class="input-modificar">
            
            <select name="rol" id="inRol" required>
                <option value="alumno">Estudiante</option>
                <option value="profesor">Profesor</option>
                <option value="administrador">Administrador</option>
            </select>
            <p id="mensajeResultado"></p>
            <button type="button" onclick="guardarCambios(param)" class="boton-enviar">GUARDAR CAMBIOS</button>
        </form>
    </div>

    <script src="../assets/js/modificarUsr.js" ></script>
    <script src="../assets/js/darkMode.js"></script>
    <script src="../assets/js/traduccion.js"></script>
