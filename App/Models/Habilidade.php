<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

class Habilidade
{

    public static function novo($data)
    {
        try {

            $db = new DB();

            $db->insert(
                'habilidades',
                "id_usuario,
                nome",
                "'" . $data['id_usuario'] . "',
                '" . $data['nome'] . "'"
            );
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function todos($idUsuario)
    {
        $db = new DB();

        try {

            $query = $db->query(
                "SELECT h.id, h.nome
                    FROM habilidades h
                    WHERE h.id_usuario = '" . $idUsuario . "'
                    ORDER BY id DESC"
            );
            return $query->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function deletar($idHabilidade)
    {
        $db = new DB();

        try {
            $db->delete('habilidades', "id = '" . $idHabilidade . "'");
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
