<?php

namespace App\Controllers;

use App\Models\Comentario;
use App\Models\Curtida;
use App\Models\Post;

class PostController extends Controller
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function excluir()
    {
        Curtida::excluirCurtidas($_POST['id_post']);
        Comentario::excluirComentarios($_POST['id_post']);
        echo json_encode(Post::excluir($_POST['id_post']));
    }

    public function editar()
    {
        $idPost = $_POST['id'];
        $titulo = $_POST['titulo'];
        $texto = $_POST['texto'];

        echo json_encode(Post::editar($idPost, $titulo, $texto));
    }
}
