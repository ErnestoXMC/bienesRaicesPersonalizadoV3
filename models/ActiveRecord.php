<?php 

namespace Model;

class ActiveRecord {

    
    protected static $db;
    protected static $errores = [];
    protected static $columnasDB = [];
    protected static $tabla = "";

    
    //*----METODOS STATICOS----
    public static function getErrores(){
        return static::$errores;
    }
    public static function setDB($database){
        self::$db = $database;
    }

    
    public function setImagen($nombreImg) {
        if($this->id){
            $existe = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existe){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
        if($nombreImg){
            $this->imagen = $nombreImg;
        }
    }

    //*--------------METODOS GENERALES--------------*/

    //Metodo para la validacion de atributos
    public function validarCampos(): array{
        static::$errores;
        return static::$errores;
    }

    //? ----CREATE AND UPDATE ----
    public function guardar(){
        if($this->id){
            $this->update();
        }else{
            $this->create();
        }
    }

    //? ----UPDATE----
    public function update(){
        $datosSeguros = $this->sanitizarDatos();

        $arreglo = [];
        foreach($datosSeguros as $key => $value){
            $arreglo[] = "{$key} = '{$value}'";
        }

        $query = "UPDATE " . static::$tabla .  " SET ";
        $query .= join(', ', $arreglo);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";

        $resultado = self::$db->query($query);

        if($resultado){
            header('Location: /admin?resultado=2');
        }

    }

    //? ----CREATE----
    public function create(){
        $datosSeguros = $this->sanitizarDatos();

        $keys = join(", ", array_keys($datosSeguros));
        $values = join("', '", array_values($datosSeguros));

        $query = "INSERT INTO " . static::$tabla ." (";
        $query .= $keys;
        $query .= ") VALUES ('";
        $query .= $values;
        $query .= "' )";
        
        $resultado = self::$db->query($query);

        if($resultado){
            header('Location: /admin?resultado=1');
        }
    }

    //? ----READ----
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        if(static::$tabla === 'propiedades'){
            $query .= " ORDER BY creado DESC"; 
        }

        $resultado = self::consultaDB($query);

        return $resultado;
    }

    //? ----OBTENER UNA CANTIDAD EXACTA DE PROPIEDADES----


    //? -----FIND BY ID----
    public static function findById($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = '" . self::$db->escape_string($id). "' LIMIT 1";

        $resultado = self::consultaDB($query);

        return array_shift($resultado);
    }
    public static function getPropiedades($cantidad) {
        $query = "SELECT * FROM " . static::$tabla .  " LIMIT " . $cantidad;

        $resultado = self::consultaDB($query);

        return $resultado;
    }

    //? ----FIND IMAGE----
    public static function findImage($id){
        $query = "SELECT imagen FROM propiedades WHERE id = {$id}";

        $resultado = self::consultaDB($query);

        return $resultado[0];
    }
    //? ----DELETE----
    public function deleteById($id, $eliminarImagen = false) {
        if($eliminarImagen){
            $this->borrarImagenEliminar($this->findImage($id)->imagen ?? null);
        }
        $query = "DELETE FROM " . static::$tabla . " WHERE id = {$id}";

        $resultado = self::$db->query($query);

        if($resultado){
            header('location: /admin');
        }
    }

    //*----METODOS COMPLEMENTARIOS----
    public function borrarImagenEliminar($imagen){
        $existeImg = file_exists(CARPETA_IMAGENES . $imagen);
        if($existeImg){
            unlink(CARPETA_IMAGENES . $imagen);
        }
    }
    public static function consultaDB($query){
        //consultar a la BD
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::cambiarArregloObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //retornar el arreglo de objetos
        return $array;
    }
    public static function cambiarArregloObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
    public function sanitizarDatos(){
        $atributos = $this->iterarCampos();
        $sanitizado = [];
        
        foreach($atributos as $key => $value){
            if($key === 'id') continue;
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    public function iterarCampos() {
        $atributos = [];

        foreach(static::$columnasDB as $campo){
            if($campo === 'id') continue;
            $atributos[$campo] = $this->$campo;
        }
        return $atributos;
    }
    //Sincronizar datos de nuestro objeto con lo que escribe el usuario
    public function sincronizarDatos($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }



}



?>