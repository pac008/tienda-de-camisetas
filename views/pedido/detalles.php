<?php if (isset($pedid)) : ?>
<h1>Detalles del pedido</h1>
<?php if(isset($_SESSION['admin'])) : ?>
    <h3>Cambiar estado del producto</h3>
    <form action="<?=base_url?>pedido/estado" method="post">
        <input type="hidden" value="<?=$pedid->id?>" name="pedido_id">
        <select name="estado">
            <option value="Confirm" <?= $pedid->estado == "Confirm" ? 'selected' : ''; ?>>Pendiente</option>
            <option value="preparando" <?= $pedid->estado == "preparando" ? 'selected' : ''; ?>>Preparando para enviar</option>
            <option value="preparado" <?= $pedid->estado == "preparado" ? 'selected' : ''; ?>>Preparado para ser enviado</option>
            <option value="enviado" <?= $pedid->estado == "enviado" ? 'selected' : ''; ?>>Enviado</option>
        </select>

        <input type="submit" value="Cambiar estado">
    </form>
    <br>
<?php endif; ?>
<h3>Detalles del pedido</h3>
        Estado: <?=Utils::showStatus($pedid->estado)?> <br>
        Provincia <?= $pedid->provincia; ?><br>
        Localidad <?= $pedid->localidad; ?><br>
        Dirección <?= $pedid->direccion ?>
<h3>Datos del pedido</h3>
Número del pedido: <?= $pedid->id; ?><br>
        Total a pagar: <?= $pedid->coste; ?><br>
        productos:
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>precio</th>
                <th>unidades</th>
            </tr>
            <?php while ($producto = $productos->fetch_object()) : ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null) : ?>
                            <img src="<?= base_url . "uploads/images/" . $producto->imagen ?>" class="img_carrito">
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/detallesproducto&id=<?= $producto->id ?>">
                            <?= $producto->nombre ?>
                        </a>
                    </td>
                    <td><?= $producto->precio ?></td>
                    <td><?= $producto->unidades ?></td>

                </tr>
            <?php endwhile; ?>
        </table>
        <?php else : ?>
    <h1>Hubo un error inesperado!</h1>
<?php endif; ?>