<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

class Comentario
{

    public static function novo($texto, $dataHora, $idPost, $idUsuario)
    {
        $db = new DB();

        try {
            $db->insert(
                'comentarios',
                'texto, data_hora, id_post, id_usuario',
                "'" . $texto . "', '" . $dataHora . "', '" . $idPost . "', '" . $idUsuario . "'"
            );
            return true;
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }

    public static function excluirComentarios($idPost)
    {
        $db = new DB();

        try {
            $db->delete('comentarios', "id_post = '" . $idPost . "'");
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function todos($idPost)
    {
        $db = new DB();

        $result = $db->query("SELECT * FROM comentarios c
                            LEFT JOIN usuarios u 
                            ON u.id = c.id_usuario
                            WHERE c.id_post = '" . $idPost . "'");

        return $result->fetchAll();
    }
}
