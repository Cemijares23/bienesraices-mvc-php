<main class="contenedor seccion contenido-centrado">

    <?php if($mensaje): ?>
        <p class="alerta exito"> <?php echo $mensaje; ?> </p>
    <?php endif; ?>

    <h1>Contacto</h1>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llene el formulario de contacto</h2>

    <form class="formulario" method="POST">
        <fieldset> <!--se usa para agrupar datos relacionados-->
            <legend>Información Personal</legend> <!--etiqueta para describir el fieldset-->

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre" required> <!--el placeholder deja un texto pred.-->

            <label for="apellido">Apellido</label>
            <input type="text" placeholder="Tu Apellido" id="apellido" name="apellido" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" placeholder="Escribe el motivo de tu contacto" name="mensaje" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Sobre la Propiedad</legend>

            <label for="opciones">Compra o Vende</label>
            <select id="opciones" name="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option> 
                <option value="Vende">Vende</option>
                <!--el value es lo que se envia al servidor-->
            </select>

            <label for="presupuesto">Precio/Presupuesto</label>
            <input type="num" placeholder="Tu presupuesto" id="presupuesto" name="presupuesto" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>¿Cómo desea ser contactado?</p>

            <div class="opciones-contacto">
                <div class="opciones-radio">
                    <label for="contacto-telefono">Teléfono</label>
                    <input type="radio" value="telefono" id="contacto-telefono" name="contacto" required>
                </div>

                <div class="opciones-radio">
                    <label for="contacto-email">E-mail</label>
                    <input type="radio" value="email" id="contacto-email" name="contacto" required>
                </div>
                <!--el name agrupa a los radio buttons haciendo que solo se pueda seleccionar uno-->
            </div>

            <div id="camposContacto"></div>

            </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>