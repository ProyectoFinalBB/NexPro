<form id="registroUsuarioForm" class="formulario-registro">
    <div>
        <img src="../assets/img/logo.png" alt="NexPro Logo">
        <h1 class="titulo-pantalla">Registra un Usuario</h1>
        <label for="nombreUsrRegistro">Nombres</label>
        <input type="text" id="nombreUsrRegistro" name="nombreUsrRegistro" required class="input-registro">
        <label for="apellidoUsrRegistro">Apellidos</label>
        <input type="text" id="apellidoUsrRegistro" name="apellidoUsrRegistro" required class="input-registro">
        <label for="ciUsrRegistro">Cédula</label>
        <input type="text" id="ciUsrRegistro" name="ciUsrRegistro" required class="input-registro">
        <label for="rolRegistro">Rol</label>
        <select id="rolRegistro" name="rolRegistro" required>
            <option value="administrador">Administrador</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>
        <button type="button" id="registrarUsrBtn" onclick="registrarUsuario()" class="boton-enviar">Registrar</button>
    </div>
</form>
<div class="mensaje-error"></div> <!-- Para mostrar mensajes de éxito o error -->


<script src="../assets/js/registrarUsr.js"></script>
