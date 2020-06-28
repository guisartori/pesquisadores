<?php

namespace App\Controllers;

use App\Models\Comentario;

class ComentarioController extends Controller {
    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function novo() {
        $texto = $_POST['texto'];
        $dataHora = date('Y-m-d H:i:s');
        $idPost = $_POST['id_post'];
        $idUsuario = $_POST['id_usuario'];

        $result = Comentario::novo($texto, $dataHora, $idPost, $idUsuario);

        if($result){
            header("Location: /principal");
        }

    }

    public function todos() {
        $idPost = $_POST['id_post'];
        $comentarios = Comentario::todos($idPost);
        
        foreach($comentarios as $comentario) {
            $row = '
                <div class="card" style="margin-bottom: 16px">
                <div class="card-header" style="display: flex;justify-content: space-between;">'.$comentario['nome'].' <small>'.$comentario['data_hora'].'</small></div>
                    <div class="card-body">
                    '.$comentario['texto'].'
                    </div>
                </div>  
                ';
            echo $row;
        }
    }

}