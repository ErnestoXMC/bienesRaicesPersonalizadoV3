<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienes Raices</title>
        <link rel="stylesheet" href="/build/css/app.css">
    </head>
    <body>
        <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
            <div class="contenedor contenido-header">
                <div class="barra">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="Logo Bienes Raices">
                    </a>
                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="Icono menu">
                    </div>
                    <nav class="navegacion">
                        <?php if(!$inicio){?>
                            <a href="index.php">Inicio</a>
                        <?php }?>
                        <a href="propiedades.php">Propiedades</a>
                        <a href="nosotros.php">Nosotros</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <a href="#" class="dark"><img src="/build/img/dark-mode.svg" alt="Imagen dark-mode"></a>
                        <?php if($auth): ?>
                            <a href="/cerrar-sesion.php">Cerrar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div><!-- .barra -->
                <?php if($inicio){?>
                    <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
                <?php }?>
            </div>
        </header>