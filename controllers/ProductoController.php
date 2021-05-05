<?php
require_once 'models/producto.php';
class ProductoController{
    public function index (){
        $producto = new Producto();

        $productos = $producto->getRandom(6);

        
        require_once 'views/productos/destacados.php';
    }

    public function detallesProducto(){
        if(isset($_GET['id'])){

            $id = $_GET['id'];

            $producto = new Producto();
            
            $producto->setId($id);

            $product = $producto->getOne();
        }

        require_once 'views/productos/detalles-producto.php';
    }

    public function gestion(){
        Utils::isAdmin();

        $producto = new Producto();
        $productos = $producto->getProductos();
        require_once 'views/productos/gestion.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/productos/crear.php';
    }
    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $categoria_id = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $nombre       = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $desc         = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio       = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock        = isset($_POST['stock']) ? $_POST['stock'] : false;
            $oferta       = isset($_POST['oferta']) ? $_POST['oferta'] : false;
            $imagen       = isset($_POST['imagen']) ? $_POST['imagen'] : false;

            if($categoria_id && $nombre && $desc && $precio && $stock && $oferta){
                $producto = new Producto();
                $producto->setCategoriaId($categoria_id);
                $producto->setNombre($nombre);
                $producto->setDescripcion($desc);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setOferta($oferta);
                
                //Guardar imagen
                if(isset($_FILES['imagen'])){
                    $archivo = $_FILES['imagen'];
                    $fileName = $archivo['name'];
                    $typeFile = $archivo['type'];
                    
                    if($typeFile == 'image/jpg' ||
                    $typeFile == 'image/jpeg' ||
                    $typeFile == 'image/png' || 
                    $typeFile == 'image/gif'){

                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($archivo['tmp_name'], 'uploads/images/'.$fileName);
                        $producto->setImagen($fileName);
                    }
                }
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $saved = $producto->actualizarProducto();
                }else{
                    $saved = $producto->save();
                }


                
                
                if($saved){
                    $_SESSION['producto'] = "completed";
                }else{
                    $_SESSION['producto'] = "failed";
                }

            }else{
                $_SESSION['producto'] = "failed form";
            }
        }else{
            $_SESSION['producto'] = "failed post";
        }
        header("Location: ".base_url."producto/gestion");
    }

    public function eliminar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $delete = $producto->eliminar();
            
            if($delete){
                $_SESSION['delete'] = "completed";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed get";
        }
        header("Location: ".base_url."producto/gestion");
    }
    public function modificar(){
            Utils::isAdmin();
            if(isset($_GET['id'])){
                $editar = true;
                $id = $_GET['id'];

                $producto = new Producto();
                
                $producto->setId($id);

                $pro = $producto->getOne();

                require_once 'views/productos/crear.php';
            }else{
                header("Location: ".base_url."producto/gestion");
            }
    }
    
}