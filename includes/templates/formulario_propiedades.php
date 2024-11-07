            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" max="20" name="titulo" placeholder="Título de Propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de Propiedad" min="1" max="9999999999" step="0.01" value="<?php echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <?php if($propiedad->imagen): ?>
                    <img src="/bienesraices/imagenes/<?php echo $propiedad->imagen ?>" class="image-form">
                <?php endif; ?>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" max="75" name="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <label for="vendedor">Vendedor</label>
                <select name="vendedor_id" id="vendedor">
                    <option selected value="">-- Seleccione --</option>
                    <?php foreach($vendedores as $vendedor): ?>
                        <option
                            <?php echo $vendedor->id === $propiedad->vendedor_id ? 'selected' : ''; ?>
                            value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </fieldset>