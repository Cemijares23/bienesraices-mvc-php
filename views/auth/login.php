<main class="contenedor seccion contenido-centrado">
    <h2>Iniciar Sesión</h2>

    <?php foreach($errores as $error): ?>
        <div class="alerta error" >
            <?php echo $error; ?>
        </div>

    <?php endforeach; ?>

    <form method="POST" class="formulario">
        <fieldset> <!--se usa para agrupar datos relacionados-->
            <legend>Email y Password</legend> <!--etiqueta para describir el fieldset-->

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Tu Email" id="email"> <!--el placeholder deja un texto pred.-->

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password">
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>