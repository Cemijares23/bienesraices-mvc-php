<?php

namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $rutaImagenes = CARPETA_IMAGENES_VENDEDORES;
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'imagen', 'telefono', 'email'];

    public $id;
    public $nombre;
    public $apellido;
    public $imagen;
    public $telefono;
    public $email;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
    }

    public function comprobarPropiedades() {
        $query = "SELECT COUNT(*) FROM propiedades WHERE vendedor_id = " . self::$db->escape_string($this->id);
        
        $resultado = self::$db->query($query);
        $count = $resultado->fetch_assoc();
        
        return $count['COUNT(*)'];
    }

    public function validar() {

        if(!$this->nombre) {
            self::$errores[] = 'Ingresa el nombre de vendedor';
        } 

        if(!$this->apellido) {
            self::$errores[] = 'Ingresa el apellido de vendedor';
        } 

        if(!$this->imagen) {
            self::$errores[] = 'Por favor, selecciona una imagen';
        } 

        if(!$this->telefono) {
            self::$errores[] = 'Ingresa un número de teléfono';

        } else if (!preg_match("/[0-9]{11}/", $this->telefono)){
            self::$errores[] = 'Verifica que el número de teléfono es válido';
        }

        if(!$this->email) {
            self::$errores[] = 'Ingresa un correo electrónico válido';
        } 
    }
}