
<div class="form-container">
        <img src="../assets/img/logo.png" alt="NexPro Logo">
        <h1>EDITAR UN PERFIL</h1>
        <img class="profile-image" id="profile-image" src="" alt="User Image">
        <div class="user-info" id="user-info"></div>

        <form >
            <input id="inNames" type="text" placeholder="" value="" required>
            <input id="inLastname" type="text" placeholder="" value="" required>
            <input id="inCedula" type="text" placeholder="" value="" required>
            
            <select name="rol" id="inRol" required>
                <option value="alumno">Estudiante</option>
                <option value="profesor">Profesor</option>
                <option value="administrador">Administrador</option>
            </select>
            <p id="mensajeResultado"></p>
            <button type="button" onclick="guardarCambios(param)" class="save-button">GUARDAR CAMBIOS</button>
        </form>
    </div>
    <script src="../assets/js/modificarUsr.js" ></script>


