<h1>Gestionar categorías</h1>
<a href="<?=base_url?>categoria/crear" class="button button-small">Crear categoría</a>

<table>
    <tr>
        <th>
            ID
        </th>
        <th>
            NOMBRE
        </th>
    </tr>
<?php while($categoria = $categorias->fetch_object()) : ?>
    <tr>
        <td>
            <?=$categoria->id?>
        </td>
        <td>
            <?=$categoria->nombre?>
        </td>
    </tr>


<?php endwhile; ?>
</table>