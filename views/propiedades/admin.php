<main class="contenedor seccion">
    <h2>Administrador de Bienes Raíces</h2>

    <!-- Muestra alertas -->
    <?php
        if($registro) {
            // intval convierte el numero a entero
            $mensaje = mostrarMensaje(intval($registro));
            if($mensaje) { ?>
                <p class="alerta <?php echo $mensaje['tipo']; ?>"><?php echo s($mensaje['contenido']); ?></p>
            <?php }
        } 
    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor(a)</a>
    <a href="/entradas/crear" class="boton boton-verde">Nueva Entrada</a>

    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- 4) Mostrar los resultados -->
            <?php foreach($propiedades as $propiedad): ;?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td> <img src="../imagenes/propiedades/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                <td>$ <?php echo $propiedad->precio; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- 4) Mostrar los resultados -->
            <?php foreach($vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . ' ' . $vendedor->apellido; ?></td>
                <td> <img src="../imagenes/vendedores/<?php echo $vendedor->imagen; ?>" class="imagen-tabla"></td>
                <td><?php echo $vendedor->telefono; ?></td>
                <td><?php echo $vendedor->email; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar">
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Entradas</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- 4) Mostrar los resultados -->
            <?php foreach($entradas as $entrada): ?>
            <tr>
                <td><?php echo $entrada->id; ?></td>
                <td><?php echo $entrada->titulo; ?></td>
                <td> <img src="../imagenes/entradas/<?php echo $entrada->imagen; ?>" class="imagen-tabla"></td>
                <td><?php echo $entrada->fecha; ?></td>
                <td>
                    <form method="POST" class="w-100" action="/entradas/eliminar">
                        <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                        <input type="hidden" name="tipo" value="entrada">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/entradas/actualizar?id=<?php echo $entrada->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>