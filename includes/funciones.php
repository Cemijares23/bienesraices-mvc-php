<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES_PROPIEDADES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/propiedades/');
define('CARPETA_IMAGENES_VENDEDORES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/vendedores/');
define('CARPETA_IMAGENES_ENTRADAS', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/entradas/');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}

function userAuth () {
    session_start();
    
    $auth = $_SESSION['login'];
    
    if (!$auth) {
        header('location: /bienesraices/index.php');
    } 
}

function debugg($variable) {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

// Escapa el HTML
function s($html) {
    $s = htmlspecialchars($html);
    
    return $s;
}

// Validar tipo de tabla a eliminar
function validarTipo($tipo) {
    $tipos = ['propiedad', 'vendedor', 'entrada'];

    return in_array($tipo, $tipos);
}

function mostrarMensaje($registro) {
    $mensaje = [];

    switch($registro) {
        case 1:
            $mensaje['contenido'] = 'Registro Creado Correctamente!';
            $mensaje['tipo'] = 'exito';
            break;
        case 2:
            $mensaje['contenido'] = 'Registro Actualizado Correctamente!';
            $mensaje['tipo'] = 'exito';
            break;
        case 3:
            $mensaje['contenido'] = 'Registro Eliminado Correctamente!';
            $mensaje['tipo'] = 'exito';
            break;
        case 4:
            $mensaje['contenido'] = 'El vendedor tiene propiedades asociadas';
            $mensaje['tipo'] = 'error';
            break;
        default: 
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarID(string $url) {

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    // En caso que no sea un numero retorna false y redirecciona
    if (!$id) {
        header ("Location: $url");
    }

    return $id;
}
