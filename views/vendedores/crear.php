<main class="contenedor seccion">
        <h2>Registrar Vendedores</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- por esto es necesario declarar errores = []; -->
        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php require __DIR__ . '/formulario.php'; ?>

            <input type="submit" value="Registrar" class="boton boton-verde">
        </form>
    </main>