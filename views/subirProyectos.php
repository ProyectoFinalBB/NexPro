<form id="formularioProyecto" class="formulario-proyecto">
    <div>
        <div class="logo-boton">
            <img src="../assets/img/logo.png" alt="NexPro Logo" class="logo-nexpro">
        </div>
        <h2 id="tituloSubirProyecto" class="titulo-pantalla">Subir Proyecto</h2> 
        
        <input type="text" id="nombreProyecto" name="nombreProyecto" placeholder="Nombre del Proyecto" required class="input-proyecto">
        
        <textarea name="descProyecto" id="descProyecto" placeholder="Descripción del proyecto" required class="input-proyecto"></textarea> 
        
        <label for="tagsProyecto" id="labelTagsProyecto">Selecciona los tags del proyecto:</label> 
        
        <select id="tagsProyecto" name="project-tags[]" multiple class="input-proyecto">
            <option value="Finanzas" id="opcionFinanzas">Finanzas</option>
            <option value="Marketing" id="opcionMarketing">Marketing</option>
            <option value="Ciencia" id="opcionCiencia">Ciencia</option>
            <option value="Tecnología" id="opcionTecnologia">Tecnología</option>
            <option value="Programación" id="opcionProgramacion">Programación</option>
            <option value="Investigación" id="opcionInvestigacion">Investigación</option>
            <option value="Ciber seguridad" id="opcionCiberSeguridad">Ciber seguridad</option>
            <option value="Videojuegos" id="opcionVideojuegos">Videojuegos</option>
            <option value="Educación" id="opcionEducacion">Educación</option>
            <option value="Entretenimiento" id="opcionEntretenimiento">Entretenimiento</option>
            <option value="Medios de comunicación" id="opcionMediosComunicacion">Medios de comunicación</option>
            <option value="Redes sociales" id="opcionRedesSociales">Redes sociales</option>
            <option value="Política" id="opcionPolitica">Política</option>
            <option value="Salud" id="opcionSalud">Salud</option>
            <option value="Nutrición" id="opcionNutricion">Nutrición</option>
            <option value="Deportes" id="opcionDeportes">Deportes</option>
            <option value="Gastronomía" id="opcionGastronomia">Gastronomía</option>
            <option value="Transporte" id="opcionTransporte">Transporte</option>
            <option value="Medio ambiente" id="opcionMedioAmbiente">Medio ambiente</option>
            <option value="Animales" id="opcionAnimales">Animales</option>
        </select>
        
        <input type="file" id="archivoProyecto" name="archivoProyecto" accept=".pdf" required class="input-proyecto"> 
        
        <input type="text" id="integrantesProyecto" name="integrantesProyecto" placeholder="Etiquetar Integrantes" class="input-proyecto"> 
        
        <ul id="resultadosIntegrantes" class="resultados-integrantes"></ul> 
        
        <ul id="integrantesSeleccionados" class="integrantes-seleccionados"></ul> 
        
        <button type="submit" class="boton-enviar" id="solicitarRevisionBtn">Solicitar Revisión</button> 
    </div>
</form>

<div id="mensajeResultado" class="mensajeResultado"></div>

<!-- Modal de Confirmación -->
<div id="confirmacionModal" class="confirmacion-modal" style="display: none;">
    <div class="confirmacion-contenido">
        <p id="mensajeConfirmacion"></p>
        <button id="btnConfirmar" class="btn-confirmar">Sí</button>
        <button id="btnCancelar" class="btn-cancelar">No</button>
    </div>
</div>

<script src="../assets/js/subirProyecto.js"></script>
<script src="../assets/js/traduccion.js"></script>
<script src="../assets/js/darkMode.js"></script>
