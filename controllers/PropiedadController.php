<?php

namespace Controller;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Entrada;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController {
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $entradas = Entrada::all();
        $registro = $_GET['registro'] ?? null;

        $router->render('propiedades/admin', [
            // pasaremos como array asociativo tantos datos como queramos
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'entradas' => $entradas,
            'registro' => $registro
        ]);
    }

    public static function crear(Router $router) {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $propiedad = new Propiedad($_POST); // Crea nueva instancia del objeto
            $nombreImagen = md5(uniqid(rand(), true))  . '.jpg'; // Generar un nombre unico de la imagen (con la extension)
        
            if($_FILES['imagen']['tmp_name']) { // Verifica que el archivo enviado existe
                
                // Hacer crop y resize de la img
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['imagen']['tmp_name']); // Se le pasa la url de la imagen a read()
                $image->cover(800,600);
                
                // Setear img en la instancia de propiedad
                $propiedad->setImage($nombreImagen);
            }

            // Valida y devuelve errores
            $propiedad->validar();
            $errores = $propiedad->getErrores();
        
            // Revisar que el array de errores este vacio
            if(empty($errores)) {

                /* SUBIDA DE ARCHIVOS */ 
                // Crear carpeta
                if(!is_dir(CARPETA_IMAGENES_PROPIEDADES)) {
                    mkdir(CARPETA_IMAGENES_PROPIEDADES);
                }
                
                // Guardar img en el servidor
                $image->save(CARPETA_IMAGENES_PROPIEDADES . $nombreImagen); // Se le pasa la direccion a guardar

                // Guardar en la base de datos
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarID('/admin');
        $propiedad = Propiedad::find($id); //obtener propiedad

        // redirecciona si no existe ese registro
        if(!$propiedad) {
            header('location: /admin');
        }

        $vendedores = Vendedor::all(); // obtener vendedores
        $errores = Propiedad::getErrores(); // obtener errores

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST;
    
            // asigna los nuevos valores de post al objeto
            $propiedad->sincronizar($args);
            $nombreImagen = md5(uniqid(rand(), true))  . '.jpg';
            
            if($_FILES['imagen']['tmp_name']) {

                // Hacer crop y resize de la img
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($_FILES['imagen']['tmp_name']); // Se le pasa la url de la imagen a read()
                $image->cover(800,600);
                
                // Setear img en la instancia de propiedad
                $propiedad->setImage($nombreImagen);
            }
    
            $propiedad->validar();
            $errores = $propiedad->getErrores();
    
            if(empty($errores)) {
                // Guardar img en el servidor
    
                // Como estamos actualizando, es posible que el usuario no ingrese un nuevo archivo, por lo cual habra que mantener el mismo
                // Si el usuario no sube un archivo, no guardamos nada
                if($_FILES['imagen']['tmp_name']) {
                    $image->save(CARPETA_IMAGENES_PROPIEDADES . $nombreImagen); // Se le pasa la direccion a guardar
                }
    
                $propiedad->guardar();
            }
        }
        
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    
            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipo($tipo)) {
                    if($tipo === 'propiedad') {
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                    } 
                }
            }
        }
    }
}