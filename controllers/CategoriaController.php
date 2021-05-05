<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class CategoriaController{
    
    public function index (){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getCategorias();
        require_once 'views/categorias/index.php';
    }

    public function ver(){
         if(isset($_GET['id'])){
            $id = $_GET['id'];

            $categoria = new Categoria();
            $cat = $categoria->getOne($id);

           $producto = new Producto();
           $producto->setCategoriaId($id);
           $productos = $producto->getProductosPorCategoria();
        }
         
         require_once 'views/categorias/ver.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/categorias/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST['nombre'])){
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
        header("Location: ".base_url."categoria/index");
    }

    
}