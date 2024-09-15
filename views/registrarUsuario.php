
    
<form id="registroUsuarioForm">
    <div>
        <img src="../assets/css/styles.css" alt="">
        <h2>Registra un Usuario</h2>
        <input type="text" id="nombreUsrRegistro" name="nombreUsrRegistro" placeholder="NOMBRES" required>
        <input type="text" id="apellidoUsrRegistro" name="apellidoUsrRegistro" placeholder="APELLIDOS" required>
        <input type="text" id="ciUsrRegistro" name="ciUsrRegistro" placeholder="CEDULA" required>
        <label for="rol">Rol</label>
        <select id="rolRegistro" name="rolRegistro" required>
            <option value="administrador">Administrador</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>
        <button type="submit" class="boton-enviar" id="registrarUsrBtn" onclick="registrarUsuario()">Agregar Usuario</button>
    </div>
</form>
<div id="mensajeResultado"></div> 

<script src="../assets/js/registrarUsr.js"></script>
