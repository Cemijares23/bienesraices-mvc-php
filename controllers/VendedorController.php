<?php

namespace Controller;

use MVC\Router;
use Model\Vendedor;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class VendedorController {
    public static function crear(Router $router) {
        $vendedor = new Vendedor(); // instancia vacia de vendedor
        $errores = Vendedor::getErrores(); //obtener errores

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $vendedor = new Vendedor($_POST); // nueva instancia de vendedor
            $nombreImagen = md5(uniqid(rand(), true))  . '.jpg'; // nombre de imagen unico
    
            if($_FILES['imagen']['tmp_name']) { // Verifica que el archivo enviado existe
                
                // Hacer crop y resize de la img
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['imagen']['tmp_name']); // Se le pasa la url de la imagen a read()
                $image->cover(800,600);
                
                
                // Setear img en la instancia de vendedor
                $vendedor->setImage($nombreImagen);
            }
    
            // Valida y devuelve errores
            $vendedor->validar();
            $errores = $vendedor->getErrores();
            
            // Revisar que el array de errores este vacio
            if(empty($errores)) {
    
                /* SUBIDA DE ARCHIVOS */ 
                // Crear carpeta
                if(!is_dir(CARPETA_IMAGENES_VENDEDORES)) {
                    mkdir(CARPETA_IMAGENES_VENDEDORES);
                }
                
                // Guardar img en el servidor
                $image->save(CARPETA_IMAGENES_VENDEDORES . $nombreImagen); // Se le pasa la direccion a guardar
    
                // Guardar en la base de datos
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarID('/admin');
        $vendedor = Vendedor::find($id); 
        $errores = Vendedor::getErrores(); //obtener errores

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST;
    
            $vendedor->sincronizar($args); // asignar nuevos valores de POST
            $nombreImagen = md5(uniqid(rand(), true))  . '.jpg';
            
            if($_FILES['imagen']['tmp_name']) {
    
                // Hacer crop y resize de la img
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['imagen']['tmp_name']); // Se le pasa la url de la imagen a read()
                $image->cover(800,600);
                
                // Setear img en la instancia de propiedad
                $vendedor->setImage($nombreImagen);
            }
    
            $vendedor->validar();
            $errores = $vendedor->getErrores();
    
            // Revisar que el array de errores este vacio
            if(empty($errores)) {
    
                // Guardar img en el servidor
    
                // Como estamos actualizando, es posible que el usuario no ingrese un nuevo archivo, por lo cual habra que mantener el mismo
                // Si el usuario no sube un archivo, no guardamos nada
                if($_FILES['imagen']['tmp_name']) {
                    $image->save(CARPETA_IMAGENES_VENDEDORES . $nombreImagen); // Se le pasa la direccion a guardar
                }
    
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);

            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipo($tipo)) {
                    if($tipo === 'vendedor') {
                        $vendedor = Vendedor::find($id);
                        $totalPropiedades = $vendedor->comprobarPropiedades();
                        if($totalPropiedades > 0) {
                            header('location: /admin?registro=4');
                        } else {
                            $vendedor->eliminar();
                        }
                    }
                }
            }
        }
    }
}