<?php

namespace App\Controllers;

use App\Lib\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index() {

        $this->existeLayout(false);


        self::setViewCss('/public/css/slick.css');
        self::setViewCss('/public/css/slick-theme.css');
        self::setViewCss('/public/css/pages/login/login.css');

        self::setViewJs('/public/js/slick.min.js');
        self::setViewJs('/public/js/jquery.mask.min.js');
        self::setViewJs('/public/js/login/login.js');

        self::setViewParam('nameController', $this->app->getNameController());

        $this->render('login/index');

    }

    public function entrar()
    {
        $this->existeLayout(false);

        if ($oUser = Usuario::logar($_POST)) {

            Auth::gravaSessao($oUser);

            self::setViewCss('/public/css/flatpickr.min.css');
            self::setViewCss('/public/css/slick.css');
            self::setViewCss('/public/css/slick-theme.css');

            self::setViewJs('/public/js/slick.min.js');

            $this->redirect('principal/');
        } else {

            $this->redirect('login/');
        }
    }

    public function sair()
    {
        $this->existeLayout(false);

        Auth::deslogar();

        $this->redirect('login/');

    }
    public function cadastrar()
    {

        $this->existeLayout(false);

        self::setViewParam('nameController', $this->app->getNameController());

        $this->render('login/cadastrar');

    }

    public function salvar() {
        $this->existeLayout(false);

        if($oUser = Usuario::salvar($_POST)){

            Auth::gravaSessao($oUser);

            $this->redirect('admin/');
        }

        $this->redirect('principal/index');

    }

}