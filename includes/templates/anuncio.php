<?php

    use App\Propiedad;

    // Validar la URL por ID válido (numero entero)
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // En caso que no sea un numero o sea null retorna false y redirecciona
    if (!$id) {
        header ('Location: /bienesraices/index.php');
    }

    $propiedad = Propiedad::find($id);
?>

        <h2><?php echo $propiedad->titulo; ?></h2>
        
        <img src="imagenes/propiedades/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad" loading="lazy">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad->precio; ?></p>

            <ul class="iconos-anuncio">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p><?php echo $propiedad->wc; ?></p>
                </li> <!--.icono-->

                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li> <!--.icono-->

                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li> <!--.icono-->
            </ul>

            <p><?php echo $propiedad->descripcion; ?></p>
        </div>
