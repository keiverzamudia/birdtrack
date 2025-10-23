<?php
namespace App\controlador;

class FrontController{
    public $url;
    public function __construct(){
       
        if (isset($_GET['url'])) {
            $this->url = $_GET['url'];
        }else{
            $this->url = 'login';
        }

        $this->loadController();
    }

    public function loadController(){
        if(file_exists("app/controlador/".$this->url.".php")){
            require_once "app/controlador/".$this->url.".php";
        }else{
            require_once "app/controlador/inicio.php";
        }
    }
}

?>