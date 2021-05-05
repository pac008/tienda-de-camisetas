<?php if (isset($_SESSION['identidad'])) : ?>
    <h1>Hacer pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>
    <br>
    <form action="<?=base_url?>pedido/add" method="post">
        <h3>Dirección para el envío:</h3>
        <label for="provincia">Provincia</label>
        <input type="text" value="" name="provincia">

        <label for="Localidad">Localidad</label>
        <input type="text" value="" name="localidad">

        <label for="Direccion">Dirección</label>
        <input type="text" value="" name="direccion">

        <input type="submit" value="Confirmar">
    </form>

<?php else : ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitas estar logueado en la web para poder realizar el pedido</p>
<?php endif; ?>