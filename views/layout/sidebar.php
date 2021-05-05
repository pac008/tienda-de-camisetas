 <!-- BARRA LATERAL -->
 <aside id="lateral">
     <div id="carrito" class="block_aside">
        <h3>Mi carrito</h3>
        <ul>
            <li>
            <?php $stats = Utils::statsCarrito() ?>
                 <a href="<?=base_url?>carrito/index">Productos (<?= $stats['count']?>)</a>   
            </li>
            <li>
                 <a href="<?=base_url?>carrito/index">Total: <?= $stats['total']?> Euros </a><br>
            </li>
            <li>
                 <a href="<?=base_url?>carrito/index">Ver Carrito</a>
            </li>
          
        </ul>
     </div>
     <div id="login" class="block_aside">
     <?php if(!isset($_SESSION['identidad'])): ?>
         <h3>Entrar a la web</h3>
         <form action="<?=base_url?>Usuario/login" method="post">
             <label>Email</label>
             <input type="email" name="email">
             <label>Contraseña</label>
             <input type="password" name="password">
             <input type="submit" value="Enviar">
         </form>
            <br>
                 <a href="<?=base_url?>usuario/register" class="button">Regístrate aquí</a>
            
         <?php else: ?>
         <h3><?=$_SESSION['identidad']->nombre?> <?=$_SESSION['identidad']->apellidos?></h3>
         <?php endif; ?>
         <ul>
         <?php if(isset($_SESSION['admin']) ): ?>
             <li>
                 <a href="<?=base_url?>categoria/index">Gestionar Categorías</a>
             </li>
             <li>
                 <a href="<?=base_url?>producto/gestion">Gestionar Productos</a><br>
             </li>
             <li>
                 <a href="<?=base_url?>pedido/gestion">Gestionar Pedidos</a><br>
             </li>
        <?php endif; ?>
         <?php if(isset($_SESSION['identidad']) ): ?>
             <li>
                 <a href="<?=base_url?>pedido/mispedidos">Mis pedidos</a><br>
             </li>
             <li>
                 <a href="<?=base_url?>usuario/logout">Cerrar sesión</a>
             </li>
        <?php endif; ?>
         </ul>
     </div>
 </aside>

 <!-- CONTENIDO CENTRAL -->
 <div id="central">