<?php

namespace App\Models;

use App\Lib\DB;

class Seguidor{

    public static function getTotalSeguidores($idUsuario) {
        $db = new DB();
        $query = $db->query("SELECT COUNT(*) total 
                                FROM seguidores s 
                                WHERE s.id_seguindo = '".$idUsuario."'");
        
        return $query->fetchAll();
    }

    public static function getTotalSeguindo($idUsuario) {
        $db = new DB();
        $query = $db->query("SELECT COUNT(*) total 
                                FROM seguidores s 
                                WHERE s.id_seguidor = '".$idUsuario."'");
        
        return $query->fetchAll();
    }

    public static function seguir($idSeguidor, $idSeguindo){
        $db = new DB();
        try{
            $db->insert('seguidores', 'id_seguidor, id_seguindo', "'".$idSeguidor."', '".$idSeguindo."'");
            return true;
        }catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public static function desseguir($idSeguidor, $idSeguindo){

    }

}