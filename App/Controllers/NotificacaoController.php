<?php 

namespace App\Controllers;

use App\Models\Notificacao;

class NotificacaoController extends Controller{
    public function __construct($app)
    {
        $this->app = $app;
    }

    public static function novoPostDeAmigoSeguido($usuario, $titulo, $idNotificado){
        $texto = "<p>$usuario fez um novo post chamado: $titulo</p>";
        $resultado = Notificacao::nova($texto, $idNotificado);
        return $resultado;
    }

    public static function novoSeguidor($usuario, $idNotificado){
        $texto = "<p>$usuario acabou de começar a te seguir.</p>";
        $resultado = Notificacao::nova($texto, $idNotificado);
        return $resultado;
    }

    public static function novaCurtida($usuario, $titulo, $idNotificado){
        $texto = "<p>$usuario curtiu sua publicação: $titulo</p>";
        $resultado = Notificacao::nova($texto, $idNotificado);
        return $resultado;
    }

    public static function novoComentario($usuario, $comentario, $idNotificado){
        $texto = "<p>$usuario comentou na sua publicação: $comentario</p>";
        $resultado = Notificacao::nova($texto, $idNotificado);
        return $resultado;
    }

    public function visualizarNotificacao(){
        $idNotificado = $_POST['idNotificado'];
        $resultado = Notificacao::marcarComoVisualizado($idNotificado);
        return $resultado;
    }
}