<?php 
require_once 'models/usuario.php';
class UsuarioController{
   
    public function index(){
        echo "controlador usuarios, acción index";
    }
    public function register(){
        require_once 'views/usuario/registro.php';
    }

    public function saveUser(){
        if(isset($_POST)){
            $nombre     = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos  = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email      = isset($_POST['email']) ? $_POST['email'] : false;
            $password   = isset($_POST['password']) ? $_POST['password'] : false;
            if($nombre && $apellidos && $email && $password){
                
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $saved = $usuario->save();
            }else{
                $_SESSION['register'] = "failed";
            }

            if($saved){
                $_SESSION['register'] = "completed";
                
            }else{
                $_SESSION['register'] = "failed";
              
            }
        }else{
            $_SESSION['register'] = "failed";
        }
        header("Location: ".base_url."usuario/register");
    }

    public function login(){
        if(isset($_POST)){

            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identidad = $usuario->login();

            if($identidad && is_object($identidad)){
                $_SESSION['identidad'] = $identidad;

                if($identidad->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['Error_login'] = 'Identificación fallida';
            }

        }
        header("Location: ".base_url);
    }

    public function logout(){

            unset($_SESSION['identidad']);
        
            unset($_SESSION['admin']);
        
        header("Location: ".base_url);
    }
}