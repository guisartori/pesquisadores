<?php

namespace App\Controllers;

use App\Models\Recomendacao;

class RecomendacaoController extends Controller{

    public function recomendar(){
        $idRecomendador = $_POST['idRecomendador'];
        $idRecomendado = $_POST['idRecomendado'];

        $response = Recomendacao::recomendar($idRecomendador, $idRecomendado);
        echo json_encode($response);
    }

    public function desRecomendar(){
        $idRecomendador = $_POST['idRecomendador'];
        $idRecomendado = $_POST['idRecomendado'];

        $response = Recomendacao::desRecomendar($idRecomendador, $idRecomendado);
        echo json_encode($response);
    }

    
}