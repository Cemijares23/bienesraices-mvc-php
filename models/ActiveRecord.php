<?php

namespace Model;

class ActiveRecord {

    // Conexion a la base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    protected static $rutaImagenes = '';

    //Errores 
    protected static $errores = [];


    public static function setDB($database) {
        self::$db = $database;
    }


    public function guardar() {

        if($this->id) {
            return $this->actualizar();
        } else {
            return $this->crear();
        }
    }

    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();
        $columnas = join(', ' , array_keys($atributos));
        $filas = join("', '" , array_values($atributos));
        // debugg($columnas);
        // debugg($filas);

        // Escribir la consulta o query
        $query = "INSERT INTO " . static::$tabla . " ($columnas) VALUES ('$filas');";

        // Ejecutar el query
        $resultado = self::$db->query($query);
        if($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?registro=1');
        }
    }

    public function actualizar() {
        $atributos = $this->sanitizarDatos();

        $valoresSQL = [];
        foreach($atributos as $key => $value) {
            $valoresSQL[] = "$key = '$value' ";
        }

        $stringSQL = join(", ", $valoresSQL);
        $query = "UPDATE " . static::$tabla . " SET " . $stringSQL . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1; "; 
        
        $resultado = self::$db->query($query);
        if($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?registro=2');
        }
    }

    // Eliminar el registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        // debugg($query);
        $resultado = self::$db->query($query);
        
        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?registro=3');
        }
    }

    
    public function sanitizarDatos() {
        $atributos = $this->mapearAtributos();
        $sanitizado = [];

        // sanitiza el array asociativo
        foreach($atributos as $key=>$value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    public function mapearAtributos() {
        // convierte los datos en un array asociativo
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue; // el continue omite el codigo siguiente 
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }


    // Guardar referencia de imagen
    public function setImage($imagen) {
        // Eliminar la imagen previa si existe

        // Comprueba si id tiene valor (true = estamos actualizando; false = estamos creando)
        if($this->id) {
            $this->borrarImagen();
        }
        // Asignar el nuevo nombre de la imagen al atributo en el objeto
        $this->imagen = $imagen;
        
    }

    public function borrarImagen() {
        // Comprueba que existe el archivo ANTERIOR y lo borra
        if(file_exists($this->rutaImagenes . $this->imagen)) {
            unlink($this->rutaImagenes . $this->imagen);
        }
    }

    public static function getErrores() {
        return static::$errores;
    }
    
    public function validar() {
        static::$errores = [];
    }

    // Lista todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla . ";";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtener registros segun un limite
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Lista un registro segun id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($id);

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); // retorna la primera posicion de un arreglo
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        
        // Liberar la memoria
        $resultado->free();
        
        
        // Retornar los resultados
        return $array; // arreglo ya con objetos
        
    }
    
    protected static function crearObjeto($registro) {
        $objeto = new static;
        
        foreach($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }

    // Sincroniza el objeto en memoria con el POST
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

}