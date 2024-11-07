<?php 

namespace Controller;

use MVC\Router;
use Model\Entrada;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EntradasController {
    public static function crear(Router $router) {
        $entrada = new Entrada(); // instancia vacia
        $errores = Entrada::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entrada = new Entrada($_POST); // nueva instancia
            $nombreImagen = md5(uniqid(rand(), true))  . '.jpg'; // generar nombre de imagen

            if($_FILES['imagen']['tmp_name']) { // Verifica que el archivo enviado existe
                
                // Hacer crop y resize de la img
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['imagen']['tmp_name']); // Se le pasa la url de la imagen a read()
                $image->cover(800,600);
                
                // Setear img en la instancia de propiedad
                $entrada->setImage($nombreImagen);
            }

            // Valida y devuelve errores
            $entrada->validar();
            $errores = $entrada->getErrores();
        
            // Revisar que el array de errores este vacio
            if(empty($errores)) {

                /* SUBIDA DE ARCHIVOS */ 
                // Crear carpeta
                if(!is_dir(CARPETA_IMAGENES_ENTRADAS)) {
                    mkdir(CARPETA_IMAGENES_ENTRADAS);
                }
                
                // Guardar img en el servidor
                $image->save(CARPETA_IMAGENES_ENTRADAS . $nombreImagen); // Se le pasa la direccion a guardar

                // Guardar en la base de datos
                $entrada->guardar();
            }

        }

        $router->render('entradas/crear', [
            'entrada' => $entrada,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarID('/admin');
        $entrada = Entrada::find($id);
        $errores = Entrada::getErrores();

        if(!$entrada) {
            header('location: /admin');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST;
    
            // asigna los nuevos valores de post al objeto
            $entrada->sincronizar($args);
            $nombreImagen = md5(uniqid(rand(), true))  . '.jpg';
            
            if($_FILES['imagen']['tmp_name']) {

                // Hacer crop y resize de la img
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['imagen']['tmp_name']); // Se le pasa la url de la imagen a read()
                $image->cover(800,600);
                
                // Setear img en la instancia de propiedad
                $entrada->setImage($nombreImagen);
            }
    
            $entrada->validar();
            $errores = $entrada->getErrores();
    
            if(empty($errores)) {
                // Guardar img en el servidor
    
                // Como estamos actualizando, es posible que el usuario no ingrese un nuevo archivo, por lo cual habra que mantener el mismo
                // Si el usuario no sube un archivo, no guardamos nada
                if($_FILES['imagen']['tmp_name']) {
                    $image->save(CARPETA_IMAGENES_ENTRADAS . $nombreImagen); // Se le pasa la direccion a guardar
                }
    
                $entrada->guardar();
            }
        }

        $router->render('entradas/actualizar', [
            'entrada' => $entrada,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    
            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipo($tipo)) {
                    if($tipo === 'entrada') {
                        $propiedad = Entrada::find($id);
                        $propiedad->eliminar();
                    } 
                }
            }
        }
    }
}