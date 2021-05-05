<?php

class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identidad'])){
            header("location: ".base_url);
        }else{
            return true;
        }
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location: ".base_url);
        }
    }

    public static function showCategorias(){
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();

        return $categorias;
    }

    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if(isset($_SESSION['carrito'])){

            foreach($_SESSION['carrito'] as $producto){
                $stats['count'] += $producto['unidades']; 
            }
            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }
        return $stats;
    }

    public static function showStatus($status){
        
        if($status == "Confirm"){
            $value = "pendiente";
        }elseif($status == "preparado"){
            $value = "Preparado para enviar";
        }elseif($status == "preparando"){
            $value = "En Preparación para enviar";
        }elseif($status == "enviado"){
            $value = "El pedido ha sido enviado";
        }

        return $value;
    }
}