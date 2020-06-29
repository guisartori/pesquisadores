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

    public static function eSeguidor($idSeguidor, $idSeguindo){
        $db = new DB();

        try{
            $query = $db->query("SELECT 
                            CASE WHEN EXISTS (SELECT id FROM seguidores s 
                                                WHERE s.id_seguidor = '".$idSeguidor."' 
                                                AND s.id_seguindo = '".$idSeguindo."')
                            THEN 'TRUE' 
                            ELSE 'FALSE'
                            END AS segue
                        FROM seguidores");
            return $query->fetchAll()[0]['segue'] == 'TRUE';
        } catch (Exception $e){
            return json_encode($e->getMessage());
        }
    }

    public static function deixarDeSeguir($idSeguidor, $idSeguindo){
        $db = new DB();

        try{
            $db->delete('seguidores', "id_seguidor = '".$idSeguidor."' AND id_seguindo = '".$idSeguindo."'" );
            return true;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

}