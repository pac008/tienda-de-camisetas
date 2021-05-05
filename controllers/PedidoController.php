<?php
require_once 'models/pedido.php';

class PedidoController{
    public function hacer (){
        require_once 'views/pedido/hacer.php';
    }

    public function add(){
        
        if(isset($_SESSION['identidad'])){
            //Guardar datos en la database
            $usuario_id = $_SESSION['identidad']->id;
            
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false; 
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false; 
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false; 

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            if($provincia && $localidad && $direccion){

                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

               $save = $pedido->save();
               $saveLinea = $pedido->saveLinea();
               if($save && $saveLinea){
                   $_SESSION['pedido'] = 'completed';
               }else{
                   $_SESSION['pedido'] = 'failed';
               }
               header("Location: ".base_url.'pedido/confirmado');
            }else{
                
                $_SESSION['pedido'] = 'failed';
            }
        }else{
            header("Location: ".base_url);
        }
        
    }

    public function confirmado(){
        if(isset($_SESSION['identidad'])){
            $identidad = $_SESSION['identidad'];
            $pedido = new Pedido();
            $pedido->setUsuarioId($identidad->id);
            $pedid = $pedido->getOneByUser();

            $pruductosPedido = new Pedido();
            $productos = $pruductosPedido->getProductosByPedido($pedid->id);
        }
        require_once 'views/pedido/confirmado.php';
    }
    public function misPedidos(){
        Utils::isIdentity();    
        $usuarioId = $_SESSION['identidad']->id;
        $pedido = new Pedido();
        //Sacar los pedidos del usuario
        $pedido->setUsuarioId($usuarioId);
        $pedidos = $pedido->getAllByUser();
        
        require_once 'views/pedido/mis-pedidos.php';
    }

    public function detalles(){
        Utils::isIdentity();    
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedid = $pedido->getOne();

            $pruductosPedido = new Pedido();
            $productos = $pruductosPedido->getProductosByPedido($id);
            require_once 'views/pedido/detalles.php';
        }else{
            header("Location: ".base_url);
        }
    }
    
    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getPedidos();
        require_once 'views/pedido/mis-pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $actualizar = $pedido->actualizarPedido();
            header("Location: ".base_url."pedido/detalles&id=".$id);
        }else{
            header("Location: ".base_url);
        }
    }
}
