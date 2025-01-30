<main class="contenedor seccion">
    <h2>Más Sobre Nosotros</h2>

    <?php include 'iconos.php'; ?>
</main>

<section class="seccion contenedor">
    <h2>Casas y Departamentos en Venta</h2>
    
    <?php
        include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="seccion-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contáctanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

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
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote> <!--etiqueta para testimoniales-->
                    El servicio fue excepcional, muy atentos a nuestras necesidades. La casa era maravillosa y hizo que nuestras vacaciones fueran inolvidables
            </blockquote>
            <p>- Laura García</p>
        </div>
    </section>
</div>