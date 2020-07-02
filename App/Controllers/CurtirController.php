<?php

namespace App\Controllers;

use App\Models\Curtida;
use App\Models\Post;
use App\Models\Usuario;

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
        $usuario = Usuario::mostrar($idUsuario)[0];
        $post = Post::mostrar($idPost)[0];
        NotificacaoController::novaCurtida($usuario['nome'], $post['titulo'], $post['id_usuario']);
        echo json_encode(Curtida::curtir($idUsuario, $idPost));
    }

    public function descurtir(){
        $idUsuario = $_POST['idUsuario'];
        $idPost = $_POST['idPost'];

        echo json_encode(Curtida::descurtir($idUsuario, $idPost));
    }

}