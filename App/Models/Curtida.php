<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

class Curtida
{

    public static function curtir($idUsuario, $idPost)
    {
        $db = new DB();

        try {
            $db->insert('curtidas', 'id_post, id_usuario', "'" . $idPost . "', '" . $idUsuario . "'");
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function excluirCurtidas($idPost)
    {
        $db = new DB();

        try {
            $db->delete('curtidas', "id_post = '" . $idPost . "'");
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function descurtir($idUsuario, $idPost)
    {
        $db = new DB();

        try {
            $db->delete('curtidas', "id_post = '" . $idPost . "' AND id_usuario = '" . $idUsuario . "'");
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function check($idPost, $idUsuario)
    {
        $db = new DB();

        try {
            $query = $db->query("SELECT 
                            CASE WHEN EXISTS (SELECT id FROM curtidas c 
                                                WHERE c.id_post = '" . $idPost . "' 
                                                AND c.id_usuario = '" . $idUsuario . "')
                            THEN 'TRUE' 
                            ELSE 'FALSE'
                            END AS foi_curtido
                        FROM curtidas");
            return $query->fetchAll()[0]['foi_curtido'] == 'TRUE';
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }

    public static function qtdCurtidas($idPost)
    {
        $db = new DB();

        try {
            $query = $db->query("SELECT 
                                    COUNT(*) AS total
                                    FROM curtidas c
                                    WHERE c.id_post = '" . $idPost . "' ");
            return $query->fetchAll()[0]['total'];
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }
}
