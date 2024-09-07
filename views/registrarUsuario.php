<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post" id="registroUsuarioForm">
    <div>
        <img src="" alt="">
        <h1>Registra un Usuario</h1>
        <label>Nombres</label>
        <input type="text" id="nombreUsrRegistro" name="nombreUsrRegistro" required>
        <label>Apellidos</label>
        <input type="text" id="apellidoUsrRegistro" name="apellidoUsrRegistro" required>
        <label>Cédula</label>
        <input type="text" id="ciUsrRegistro" name="ciUsrRegistro" required>
        <label for="rol">Rol</label>
        <select id="rolRegistro" name="rolRegistro" required>
            <option value="administrador">Administrador</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>
        <button type="button" id="registrarUsrBtn" onclick="registrarUsuario()">Agregar Usuario</button>
    </div>
</form>
<div id="mensajeResultado"></div> <!-- Para mostrar mensajes de éxito o error -->

</body>
</html>
