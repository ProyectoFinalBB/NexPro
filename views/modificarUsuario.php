<div class="form-container-modificar">
    <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
    <h1 class="titulo-pantalla">EDITAR UN PERFIL</h1>
    <img class="profile-image" id="profile-image" src="" alt="User Image">
    <div class="user-info" id="user-info"></div>

    <form class="formulario-edicion">
        <input id="inNames" type="text" placeholder="Nombres" value="" required class="input-modificar">
        <input id="inLastname" type="text" placeholder="Apellidos" value="" required class="input-modificar">
        <input id="inCedula" type="text" placeholder="Cédula" value="" required class="input-modificar">
        
        <select name="rol" id="inRol" required>
            <option value="alumno">Estudiante</option>
            <option value="profesor">Profesor</option>
            <option value="administrador">Administrador</option>
        </select>
        <p class="mensaje-error"></p>
        <button type="button" onclick="guardarCambios(param)" class="boton-enviar">GUARDAR CAMBIOS</button>
    </form>
</div>


<script src="../assets/js/modificarUsr.js"></script>
