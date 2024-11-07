<?php


require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Configuracion de variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use Model\ActiveRecord;

// Conexión a la base de datos
$db = conectarDB();

ActiveRecord::setDB($db);