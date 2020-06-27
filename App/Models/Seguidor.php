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

}