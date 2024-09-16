<div class="form-container-modificar">
<div class="logo-boton">
        <button onclick="window.history.back();" class="boton-retroceder">⭠</button>
        <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
</div>
    <h1 class="titulo-pantalla">EDITAR UN PERFIL</h1>
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
    <p class="texto-pie">©2024 DESARROLLADORES CLAJ</p>
<img src="../assets/img/bannerUtu.png" alt="Banner UTU" class="banner-utu">
    <script src="../assets/js/modificarUsr.js" ></script>
