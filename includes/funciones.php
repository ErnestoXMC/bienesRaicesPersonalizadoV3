<?php

define('TEMPLATES_URL', __DIR__ . "/templates");
define('FUNCIONES_URL', __DIR__ . "funciones.php");
define('CARPETA_IMAGENES', $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function incluirTemplates(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/$nombre.php";
}
function verificarSesion(): void{
    session_start();
    if(!$_SESSION['login']){
        header('Location: /');
    }

}
function cerrarSesionTiempo(){
    define('MAX_TIME', 600);
    session_start();
    if(isset($_SESSION['actividad']) && (time() - $_SESSION['actividad']) > MAX_TIME){
        header('location: /cerrar-sesion.php');
        exit;
    }else{
        $_SESSION['actividad'] = time();
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function sanitizar($campo): string{
    $s = htmlspecialchars($campo);
    return $s;
}

function validarTipo($tipo){
    $tipos = ["propiedad", "vendedor"];

    return in_array($tipo, $tipos);
}
function suprimirTexto($texto, $max, $id = false){
    if(strlen($texto) > $max && $id){
        return substr($texto, 0 , $max) . '...' . '<a href="/propiedad?id=' . $id . '">Leer Más</a>';
    }else if(strlen($texto) > $max && !$id){
        return substr($texto, 0 , $max) . '...';
    }
    else{
        return $texto;
    }
}

//Mostrar Notificaciones
function mostrarNotificacion($codigo){
    $mensaje = '';
    switch($codigo){
        case 1;
            $mensaje = "Creado Correctamente";
            break;
        case 2;
           $mensaje = "Actualizado Correctamente";
           break;
        case 3;
           $mensaje = "Eliminado Correctamente";
           break;
        default;
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarId(string $url){
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header("Location: " . $url);
    }
    return $id;
}

