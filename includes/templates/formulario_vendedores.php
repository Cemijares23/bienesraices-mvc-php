            <fieldset>
                <legend>Información General</legend>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" max="20" name="nombre" placeholder="Nombre Vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido Vendedor" min="1" max="9999999999" step="0.01" value="<?php echo s($vendedor->apellido); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
            </fieldset>

            <fieldset>
                <legend>Información de Contacto</legend>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" max="20" name="telefono" placeholder="Teléfono Vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">

                <label for="email">Email:</label>
                <input type="email" id="email" max="20" name="email" placeholder="Email Vendedor(a)" value="<?php echo s($vendedor->email); ?>">
            </fieldset>