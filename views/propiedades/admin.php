<!--Header-->
<main class="contenedor">
    <h1 class="titulo-regular">Administrador</h1>
    <a href="/propiedades/crear" class="btn-verde-claro">
        Nueva Propiedad
    </a>
    <a href="/vendedores/crear" class="btn-verde-claro">
        Nuevo(a) Vendedor(a)
    </a>
    <h2>Propiedades</h2>
        <?php 
        if($resultado){
            $mensaje = mostrarNotificacion(intval($resultado));
            if($mensaje){ ?>
                <p class="alerta exito"><?php echo $mensaje;?></p>
            <?php }; ?>
        <?php }; ?>
    <div class="table-wrapper">
        <table class="propiedades">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Imagen</td>
                    <td>Precio</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($propiedades as $propiedad):?>
                    <tr>
                        <td><?php echo $propiedad->id ;?></td>
                        <td><?php echo $propiedad->titulo ;?></td>
                        <td><img src="../imagenes/<?php echo $propiedad->imagen ;?>" alt="Imagen propiedad" class="imagen-tabla" loading="lazy"></td>
                        <td>$<?php echo $propiedad->precio ;?></td>
                        <td>
                            <a href="/propiedades/actualizar?id=<?php echo $propiedad->id ;?>" class="btn-icono actualizar">
                                <img src="/build/img/icono_actualizar.svg" alt="Icono actualizar" loading="lazy">
                            </a>
                            <form method="POST" action="propiedades/eliminar" class="form-admin" id="deleteForm-<?php echo $propiedad->id ; ?>">

                                <input type="hidden" name="id" id="eliminar" value="<?php echo $propiedad->id ; ?>">
                                <input type="hidden" name="tipo" id="eliminar" value="<?php echo "propiedad"; ?>">

                                <button type="button" class="btn-icono eliminar" onclick="confirmDelete(<?php echo $propiedad->id ; ?>)">
                                    <img src="/build/img/icono_eliminar.svg" alt="Icono Eliminar" loading="lazy">
                                </button>
                            </form>
                            <a href="/admin/propiedades/info.php?id=<?php echo $propiedad->id ;?>" class="btn-icono info">
                                <img src="/build/img/icono_info.svg" alt="Icono Info" loading="lazy">
                            </a>
                            
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- -------------VENDEDORES---------- -->
    <div class="table-wrapper">
        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Telefono</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vendedores as $vendedor):?>
                    <tr>
                        <td><?php echo $vendedor->id ;?></td>
                        <td><?php echo $vendedor->nombre ;?></td>
                        <td><?php echo $vendedor->apellido ;?></td>
                        <td><?php echo $vendedor->telefono ;?></td>
                        <td>
                            <a href="/vendedores/actualizar?id=<?php echo $vendedor->id ;?>" class="btn-icono actualizar">
                                <img src="/build/img/icono_actualizar.svg" alt="Imagen Icono">
                            </a>
                            <form method="POST" class="form-admin" action="vendedores/eliminar" id="deleteForm-<?php echo $vendedor->id ; ?>">
                                
                                <input type="hidden" name="id" id="eliminar" value="<?php echo $vendedor->id ; ?>">
                                <input type="hidden" name="tipo" id="eliminar" value="<?php echo "vendedor"; ?>">
                                <button type="button" class="btn-icono eliminar" onclick="confirmDelete(<?php echo $vendedor->id ; ?>)">
                                <img src="/build/img/icono_eliminar.svg" alt="Icono Eliminar" loading="lazy">

                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</main>
><!--Footer-->