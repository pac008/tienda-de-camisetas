<h1>Gestión de productos</h1>
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'completed') : ?>
    <strong class="alert_green">EL producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed') : ?>
    <strong class="alert_red">EL producto no se ha creado... ERROR!!</strong>
<?php endif; ?>
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed') : ?>
    <strong class="alert_green">EL producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
    <strong class="alert_red">EL producto no se ha borrado... ERROR!!</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); Utils::deleteSession('delete'); ?>

<a href="<?=base_url?>producto/crear" class="button button-small">Crear producto</a>
<table>
    <tr>
        <th>
            ID
        </th>
        <th>
            NOMBRE
        </th>
        <th>
            PRECIO
        </th>
        <th>
            STOCK
        </th>
        <th>
            ACCIONES
        </th>
    </tr>
<?php while($producto = $productos->fetch_object()) : ?>
    <tr>
        <td>
            <?=$producto->id?>
        </td>
        <td>
            <?=$producto->nombre?>
        </td>
        <td>
            <?=$producto->precio?>
        </td>
        <td>
            <?=$producto->stock?>
        </td>
        <td>
            <a href="<?=base_url?>producto/eliminar&id=<?=$producto->id?>" class="button button-gestion button-red">Eliminar</a>
            <a href="<?=base_url?>producto/modificar&id=<?=$producto->id?>" class="button button-gestion">Modificar</a>
        </td>
    </tr>


<?php endwhile; ?>
</table>