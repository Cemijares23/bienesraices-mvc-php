<?php

namespace Model;

class Admin extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->email) {
            self::$errores[] = 'Por favor, ingresa un email';
        }

        if(!$this->password) {
            self::$errores[] = 'Por favor, ingresa una contraseña';
        }
    }

    public function existeUsuario(){
        $query = "SELECT * FROM " . static::$tabla . " WHERE email = '" . self::$db->escape_string($this->email) . "' LIMIT 1";
        $resultado = self::$db->query($query)->fetch_object();

        if(!$resultado) {
            self::$errores[] = 'El usuario no existe';
        }

        return $resultado;
    }

    public function comprobarPassword($resultado) {
        $auth = password_verify($this->password, $resultado->password);
        if(!$auth) {
            self::$errores[] = 'La contraseña es incorrecta';
        }

        return $auth;
    }

    public function autenticar() {
        session_start();

        $_SESSION['email'] = $this->email;
        $_SESSION['login'] = true;

        header('location: /admin');
    }
}
