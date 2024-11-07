<?php

function conectarDB() : mysqli{ //indica que tipo de return va a dar(en este caso una conexion mysqli)
    $db = new mysqli(
        $_ENV['DB_HOST'], 
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'], 
        $_ENV['DB_NAME']
    );

    // configuracion de conjunto de caracteres utilizados en la base de datos
    $db->set_charset('utf8');

    if(!$db) {
        echo 'Error al conectar a MySQL: ';
        exit;
    } 
    
    return $db;
}