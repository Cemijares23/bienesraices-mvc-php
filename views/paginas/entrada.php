<main class="contenedor seccion contenido-centrado">
    <h2><?php echo $entrada->titulo; ?></h2>

    <img src="imagenes/entradas/<?php echo $entrada->imagen; ?>" alt="Imagen de Blog" loading="lazy">

    <div class="resumen-propiedad">
        <p class="info-meta">Escrito el: <span><?php echo $entrada->fecha; ?></span> por: <span><?php echo $entrada->autor; ?></span></p>
        
        <?php echo $entrada->contenido; ?>
    </div>
</main>