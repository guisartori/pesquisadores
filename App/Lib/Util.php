<?php

namespace App\Lib;

use App\Models\Curtida;
use App\Models\Recomendacao;
use App\Models\Seguidor;

class Util
{
    public static function hash($senha,$revert=false){
        if($revert){
            return base64_decode($senha);
        }else{
            return base64_encode($senha);
        }
    }
    public static function redirect($view) {
        header('Location: /' . $view);
    }
    public static function convertDate($dt,$format){

        if($format == "Y-m-d"){
            $aDate = explode("/",$dt);

            $date = new \DateTime($aDate[2]."-".$aDate[1]."-".$aDate[0]);

            return $date->format('Y-m-d');

        }else if($format == "d/m/Y"){
            $date = new \DateTime($dt);

            return $date->format('d/m/Y');
        }else{

            $date = new \DateTime($dt);

            return $date->format('d/m/Y');
        }

    }

    public static function formatMoney($valor,$lang, $simbolo = false){
        if($lang == "pt") {
            if($simbolo) {
                $simbolo = "R$";

                return $simbolo . " " . number_format($valor, 2, ',', '.');
            }else{
                return number_format($valor, 2, ',', '.');
            }
        }else if($lang == "en") {
            if($simbolo) {
                $simbolo = "US$";

                return $simbolo . " " . number_format($valor, 2, '.', ',');
            }else{
                return str_replace(",", ".",str_replace(".", "",$valor));
            }
        }
    }

    public static function taCurtido($idPost, $idUsuario){
        $response = Curtida::check($idPost, $idUsuario);
        return $response;
    }

    public static function qtdCurtidas($postId){
        return Curtida::qtdCurtidas($postId);
    }

    public static function segue($idSeguidor, $idSeguindo){
        return Seguidor::eSeguidor($idSeguidor, $idSeguindo);
    }

    public static function jaRecomendado($idRecomendador, $idRecomendado){
        return Recomendacao::jaRecomendou($idRecomendador, $idRecomendado);
    }

    public static function qtdRecomendacoes($idUsuario){
        return Recomendacao::qtdRecomendacoes($idUsuario);
    }
}