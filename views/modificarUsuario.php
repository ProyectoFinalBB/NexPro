<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Modificar Usuario</title>
</head>
<body>


    <form action="adminFunciones.php" method="post">
        <div class="contein-img">
        <img src="../assets/img/logo.png" alt="Logo de NexPro" class="logo2"></div>
        <h1>Editar un Usuario</h1>
        <div class="form-modificar ">
        <label for="nombreUsrModificar">Nombres</label>
        <input type="text" id="nombreUsrModificar" name="nombreUsrModificar" class="input-rol" required>
        
        <label for="apellidoUsrModificar">Apellidos</label>
        <input type="text" id="apellidoUsrModificar" name="apellidoUsrModificar" class="input-rol" required>
        
        <label for="ciUsrModificar">Cedula</label>
        <input type="text" id="ciUsrModificar" name="ciUsrModificar" class="input-rol" required>
        
        <input type="hidden" name="id_usr" value="<?php echo $id_usr; ?>">
        </div>
        <label for="rol">Rol</label>
        <select id="rol" name="rolModificar" class="input-rol1" required>
            <option value="administrador">Administrador</option>
            <option value="alumno">Alumno</option>
            <option value="profesor">Profesor</option>
        </select>

        <button type="submit" name="modificarUsr" value="modificarUsr" class="submit-btn" onclick="return confirmarModificación()">Modificar Usuario</button>
    </form>
</div>

<script src="../script.js"></script>
</body>
</html>
