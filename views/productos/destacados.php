<h1>Productos Destacados</h1>

<?php while($producto = $productos->fetch_object()) : ?>

<div class="product">
    <a href="<?=base_url?>producto/detallesproducto&id=<?=$producto->id?>">
        <?php if($producto->imagen != null) : ?>
        <img src="<?=base_url."uploads/images/".$producto->imagen?>">
        <?php else: ?>
            <img src="<?=base_url?>assets/img/camiseta.png">
        <?php endif; ?>
        <h2><?=$producto->nombre?></h2>
    </a>
    <p><?=$producto->precio?> Euros</p>
    <a href="<?=base_url?>carrito/add&id=<?=$producto->id?>" class="button">Comprar</a>
</div>
<?php endwhile ?>
