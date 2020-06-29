<?php

namespace App\Controllers;

use App\Lib\DB;
use App\Models\Seguidor;


class SeguidorController extends Controller
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;

        self::setViewParam('nameController',$this->app->getNameController());

    }

    public function mudarSeguir() {
        $idSeguidor = $_POST['id_seguidor'];
        $idSeguindo = $_POST['id_seguindo'];

        if(Seguidor::eSeguidor($idSeguidor, $idSeguindo)){
            return Seguidor::deixarDeSeguir($idSeguidor, $idSeguindo);
        } else {
            return Seguidor::seguir($idSeguidor, $idSeguindo);
        }
        // echo json_encode('testando');
    }
}