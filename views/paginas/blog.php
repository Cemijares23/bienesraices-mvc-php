<main class="contenedor seccion contenido-centrado">
    <h2>Nuestro Blog</h2>

    <?php foreach($entradas as $entrada): ?>
        <article class="entrada-blog">
            <div class="imagen-blog">
                <img src="imagenes/entradas/<?php echo $entrada->imagen; ?>" alt="Imagen de Blog" loading="lazy">
            </div>

            <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $entrada->id; ?>">
                    <h4><?php echo $entrada->titulo; ?></h4>
                    <p class="info-meta">Escrito el: <span><?php echo $entrada->fecha; ?></span> por: <span><?php echo $entrada->autor; ?></span></p> <!--info meta de cuando se escribio-->
                    <p><?php echo $entrada->descripcion; ?></p>
                </a>
            </div>
        </article> <!--.entrada-blog-->
    <?php endforeach; ?>

</main>