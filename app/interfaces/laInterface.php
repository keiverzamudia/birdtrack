<?php
 namespace App\interfaces;

 interface laInterface{

    public function validarDatos();
    
    public function confirmarRegistro();

    public function confirmarModificacion();

    public function eliminar();

    public function consultar();

 }