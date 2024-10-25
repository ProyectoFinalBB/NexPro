<?php
if (!isset($_SESSION['ci']) || $_SESSION["rol"]!=="alumno") {
    header('Location: ../public/login.php'); 
    exit();
}
?>

<form id="formularioProyecto" class="formulario-proyecto">
    <div>
        <div class="logo-boton">
            <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
        </div>
        <h2 class="titulo-pantalla">Subir Proyecto</h2>
        <input type="text" id="nombreProyecto" name="nombreProyecto" placeholder="Nombre del Proyecto" required class="input-proyecto">
        <textarea name="descProyecto" id="descProyecto" placeholder="Descripción del proyecto" required class="input-proyecto"></textarea>
        <label for="tagsProyecto">Selecciona los tags del proyecto:</label>
        <select id="tagsProyecto" name="project-tags[]" multiple class="input-proyecto" required>
            <option value="Finanzas">Finanzas</option>
            <option value="Marketing">Marketing</option>
            <option value="Ciencia">Ciencia</option>
            <option value="Tecnología">Tecnología</option>
            <option value="Programación">Programación</option>
            <option value="Investigación">Investigación</option>
            <option value="Ciber seguridad">Ciber seguridad</option>
            <option value="Videojuegos">Videojuegos</option>
            <option value="Educación">Educación</option>
            <option value="Entretenimiento">Entretenimiento</option>
            <option value="Medios de comunicación">Medios de comunicación</option>
            <option value="Redes sociales">Redes sociales</option>
            <option value="Política">Política</option>
            <option value="Salud">Salud</option>
            <option value="Nutrición">Nutrición</option>
            <option value="Deportes">Deportes</option>
            <option value="Gastronomía">Gastronomía</option>
            <option value="Transporte">Transporte</option>
            <option value="Medio ambiente">Medio ambiente</option>
            <option value="Animales">Animales</option>
        </select>
        <input type="file" id="archivoProyecto" name="archivoProyecto" accept=".pdf" required class="input-proyecto">
        <input type="text" id="integrantesProyecto" name="integrantesProyecto" placeholder="Etiquetar Integrantes" class="input-proyecto">
        <ul id="resultadosIntegrantes" class="resultados-integrantes"></ul>
        <ul id="integrantesSeleccionados" class="integrantes-seleccionados"></ul>

        <button type="submit" class="boton-enviar" id="solicitarRevisionBtn">Solicitar Revisión</button>
    </div>
</form>

<div id="mensajeResultado"></div>

<!-- Modal de Confirmación -->
<div id="confirmacionModal" class="confirmacion-modal" style="display: none;">
    <div class="confirmacion-contenido">
        <p id="mensajeConfirmacion"></p>
        <button id="btnConfirmar" class="btn-confirmar">Sí</button>
        <button id="btnCancelar" class="btn-cancelar">No</button>
    </div>
</div>

<script src="../assets/js/subirProyecto.js"></script>
