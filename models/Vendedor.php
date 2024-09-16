<?php 

namespace Model;

class Vendedor extends ActiveRecord{

    protected static $tabla = "vendedores";
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    //Metodo para la validacion de atributos
    public function validarCampos(): array{
        if(!$this->nombre){
            self::$errores[] = "El nombre es obligatorio";
        }
        if($this->nombre && strlen($this->nombre) >= 45){
            self::$errores[] = "El nombre es demasiado largo";
        }
        if(!$this->apellido){
            self::$errores[] = "El apellido es obligatorio";
        }
        if($this->apellido && strlen($this->apellido) >= 45){
            self::$errores[] = "El apellido es demasiado largo";
        }
        if(!$this->telefono){
            self::$errores[] = "El telefono es obligatorio";
        }
        if(!preg_match('/[0-9]{9}/', $this->telefono)  && $this->telefono){
            self::$errores[] = "Formato del telefono no válido";
        }
        $telefonoCadena = strval($this->telefono);
        $longitudTelefono = strlen($telefonoCadena);
        if($longitudTelefono > 9 && $this->telefono){
            self::$errores[] = "El telefono no debe superar los 9 digitos";
        }

        return self::$errores;
    }
}

?>