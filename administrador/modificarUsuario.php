<?php 
session_start();
$id_usr = $_GET['id']; 
?>
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
<h1>Modificar un Usuario</h1>
<label>Nombres</label>
<input type="text" name="nombreUsrModificar" required>
<label>Apellidos</label>
<input type="text" name="apellidoUsrModificar" required>
<label>Cedula</label>
<input type="text" name="ciUsrModificar" required>

<input type="hidden" name="id_usr" value="<?php echo $id_usr; ?>">
<label for="rol">Rol</label>
        <select id="rol" name="rolModificar" required>
            <option value="administrador">Administrador</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>


        <button type="submit" name="modificarUsr" value="modificarUsr" onclick="return confirmarModificación()">Modificar Usuario</button>
</div>

</form>
<script src="../script.js"></script>
</body>
</html>