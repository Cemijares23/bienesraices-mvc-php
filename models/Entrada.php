<?php

namespace Model;

class Entrada extends ActiveRecord {
    public static $tabla = 'entradas';
    public static $columnasDB = ['id', 'titulo', 'autor', 'fecha', 'descripcion', 'contenido', 'imagen'];
    protected static $rutaImagenes = CARPETA_IMAGENES_ENTRADAS;

    public $id;
    public $titulo;
    public $autor;
    public $fecha;
    public $descripcion;
    public $contenido;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->autor = $args['autor'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->descripcion = $args['descripcion'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar() {
        if(!$this->titulo) {
            self::$errores[] = 'Por favor, añade un título';
        }

        if(!$this->autor) {
            self::$errores[] = 'Ingresa el autor de la entrada de blog';
        }

        if(!$this->descripcion) {
            self::$errores[] = 'Añade una descripcion para la entrada de blog';
        }

        if(!$this->autor) {
            self::$errores[] = 'Escribe el contenido de la entrada de blog';
        }

        if(!$this->imagen) {
            self::$errores[] = 'Por favor, selecciona una imagen';
        }
    }
}