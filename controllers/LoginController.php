<?php

namespace Controller;

use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(Router $router) {
        $errores = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            
            $auth->validar();
            $errores = $auth->getErrores();

            if(empty($errores)) {
                // Verificar si usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    // Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if(!$autenticado) {
                        $errores = Admin::getErrores();
                    } else {
                        // Autenticar usuario si todo es correcto
                        $auth->autenticar();
                    }
                }
            }
        }

        $router->render('/auth/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(Router $router) {
        session_start(); // para acceder a la superglobal $_SESSION

        $_SESSION = []; // dejar $_SESSION vacio (cerrar sesion)

        header('location: /');
    }
}