<?php

    if(!isset($_SESSION)) {
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>
    <!-- isset evalua si la variable existe primero y arroja un true o false para luego evaluar la condicion, esto evita el error por variable no definida -->
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
                </a>

                <div class="mobile-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="Mobile Menu">
                </div>

                <div class="derecha">
                    <img src="/bienesraices/build/img/dark-mode.svg" class="dark-mode-btn">
                    <div class="navegacion">
                        <a href="/bienesraices/nosotros.php">Nosotros</a>
                        <a href="/bienesraices/anuncios.php">Anuncios</a>
                        <a href="/bienesraices/blog.php">Blog</a>
                        <a href="/bienesraices/contacto.php">Contacto</a>

                        <?php if($auth): ?>
                            <a href="/bienesraices/login/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div> <!--.barra-->
                        
            <?php if($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>