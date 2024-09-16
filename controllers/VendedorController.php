<?php 

namespace Controllers;

use Exception;
use Model\Vendedor;
use MVC\Router;

class VendedorController{

    public static function crear(Router $router){
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $vendedor = new Vendedor($_POST['vendedor']);
            //Validacion
            $errores = $vendedor->validarCampos();
            if(empty($errores)){
               $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarId('/admin');

        $vendedor = Vendedor::findById($id);
        $errores = Vendedor::getErrores();

        if($_SERVER["REQUEST_METHOD"] === "POST"){   

            $args = $_POST['vendedor'];
            $vendedor->sincronizarDatos($args);
            $errores = $vendedor->validarCampos();
     
            if(empty($errores)){
             $vendedor->guardar();
            }
         }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    
    }

    public static function eliminar(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try{
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
    
                if ($id) {
                    $vendedor = Vendedor::findById($id);
                    if ($vendedor) {
                        $vendedor->deleteById($id);
                    }
                }
            }
            catch(Exception $error){
                $mensaje = $error->getMessage();
                $router->render("vendedores/error", [
                    "mensaje" => $mensaje
                ]);
            }
           
        }
    }




}
?>