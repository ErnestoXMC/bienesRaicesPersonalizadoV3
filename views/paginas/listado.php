<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad){ ?>
        <div class="anuncio">
                <img src="imagenes/<?php echo $propiedad->imagen;?>" alt="anuncio" loading="lazy"><!--Imagen-->

            <div class="contenido-anuncio">
                <h3><?php echo suprimirTexto($propiedad->titulo, 20);?></h3>
                <p><?php echo suprimirTexto($propiedad->descripcion, 55, $propiedad->id);?></p>
                <p class="precio">$<?php echo $propiedad->precio;?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <p><?php echo $propiedad->wc ;?></p>
                        <img src="build/img/icono_wc.svg" alt="Imagen wc" loading="lazy">
                    </li>
                    <li>
                        <p><?php echo $propiedad->estacionamiento;?></p>
                        <img src="build/img/icono_estacionamiento.svg" alt="Imagen esta" loading="lazy">
                    </li>
                    <li>
                        <p><?php echo $propiedad->habitaciones;?></p>
                        <img src="build/img/icono_dormitorio.svg" alt="Imagen dormi" loading="lazy">
                    </li>
                </ul>
                <a href="propiedad?id=<?php echo $propiedad->id;?>" class="btn-marron-block">Ver Propiedad</a>
            </div><!--Informacion-->
        </div><!--Anuncio-->
    <?php }?>
</div><!--.contenedor-anuncios-->

