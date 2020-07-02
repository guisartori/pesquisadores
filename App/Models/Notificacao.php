<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

class Notificacao {

    public static function nova($texto, $idNotificado){
        $db = new DB();
        $date = date('Y-m-d H:i:s');
        try{
            $db->insert('notificacoes', 'texto, data_hora, status, id_notificado', 
            "'".$texto."', '".$date."', '0', '".$idNotificado."'");
            return true;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public static function ultimasDez($idNotificado){
        $db = new DB();

        try {
            $query = $db->query(
                "SELECT * FROM notificacoes n WHERE n.id_notificado = '".$idNotificado."' LIMIT 10"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function todas($idNotificado){
        $db = new DB();

        try {
            $query = $db->query(
                "SELECT * FROM notificacoes n WHERE n.id_notificado = '".$idNotificado."'"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public static function qtdNovas($idNotificado){
        $db = new DB();

        try {
            $query = $db->query(
                "SELECT COUNT(*) AS total FROM notificacoes n WHERE n.id_notificado = '".$idNotificado."' AND n.status = 0"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public static function marcarComoVisualizado($idNotificado){
        $db = new DB();
        try{
            $db->update('notificacoes', "status = '1'", "id_notificado = '".$idNotificado."'");
            return true;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

}