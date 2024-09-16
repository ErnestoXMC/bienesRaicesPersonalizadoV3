<!--Header-->
        <main class="contenedor contenido-centrado">
            <h1>Iniciar Sesión</h1>
            <?php foreach($errores as $error){?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
             <?php } ?>   
            <form class="formulario" method="POST" action="/login">
                <fieldset>
                    <legend>Email y Password</legend>


                    <label for="email">E-mail</label>
                    <input type="email" placeholder="Tu Email" name="email" id="email">

                    <label for="password">Password</label>
                    <input type="password" placeholder="Tu Password" name="password" id="password">

                    <input type="submit" value="Iniciar Sesion" class="btn-verde-claro">

                </fieldset>
            </form>
        </main>
<!--Footer-->