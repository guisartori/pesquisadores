<?php

namespace App\Controllers;

use App\Models\Topico;

class TopicoController extends Controller
{
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index()
    {

        $topicos = Topico::todos();
        self::setViewParam('topicos', $topicos);

        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewParam('nameController', $this->app->getNameController());

        $this->render('topicos/index');
    }

    public function add()
    {
        $idUsuario = $_POST['idUsuario'];
        $idTopico = $_POST['idTopico'];

        return Topico::add($idUsuario, $idTopico);
    }

    public function remove()
    {
        $idUsuario = $_POST['idUsuario'];
        $idTopico = $_POST['idTopico'];

        return Topico::remove($idUsuario, $idTopico);
    }
}
