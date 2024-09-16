<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
    if(!isset($inicio)){
        $inicio = false;
    }
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
                            <a href="/">Inicio</a>
                        <?php }?>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/nosotros">Nosotros</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <a href="#" class="dark"><img src="/build/img/dark-mode.svg" alt="Imagen dark-mode"></a>
                        <!-- <a href="#"></a> -->
                        <?php if($auth): ?>
                            <a href="/logout">Cerrar Sesion</a>
                        <?php endif; ?>
                    </nav>
                </div><!-- .barra -->
                <?php if($inicio){?>
                    <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
                <?php }?>
            </div>
        </header>

        <?php echo $contenido; ?>

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion nav-footer">
                    <?php if(!$inicio){?>
                        <a href="/">Inicio</a>
                    <?php }?>
                    <a href="/propiedades">Propiedades</a>
                    <a href="/nosotros">Nosotros</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
            </div>
            <p class="copyright">Todos los derechos reservados <?php echo date('Y');?> &copy;</p>
        </footer><!--Footer-->
            
    <script src="/build/js/bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    </body>
</html>