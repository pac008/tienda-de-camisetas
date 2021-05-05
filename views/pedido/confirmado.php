<?php if (isset($_SESSION['pedido']) == 'completed') : ?>

    <h1>Tu pedido se a confirmado</h1>
    <p>
        Tu pedido se ha realizado con exito,
        una vez que realices la transferencia bancaria a la cuenta 84659416528ADW con el coste del pedido
        será procesado y enviado.
    </p>
    <?php if (isset($pedid)) : ?>
        <h3>Datos del :</h3>

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
    <?php endif; ?>
<?php else : ?>
    <h1>Tu pedido no se ha realizado... Hubo un error inesperado!</h1>
<?php endif; ?>