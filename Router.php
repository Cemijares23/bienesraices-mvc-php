<?php

namespace MVC;

use Intervention\Image\Colors\Hsv\Channels\Value;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }
    
    public function comprobarRutas() {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        $rutasProtegidas = [
            '/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
            '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar',
            '/entradas/crear', '/entradas/actualizar', '/entradas/eliminar'
        ];

        // En caso de estar en la pagina principal agrega un /
        // $urlActual = $_SERVER['PATH_INFO'] ?? '/'; 
        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];
        
        if($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        if(in_array($urlActual, $rutasProtegidas) && !$auth) {
            header('location: /');
        }

        if($fn) { // La url existe y tiene una funcion asociada
            
            // Llamar las funciones de forma dinamica y pasarles las rutas como parametros
            call_user_func($fn, $this);

        } else {
            echo 'Página no encontrada';
        }
        
    }

    // Mandar a llamar las vistas
    public function render($view, $datos = []) {

        // generador de variables
        foreach($datos as $key => $value) {
            $$key = $value; // $$: variable de variable
        }

        ob_start(); // Activa el almacenamiento en búfer de la salida
        // Mientras dicho almacenamiento esté activo, no se enviará ninguna salida desde el script (aparte de cabeceras); en su lugar la salida se almacenará en un búfer interno.

        include __DIR__ . "/views/$view.php"; // las comillas dobles ahorran concatenar

        $contenido = ob_get_clean(); // Devuelve el contenido del búfer de salida y finaliza el almacenamiento en el mismo. 

        include __DIR__ . "/views/layout.php";
    }
}