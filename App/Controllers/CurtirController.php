<?php

namespace App\Controllers;

use App\Models\Curtida;

class CurtirController extends Controller {
    private $app;
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index(){
        $idUsuario = $_POST['idUsuario'];
        $idPost = $_POST['idPost'];

        echo json_encode(Curtida::curtir($idUsuario, $idPost));
    }

    public function descurtir(){
        $idUsuario = $_POST['idUsuario'];
        $idPost = $_POST['idPost'];

        echo json_encode(Curtida::descurtir($idUsuario, $idPost));
    }

}