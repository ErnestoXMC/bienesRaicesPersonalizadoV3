<?php 

namespace Model;

class Propiedad extends ActiveRecord{

    protected static $tabla = "propiedades";
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

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
        $this->vendedorId = $args['vendedorId'] ?? '';
    }


    //*--------------METODOS GENERALES--------------*/

    //Metodo para la validacion de atributos
    public function validarCampos(): array{
        if(!$this->titulo){
            self::$errores[] = "El titulo es obligatorio";
        }
        if($this->titulo && strlen($this->titulo) >= 45){
            self::$errores[] = "El titulo es demasiado largo";
        }
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        if(!$this->descripcion){
            self::$errores[] = "La descripcion es obligatoria";
        }
        if(strlen($this->descripcion) < 50 && $this->descripcion){
            self::$errores[] = "La descripcion debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "Ingresa un numero de habitación";
        }
        if(!$this->wc){
            self::$errores[] = "Ingresa un numero de baños";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "Ingresa la cantidad de estacionamientos";
        }
        if(!$this->vendedorId){
            self::$errores[] = "Por favor, selecciona un vendedor";
        }
        if(!$this->imagen){
            self::$errores[] = "Por favor, Seleccione una imagen";
        }

        return self::$errores;
    }


}
?>