<?php

class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $imagen;
    private $db;
    function __construct(){
        $this->db = DataBase::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function getCategoriaId(){
        return $this->categoria_id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getStock(){
        return $this->stock;
    }
    public function getOferta(){
        return $this->oferta;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function setCategoriaId($categoria_id){
        $this->categoria_id = $categoria_id;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    public function setDescripcion($desc){
        $this->descripcion = $this->db->real_escape_string($desc);
    }
    public function setPrecio($precio){
        $this->precio = $precio;
    }
    public function setStock($stock){
        $this->stock = $stock;
    }
    public function setOferta($oferta){
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getProductos(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC;");

        return $productos;
    }
    public function getProductosPorCategoria(){
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
                . "INNER JOIN categorias c ON c.id = p.categoria_id "
                . "WHERE p.categoria_id = {$this->getCategoriaId()} "
                . "ORDER BY id DESC;";
        $productos = $this->db->query($sql);

        return $productos;
    }
    public function getOne(){
        
        $producto = $this->db->query("SELECT * FROM productos WHERE id={$this->id};");
        
        return $producto->fetch_object();
    }
    public function getRandom($limit){
        $sql = "SELECT * FROM productos ORDER BY rand() LIMIT $limit;";
        $producto = $this->db->query($sql);
        
        return $producto;
    }
    public function save(){
            $sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoriaId()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, '{$this->oferta}', CURDATE(), '{$this->getImagen()}');";
            $register = $this->db->query($sql);
            
            return $register;
        
    }
    public function actualizarProducto(){
        $sql = "UPDATE productos SET categoria_id={$this->getCategoriaId()}, nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, oferta='{$this->oferta}', fecha=CURDATE()";
        if($this->getImagen() != null){
            $sql .=", imagen='{$this->getImagen()}'";
        }
        
        $sql .= "WHERE id={$this->getId()};";

        $actualizar = $this->db->query($sql);
        
        return $actualizar;
    }

    public function eliminar(){
        $sql = "DELETE FROM productos where id={$this->id};";
        $eliminado = $this->db->query($sql);

        return $eliminado;
    }
}