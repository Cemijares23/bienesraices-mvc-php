<?php
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\PropiedadController;
use Controller\VendedorController;
use Controller\PaginasController;
use Controller\EntradasController;
use Controller\LoginController;

$router = new Router;

// 1) Primero se asignan todas las rutas con sus respectivas funciones

// RUTAS PRIVADAS
// Rutas admin propiedades
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

// Rutas admin vendedores
$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

// Rutas admin entradas blog
$router->get('/entradas/crear', [EntradasController::class, 'crear']);
$router->post('/entradas/crear', [EntradasController::class, 'crear']);
$router->get('/entradas/actualizar', [EntradasController::class, 'actualizar']);
$router->post('/entradas/actualizar', [EntradasController::class, 'actualizar']);
$router->post('/entradas/eliminar', [EntradasController::class, 'eliminar']);

// RUTAS PUBLICAS
// Login y autenticacion
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Rutas pagina principal
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

// 2) Luego se comprueba la ruta actual
$router->comprobarRutas();