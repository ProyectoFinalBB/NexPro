<form id="registroUsuarioForm" class="formulario-registro">
    <div>
        <div class="logo-boton">
        <button onclick="window.history.back();" class="boton-retroceder">⭠</button>
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

<p class="texto-pie">©2024 DESARROLLADORES CLAJ</p>
<img src="../assets/img/bannerUtu.png" alt="Banner UTU" class="banner-utu">
<script src="../assets/js/registrarUsr.js"></script>   



