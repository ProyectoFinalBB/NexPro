
<body>
    <form id="registroUsuarioForm" class="formulario-registro">
        <div>
            <div class="logo-boton">
                <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
            </div>
            <h2 id="tituloRegistro" class="titulo-pantalla">Registra un Usuario</h2> 
            <input type="text" id="nombreUsrRegistro" name="nombreUsrRegistro" placeholder="NOMBRES" required class="input-registro">
            <input type="text" id="apellidoUsrRegistro" name="apellidoUsrRegistro" placeholder="APELLIDOS" required class="input-registro"> 
            <input type="text" id="ciUsrRegistro" name="ciUsrRegistro" placeholder="CEDULA" required class="input-registro">
            <label for="rol" id="rolLabel">Rol</label>
            <select id="rolRegistro" name="rolRegistro" required>
            <option value="alumno" id="rolEstudiante">Estudiante</option> 
            <option value="profesor" id="rolProfesor">Profesor</option>
            <option value="administrador" id="rolAdministrador">Administrador</option> 
            </select>
            <button type="submit" class="boton-enviar" id="registrarUsrBtn" onclick="registrarUsuario()">Registrar</button>
        </div>
    </form>
    <div id="mensajeResultado" class="mensajeResultado"></div>


    <script src="../assets/js/registrarUsr.js"></script> 
    <script src="../assets/js/darkMode.js"></script>
    <script src="../assets/js/traduccion.js"></script>
</body>