<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

class Recomendacao {

    public static function recomendar($idRecomendador, $idRecomendado){
        $db = new DB();

        try{
            $db->insert('recomendacoes', 'id_recomendador, id_recomendado', "'".$idRecomendador."', '".$idRecomendado."'");
            return true;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public static function desRecomendar($idRecomendador, $idRecomendado){
        $db = new DB();

        try{
            $db->delete('recomendacoes', "id_recomendado = '".$idRecomendado."' AND id_recomendador = '".$idRecomendador."'");
            return true;
        } catch (Exception $e){
            return json_encode($e->getMessage());
        }
    }

    public static function jaRecomendou($idRecomendador, $idRecomendado){
        $db = new DB();

        try{
            $query = $db->query("SELECT 
                            CASE WHEN EXISTS (SELECT id FROM recomendacoes r 
                                                WHERE r.id_recomendado = '".$idRecomendado."' 
                                                AND r.id_recomendador = '".$idRecomendador."')
                            THEN 'TRUE' 
                            ELSE 'FALSE'
                            END AS recomendado
                        FROM recomendacoes");
            return $query->fetchAll()[0]['recomendado'] == 'TRUE';
        } catch (Exception $e){
            return json_encode($e->getMessage());
        }
    }

    public static function qtdRecomendacoes($idUsuario){
        $db = new DB();

        $query = $db->query("SELECT COUNT(*) AS total FROM recomendacoes WHERE id_recomendado = '.$idUsuario.'");
        $result = $query->fetchAll();
        return $result[0]['total'];

    }
}