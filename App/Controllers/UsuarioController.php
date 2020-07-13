<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Post;
use App\Models\Experiencia;
use App\Models\Formacao;
use App\Models\Habilidade;
use App\Models\Notificacao;
use App\Models\Topico;

class UsuarioController extends Controller
{
    private $app;

    public function __construct($app)
    {
        $this->app = $app;

        self::setViewParam('nameController', $this->app->getNameController());
    }

    public function perfil()
    {

        $idPerfil = $this->app->getParams()[0];
        $idUsuario =  \App\Lib\Auth::usuario()->id;
        $topicos = Topico::getTopicosInteressado($idPerfil);

        // $posts = Post::todos($idPerfil);
        // self::setViewParam('posts', $posts);
        // echo var_dump($posts);
        // echo var_dump($idPerfil);



        self::setViewParam('aAmigo', Usuario::mostrar($idPerfil));
        self::setViewParam('aListaExperiencia', Experiencia::todos($idPerfil));
        self::setViewParam('aListaEducacao', Formacao::todos($idPerfil));
        self::setViewParam('aListaHabilidades', Habilidade::todos($idPerfil));
        self::setViewParam('posts', Post::todos($idPerfil));
        self::setViewParam('topicos', $topicos);
        $notificacoes = Notificacao::ultimasDez($idUsuario);

        self::setViewParam('notificacoes', $notificacoes);
        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/funcoes/curtidasEcomentarios.js');
        self::setViewJs('/public/js/perfil/perfil-amigo.js');

        // echo var_dump();

        $this->render('principal/amigo');
    }

    public function cadastrar()
    {

        self::setViewJs('/public/js/jquery.maskMoney.min.js');
        self::setViewJs('/public/js/jquery-ui.js');
        self::setViewJs('/public/js/main.datepicker.js');
        self::setViewJs('/public/js/main.mask.money.js');
        self::setViewCss('/public/css/jquery-ui.min.css');

        $this->render('usuario/cadastrar');
    }


    public function atualizar()
    {

        $response = Usuario::atualizar($_POST);

        if ($response) {
            $this->redirect("perfil/editar");
        } else {
            echo $response;
        }
    }

    public function atualizarVisaoGeral()
    {
        $response = Usuario::atualizarVisaoGeral($_POST);

        if ($response) {
            $this->redirect("perfil/editar");
        } else {
            echo $response;
        }
    }
}
