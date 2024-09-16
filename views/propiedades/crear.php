<!--Header-->
<main class="contenedor">

    <div class="orden-titulo">
        <a href="/admin" class="btn-volver">
            <img src="/build/img/icono_volver.svg" alt="Icono Volver" loading="lazy">
        </a>
        <h1 class="titulo-regular">Crear Propiedad</h1>
    </div>

    <?php foreach($errores as $error){?>
        <div class="alerta error">
            <?php echo "$error";?>
        </div>
    <?php };?>

    <form class="formulario" method="POST" action="/propiedades/crear" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input type="submit" value="Agregar" class="btn-verde-claro">
    </form>
</main>
<!--Footer-->