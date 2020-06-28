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

    public function seguir() {
        $idSeguidor = $_POST['id_seguidor'];
        $idSeguindo = $_POST['id_seguindo'];

        // echo json_encode('testando');
        return Seguidor::seguir($idSeguidor, $idSeguindo);
    }
}