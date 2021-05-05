<?php if(isset($editar) && isset($pro) && is_object($pro)) :  ?>
<h1>Modificar producto <?php echo $pro->nombre; ?></h1>
<?php $urlAction = base_url."producto/save&id=".$pro->id; ?>
<?php else: ?>
<h1>Crear Nuevos productos</h1>
<?php $urlAction = base_url."producto/save" ?>
<?php endif; ?>

<div class="form_container">
    <form action="<?=$urlAction?>" method="post" enctype="multipart/form-data">
        
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : '';?>">
        <label>Descripcion</label>
        <textarea name="descripcion"><?=isset($pro) && is_object($pro) ? $pro->descripcion : '';?></textarea>
        <label>Precio</label>
        <input type="text" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : '';?>">
        <label>Stock</label>
        <input type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : '';?>">
        <label>Oferta</label>
        <input type="text" name="oferta" value="<?=isset($pro) && is_object($pro) ? $pro->oferta : '';?>">
        
        <?php $categorias = Utils::showCategorias(); ?>
        <label>Categoría</label>
        <select name="categoria">
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : '';?>>
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>
        
        <label>Imagen</label>
        <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen) ) : ?>
            <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb"/> 
        <?php endif; ?>
        <input type="file" name="imagen" >
        <input type="submit" value="Guardar">
    </form>
</div>