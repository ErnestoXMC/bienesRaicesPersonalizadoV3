<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    
    public static function index(Router $router){
        $propiedades = Propiedad::getPropiedades(3);

        $router->render("paginas/index", [
            "propiedades" => $propiedades,
            "inicio" => true
        ]);
    }

    public static function nosotros(Router $router){
        $router->render("paginas/nosotros");
    }
    
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();

        $router->render("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarId("/");
        if($id){
            $propiedad = Propiedad::findById($id);
            $router->render("paginas/propiedad",[
                "propiedad" => $propiedad
            ]);
        }
    }

    public static function blog(Router $router){
        $router->render("paginas/blog");

    }

    public static function entrada(Router $router){
        $router->render("paginas/entrada");
    }

    public static function contacto(Router $router){
        $mensaje = null;
        $resultado = null;

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $respuestas = $_POST["contacto"];

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->Port = $_ENV['EMAIL_PORT'];

            $mail->setFrom("admin@bienesraices.com");//quien envia el mensaje
            $mail->addAddress("ernestopmc11@gmail.com", "BienesRaices.com");//Para quien le voy a enviar y desde donde viene
            $mail->Subject = "Tienes un nuevo mensaje";//Asunto del correo

            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            $contenido = "<html>";
            $contenido.= "<p>Enviado desde BienesRaices.com</p>";
            $contenido .= "<p>Nombre: " . $respuestas["nombre"] . "</p>";
            if($respuestas["contacto"] === "telefono"){
                $contenido .= "<p>El Cliente decidio ser contactado por Teléfono</p>";
                $contenido .= "<p>Teléfono: " . $respuestas["telefono"] . "</p>";
                $contenido .= "<p>Fecha: " . $respuestas["fecha"] . "</p>";
                $contenido .= "<p>Hora: " . $respuestas["hora"] . "</p>";
            }else{
                $contenido .= "<p>El Cliente decidio ser contactado por Email</p>";
                $contenido .= "<p>Email: " . $respuestas["email"] . "</p>";
            }
            $contenido .= "<p>Mensaje: " . $respuestas["mensaje"] . "</p>";
            $contenido .= "<p>Vende / Compra: " . $respuestas["tipo"] . "</p>";
            $contenido .= "<p>Precio / Presupuesto: $" . $respuestas["precio"] . "</p>";
            $contenido .= "</html>";
            
            $mail->Body = $contenido;
            $mail->AltBody = "Esto es un texto alternativo";

            if($mail->send()){
                $mensaje = "Mensaje Enviado Correctamente";
                $resultado = 1;
            }else{
                $mensaje = "El Mensaje NO se pudo Enviar";
                $resultado = 2;
            }
        }
        $router->render('paginas/contacto', [
            "mensaje" => $mensaje,
            "resultado" => $resultado
        ]);
    }

}
?>