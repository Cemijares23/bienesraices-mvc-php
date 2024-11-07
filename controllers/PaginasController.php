<?php

namespace Controller;

use MVC\Router;
use Model\Entrada;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;


class PaginasController {
    public static function index(Router $router) {

        $propiedades = Propiedad::get(3);
        $entradas = Entrada::get(2);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'entradas' => $entradas,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {

        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
        $id = validarID('/propiedades');
        $propiedad = Propiedad::find($id);

        // redirecciona si no existe ese registro
        if(!$propiedad) {
            header('location: /propiedades');
        }
        
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $entradas = Entrada::all();

        $router->render('paginas/blog', [
            'entradas' => $entradas
        ]);
    }

    public static function entrada(Router $router) {
        $id = validarID('/blog');
        $entrada = Entrada::find($id);

        if(!$entrada) {
            header('location: /blog');
        }

        $router->render('paginas/entrada', [
            'entrada' => $entrada
        ]);
    }

    public static function contacto(Router $router) {
        $mensaje = null;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formulario =  $_POST;

            // Crear nueva instancia de PHP Mailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];

            // Destinatarios (nombre es opcional)
            $mail->setFrom('persona@gmail.com', $formulario['nombre']); // origen
            $mail->addAddress('admin@bienesraices.com', 'Chris'); // destino 

            // Definir contenido del email
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Hola, tienes un nuevo mensaje!';

            $contenido = '<html>';
            $contenido  .= '<p> Nuevo mensaje desde <b>BienesRaices.com!</b> </p>';
            $contenido .= '<p>Cliente: ' . $formulario['nombre'] . ' ' . $formulario['apellido'] . ' </p>';
            $contenido .= '<p>Mensaje: ' . $formulario['mensaje'] . ' </p>';
            $contenido .= '<p>Opciones: ' . $formulario['opciones'] . ' </p>';
            $contenido .= '<p>Presupuesto: $' . $formulario['presupuesto'] . ' </p>';
            $contenido .= '<p>Forma de contacto: ' . $formulario['contacto'] . ' </p>';

            // Mostrar mensaje condicional segun opciones del formulario
            if($formulario['contacto'] === 'telefono') {
                $contenido .= '<p>Teléfono: ' . $formulario['telefono'] . ' </p>';
                $contenido .= '<p>Fecha de llamada: ' . $formulario['fecha'] . ' </p>';
                $contenido .= '<p>Hora de llamada: ' . $formulario['hora'] . ' </p>';
            } else {
                $contenido .= '<p>Email: ' . $formulario['email'] . ' </p>';
            }

            $contenido .= '</html>';


            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';
            $enviado = $mail->send();
            // debugg($enviado); Invalid address: (From): persona@gmail

            if($enviado) {
                $mensaje = 'Mensaje enviado correctamente';
            } else {
                $mensaje = 'El mensaje no pudo ser enviado: ' . $mail->ErrorInfo;
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}