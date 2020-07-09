<?php

namespace App\Controllers;

use App\Models\Experiencia;

class ExperienciaController extends Controller
{

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function salvar()
    {
        $data['id_usuario'] = $_POST['id_usuario'];
        $data['titulo'] = $_POST['titulo'];
        $data['texto'] = $_POST['texto'];

        $response = Experiencia::novo($data);
        if ($response) {
            $this->redirect('perfil/editar');
        } else {
            echo json_encode($response);
        }
    }

    public function deletar()
    {
        $idExperiencia = $this->app->getParams()[0];
        $response = Experiencia::deletar($idExperiencia);

        if ($response) {
            $this->redirect("perfil/editar");
        } else {
            echo json_encode($response);
        }
    }
}
