<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
    <title>Tienda de camisetas</title>
</head>

<body>
    <div id="container">
        <!-- Cabecera -->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="<?=base_url?>">
                    Tienda de Camisetas
                </a>
            </div>
        </header>
        <!-- MENÚ -->
        <nav id="menu">
        <?php $categorias = Utils::showCategorias(); ?>
            <ul>
                <li>
                    <a href="<?=base_url?>">Inicio</a>
                </li>
                <?php while($cat = $categorias->fetch_object()) : ?>
                <li>
                    <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                </li>
                <?php endwhile; ?>
            </ul>
        </nav>
        <div id="content">