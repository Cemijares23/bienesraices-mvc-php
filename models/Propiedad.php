<?php

namespace Model;

class Propiedad extends ActiveRecord {
    
    protected static $tabla = 'propiedades';
    protected static $rutaImagenes = CARPETA_IMAGENES_PROPIEDADES;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedor_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedor_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedor_id = $args['vendedor_id'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = 'Por favor, añade un título para tu anuncio.';
        } 
        if (strlen($this->titulo) > 25){
            self::$errores[] = 'El título es muy extenso.';
        }
        

        if(!$this->precio) {
            self::$errores[] = 'Por favor, especifica el precio de tu propiedad.';
        }

        
        if(!$this->descripcion) {
            self::$errores[] = 'Añade una descripción detallada de la propiedad.';
        } 

        if(strlen($this->descripcion) < 45 ) {
            self::$errores[] = 'La descripción debe contener un mínimo de 45 caracteres';
        }

        if(!$this->habitaciones) {
            self::$errores[] = 'Indica cuántas habitaciones tiene la propiedad.';
        }
        
        if(!$this->wc) {
            self::$errores[] = 'Especifica la cantidad de baños disponibles.';
        }
        
        if(!$this->estacionamiento) {
            self::$errores[] = 'Indica la cantidad de puestos de estacionamiento disponibles.';
        }
        
        if(!$this->vendedor_id) {
            self::$errores[] = 'Selecciona un vendedor';
        }

        if(!$this->imagen) {
            self::$errores[] = 'Por favor, selecciona una imagen';
        }
    }
}