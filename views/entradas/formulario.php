    <fieldset>
        <legend>Información General</legend>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" max="60" name="titulo" placeholder="Título de Entrada" value="<?php echo s($entrada->titulo); ?>">

        <label for="autor">Autor:</label>
        <input type="text" id="autor" max="60" name="autor" placeholder="Autor de la Entrada" value="<?php echo s($entrada->autor); ?>">

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" max="255" name="descripcion" placeholder="Descripción breve de la entrada de blog"><?php echo s($entrada->descripcion); ?></textarea>

        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" placeholder="Utiliza <p></p> para cada párrafo"><?php echo s($entrada->contenido); ?></textarea>

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

        <?php if($entrada->imagen): ?>
            <img src="/imagenes/entradas/<?php echo $entrada->imagen ?>" class="image-form">
        <?php endif; ?>
    </fieldset>

