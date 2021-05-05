<?php 
require_once 'models/producto.php';

class CarritoController{

    public function index(){

        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = $_SESSION['carrito'];
        }   
            
        require_once 'views/carrito/index.php';
    }
    
    public function add(){
        if(isset($_GET['id'])){
            $productoId = $_GET['id'];
        }else{
            header("Location: ".base_url);
        }

        if(isset($_SESSION['carrito'])){
            $contador = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento){
                if($elemento['id_producto'] == $productoId){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $contador++;
                }
            }
        
        }
        if(!isset($contador) || $contador == 0){
            //conseguir
            $producto = new Producto();
            $producto->setId($productoId);
            $product = $producto->getOne();
            //añadir al carrito
            if(is_object($product)){
                $_SESSION['carrito'][] = array(
                    "id_producto" => $product->id,
                    "precio"      => $product->precio,
                    "unidades"    => 1,
                    "producto"    => $product
                );
            }
            
        }
        
        header("Location: ".base_url."carrito/index"); 
    }
    
    public function deleteProducto(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location: ".base_url."carrito/index");
    }
    public function up(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        header("Location: ".base_url."carrito/index");
    }
    public function down(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            
            if($_SESSION['carrito'][$index]['unidades'] == 0){
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location: ".base_url."carrito/index");
    }
    

    public function deleteCarrito(){
        unset($_SESSION['carrito']);
        header("Location: ".base_url."carrito/index");
    }
}