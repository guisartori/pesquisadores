<?php

namespace App\Controllers;

use App\Models\Habilidade;

class HabilidadeController extends Controller {

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function salvar(){
        $data['id_usuario'] = $_POST['id_usuario'];
        $data['nome'] = $_POST['nome'];

        $response = Habilidade::novo($data);
        if($response){
            header("Location: http://localhost/perfil/editar");
        } else {
            echo json_encode($response);
        }
    }

    public function deletar(){
        $idHabilidade = $this->app->getParams()[0];
        $response = Habilidade::deletar($idHabilidade);
        
        if($response){
            header("Location: http://localhost/perfil/editar");
        } else {
            echo json_encode($response);
        }
    }
}