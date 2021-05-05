<?php

class Categoria{

    private $id;
    private $nombre;
    private $db;

    function __construct(){
        $this->db = DataBase::connect();
    }

    function getNombre(){
        return $this->nombre;
    }
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function getCategorias(){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");

        return $categorias;
    }
    function getOne($id){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$id};");

        return $categoria->fetch_object();
    }

    function save(){
        $sql = "INSERT INTO categorias VALUES(null, '{$this->getNombre()}');";
        $guardado = $this->db->query($sql);

        return $guardado;

    } 

}