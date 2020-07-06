<?php

namespace App\Controllers;

use App\Models\Notificacao;
use App\Models\Usuario;
use App\Models\Post;
use App\Models\Seguidor;

class PrincipalController extends Controller
{
    private $app;
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index()
    {

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        self::setViewParam('nameController', $this->app->getNameController());

        $posts = Post::feed($idUsuario);
        $seguidores = Seguidor::getTotalSeguidores($idUsuario);
        $seguindo = Seguidor::getTotalSeguindo($idUsuario);
        $usuario = Usuario::mostrar($idUsuario);
        $notificacoes = Notificacao::ultimasDez($idUsuario);
        $qtdNovas = Notificacao::qtdNovas($idUsuario);

        self::setViewParam('posts', $posts);
        self::setViewParam('totalSeguidores', $seguidores[0]["total"]);
        self::setViewParam('totalSeguindo', $seguindo[0]["total"]);
        self::setViewParam('usuario', $usuario[0]);

        self::setViewParam('notificacoes', $notificacoes);
        self::setViewParam('qtdNovasNotificacoes', $qtdNovas[0]['total']);


        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/funcoes/curtidasEcomentarios.js');

        // echo json_encode($posts);
        $this->render('principal/index');
    }


    public function getSugestoes()
    {

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        $usuarios = Usuario::sugestoes($idUsuario);

        foreach ($usuarios as $usuario) {
            $perfil = "
                <div class='suggestions-list' data-id-user-list='" . $usuario['id'] . "'>
                    <div class='suggestion-usd'>
                        <img src='http://via.placeholder.com/35x35' alt='" . $usuario['nome'] . "'>
                        <div class='sgt-text' style='white-space: nowrap;width: 150px;overflow: hidden;text-overflow: ellipsis;'>
                            <h4 class='text-capitalize' style='text-align: left !important;'>" . $usuario['nome'] . "</h4>
                            <span class='profissao-sidebar text-capitalize'>" . $usuario['profissao'] . "</span>
                        </div>
                        <span class='add-amigo' data-id-usuario='" . $usuario['id'] . "' ><i class='la la-plus'></i></span>
                    </div>
                </div>  
                ";
            echo $perfil;
        }
    }


    public function amigos()
    {
        self::setViewParam('nameController', $this->app->getNameController());

        $idUsuario =  \App\Lib\Auth::usuario()->id;
        $seguidores = Usuario::seguidores($idUsuario);
        $qtdSeguidores = Seguidor::getTotalSeguidores($idUsuario);
        $qtdSeguindo = Seguidor::getTotalSeguindo($idUsuario);
        $usuario = Usuario::mostrar($idUsuario);
        $notificacoes = Notificacao::ultimasDez($idUsuario);

        self::setViewParam('seguidores', $seguidores);
        self::setViewParam('totalSeguidores', $qtdSeguidores[0]["total"]);
        self::setViewParam('totalSeguindo', $qtdSeguindo[0]["total"]);
        self::setViewParam('notificacoes', $notificacoes);
        self::setViewParam('usuario', $usuario[0]);

        self::setViewCss('/public/css/pages/principal/principal.css');
        self::setViewCss('/public/css/pages/principal/amigos.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/principal/amigos.js');

        $this->render('principal/amigos');
    }

    public function getDeveriaConhecer()
    {
        $idUsuario =  \App\Lib\Auth::usuario()->id;

        $usuarios = Usuario::sugestoes($idUsuario);

        foreach ($usuarios as $usuario) {
            $fotoPerfil = ($usuario['foto_perfil'] == "") ? '/public/uploads/fotoPerfil/profile-default.png' : $usuario['foto_perfil'];
            $listagem = '
                <div class="user-profy">
                    <img src="' . $fotoPerfil . '" alt="" style="width: 57px;height: 57px;">
                    <h3>' . $usuario['nome'] . '</h3>
                    <span>' . $usuario['profissao'] . '</span>
                    <ul>
                        <li><a title="Adicionar Amigo" data-id-usuario="' . $usuario['id'] . '" data-nome-usuario="' . $usuario['nome'] . '"  class="add-amigo btn btn-block btn-success" style="background-color: #8b87aa;border: 1px solid #6153ce;height: 35px;padding-top: 0.22em;padding-left: 1em;padding-right: 1em;font-size: 15px;cursor: pointer;border-radius: 50px;"><i class="la la-plus"></i> Seguir</a></li>
                    </ul>
                    <a href="/usuario/perfil/' . $usuario['id'] . '" title="">Visualizar Perfil</a>
                </div>  
                ';
            echo $listagem;
        }
    }
}
