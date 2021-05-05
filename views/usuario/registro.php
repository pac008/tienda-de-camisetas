<h1>Registrarse</h1>
<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'completed') : ?>
    <strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
    <strong class="alert_red">Registro fallido</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>



<form action="<?=base_url?>Usuario/saveUser" method="post">
    <Label for="nombre">Nombre: </Label>
    <input type="text" name="nombre" required>

    <Label for="apellidos">Apellidos: </Label>
    <input type="text" name="apellidos" required>

    <Label for="email">Email: </Label>
    <input type="email" name="email" required>

    <Label for="password">Contraseña: </Label>
    <input type="password" name="password" required>

    <input type="submit" value="Registrarse">
</form>