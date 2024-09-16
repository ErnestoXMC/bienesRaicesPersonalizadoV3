<!--Header-->
<main class="contenedor">
    <h1 class="titulo-regular">Contáctanos</h1>
    <?php if($mensaje){?>
        <?php if($resultado === 1){?>
                <p class="alerta exito"><?php echo $mensaje; ?></p>
            <?php }else if($resultado === 2) {?> 
                <p class="alerta error"><?php echo $mensaje; ?></p>   
            <?php }?> 
    <?php }?>
            
            

        <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>

    <h2 class="titulo-regular">Formulario de Contacto</h2>
    <form class="formulario" method="post" action="/contacto">
        <fieldset>
            <legend>Información Personal</legend>
            <div class="campo_padre">
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Ingresa Tus Nombres Completos" id="nombre" name="contacto[nombre]">
            </div>
           

            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <div class="campo_padre">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" id="contactar-telefono" value="telefono" name="contacto[contacto]" required>
                </div>
                <div class="campo_padre">
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" id="contactar-email" value="email" name="contacto[contacto]" required>
                </div>
            </div>

            <div id="contacto"></div>

            <div class="campo_padre">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]"></textarea>
            </div>
        </fieldset>

        <fieldset>
            <legend>Información sobre la Propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select id="opciones" name="contacto[tipo]">
                <option value="" disabled selected>--Seleccionar--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <div class="campo_padre">
                <label for="precio">Precio o Presupuesto</label>
                <input type="number" placeholder="Tu Precio o Presupuesto" id="precio" name="contacto[precio]">
            </div>
        </fieldset>

        <input type="submit" value="Enviar" class="btn-verde-deshabilitado" name="" id="enviar" disabled>
    </form>
</main>
<!--Footer-->