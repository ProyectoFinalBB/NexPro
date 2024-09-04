<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="adminFunciones.php" method="post">

<div>
<img src="" alt="">
<h1>Registra un Usuario</h1>
<label>Nombres</label>
<input type="text" name="nombreUsrRegistro" required>
<label>Apellidos</label>
<input type="text" name="apellidoUsrRegistro" required>
<label>Cedula</label>
<input type="text" name="ciUsrRegistro" required>
<label for="rol">Rol</label>
        <select id="rol" name="rolRegistro" required>
            <option value="administrador">Administrador</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>
        <button type="submit" name="registrarUsr" value="registrarUsr">Agregar Usuario</button>
</div>

</form>
</body>
</html>
