<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController{
    //Mostrando las Propiedades
    public static function index(Router $router) {

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET["resultado"] ?? null;

        $router->render('propiedades/admin', [
            "propiedades" => $propiedades,
            "vendedores" => $vendedores,
            "resultado" => $resultado
        ]);
    }

    //Creando una propiedad
    public static function crear(Router $router) {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
             //Creamos una instancia y le asignamos los valores de post
            $propiedad = new Propiedad($_POST['propiedad']);

            //Obtenemos info de la imagen seleccionada
            $imagen = $_FILES['propiedad'];

            //Generamos un nombre a la imagen
            $extension = explode("/", $imagen['type']['imagen']);
            $ultimo = count($extension) -1;
            $nombreImagen = md5(uniqid(rand(), true)) . '.' . $extension[$ultimo];

            //Verificamos que una imagen se haya seleccionado
            if(!$imagen["error"]["imagen"]){
                $image = Image::make($imagen['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            //Validacion
            $errores = $propiedad->validarCampos();
            
            if(empty($errores)){
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                //Guardamos los datos en nuestra BD
                $propiedad->guardar();
            }
        }

        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarId("/admin");
        $propiedad = Propiedad::findById($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            //Capturamos lo que escribe el usuario
            $args = $_POST['propiedad'];
    
            //Sincronizamos el obj de la BD con lo que escribe el usuario
            $propiedad->sincronizarDatos($args);
    
            //Validamos los campos
            $errores = $propiedad->validarCampos();
    
            //Obtenemos info de la imagen seleccionada
            $imagen = $_FILES['propiedad'];
    
            //Generamos un nombre a la imagen
            $extension = explode("/", $imagen['type']['imagen']);
            $ultimo = count($extension) -1;
            $nombreImagen = md5(uniqid(rand(), true)) . '.' . $extension[$ultimo];
    
            //Verificamos que una imagen se haya seleccionado
            if(!$imagen["error"]["imagen"]){
                $image = Image::make($imagen['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
    
            if(empty($errores)){
                //Guardamos la imagen en nuestro servidor
                if($image){
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                //Actualizamos la BD            
                $propiedad->guardar();
            }
        }

        $router->render("propiedades/actualizar", [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $propiedad = Propiedad::findById($id);
                if ($propiedad) {
                    $propiedad->deleteById($id, true);
                }
            }
        }
    }
}

?>