<?php

namespace App\Controllers;

use App\Models\Formacao;

class FormacaoController extends Controller
{

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function novo()
    {
        $data['id_usuario'] = $_POST['id_usuario'];
        $data['titulo'] = $_POST['titulo'];
        $data['texto'] = $_POST['texto'];
        $data['ano_inicio'] = $_POST['ano_inicio'];
        $data['ano_fim'] = $_POST['ano_fim'];

        $response = Formacao::novo($data);
        if ($response) {
            $this->redirect("perfil/editar");
        } else {
            echo json_encode($response);
        }
    }

    public function deletar()
    {
        $idFormacao = $this->app->getParams()[0];
        $response = Formacao::deletar($idFormacao);

        if ($response) {
            $this->redirect("perfil/editar");
        } else {
            echo json_encode($response);
        }
    }
}
