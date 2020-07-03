<?php

namespace App\Controllers;

use App\Models\Topico;

class TopicoController extends Controller {
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function add(){
        $idUsuario = $_POST['idUsuario'];
        $idTopico = $_POST['idTopico'];
        
        return Topico::add($idUsuario, $idTopico);
    }

    public function remove(){
        $idUsuario = $_POST['idUsuario'];
        $idTopico = $_POST['idTopico'];
        
        return Topico::remove($idUsuario, $idTopico);
    }

}