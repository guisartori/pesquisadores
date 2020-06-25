<?php

namespace App\Controllers;

class HomeController extends Controller {
    private $app;
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index()
    {

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

}