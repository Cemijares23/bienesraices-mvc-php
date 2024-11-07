<main class="contenedor seccion">
    <h2>Actualizar Vendedores</h2>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <!-- por esto es necesario declarar errores = []; -->
    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <!-- Para la correcta comprobacion del $_GET no hay que colocar el action. Asumo que la redireccion del action reescribe el contenido de $_GET, borrando el 'id' que este contiene -->
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php require __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>
</main>