<?php
include 'inc/funciones/sesiones.php';
include 'inc/funciones/funciones.php';
include 'inc/templates/header.php';
include 'inc/templates/barra.php';

// OBTENER EL ID DE LA URL
if (isset($_GET['id_proyecto'])) {
    $id_proyecto = $_GET['id_proyecto'];
}
?>
<body>


<div class="contenedor">
    <?php 
        include 'inc/templates/sidebar.php';
    ?>

    <main class="contenido-principal">
       <?php
            $proyecto = obtenerNombreProyecto($id_proyecto);
            if($proyecto): ?>
        <h1>
            <?php foreach($proyecto as $nombre): ?>
                <span><?php echo $nombre['nombre']; ?></span>
            <?php endforeach; ?>
        </h1>

        <form action="#" class="agregar-tarea">
            <div class="campo">
                <label for="tarea">Tarea:</label>
                <input type="text" placeholder="Nombre Tarea" class="nombre-tarea"> 
            </div>
            <div class="campo enviar">
                <input type="hidden"  id="id_proyecto" value="<?php echo $id_proyecto; ?>">
                <input type="submit" class="boton nueva-tarea" value="Agregar">
            </div>
        </form>
        
        <?php
            else: 
                // SI NO HAY PROYECTO SELECCIONADO
                echo "<p>Selecciona un proyecto</p>";
            endif;
        ?>

        <h2>Listado de tareas:</h2>

        <div class="listado-pendientes">
            <ul>
                <?php
                    // OBTIENE LAS TAREAS DEL PROYECTO ACTUAL
                    $tareas = obtenerTareasProyecto($id_proyecto);
                    if($tareas->num_rows > 0){
                        // SI HAY TAREAS
                        foreach ($tareas as $tarea): ?>
                            <li id="tarea:<?php echo $tarea['id'] ?>" class="tarea">
                            <p><?php echo $tarea['nombre'] ?></p>
                                <div class="acciones">
                                    <i class="far fa-check-circle <?php echo ($tarea['estado'] === '1' ? 'completo' : '')?>"></i>
                                    <i class="fas fa-trash"></i>
                                </div>
                            </li>
                   <?php     endforeach;
                    } else {
                        // NO HAY TAREAS
                        echo "<p>No hay tareas en este proyecto</p>";
                    }
                ?>

            </ul>
        </div>
    </main>
</div><!--.contenedor-->
<?php 
include 'inc/templates/footer.php';
?>


