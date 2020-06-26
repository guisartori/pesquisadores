<?php

namespace App\Models;

use App\Lib\DB;

class Habilidade
{

    public static function novo($data)  {
        try {

            $db = new DB();

            $db->insert('habilidades',
                "id_usuario,
                nome", "'".$data['id_usuario']."',
                '".$data['nome']."'"
            );
            // TODO: ROTA DINAMICA
            // header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");
            header("Location: http://localhost/perfil/editar");
            
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public static function todos($idUsuario) {
        $db = new DB();

        try {

            $query = $db->query(
                "SELECT h.id, h.nome
                    FROM habilidades h
                    WHERE h.id_usuario = '". $idUsuario ."'
                    ORDER BY id DESC"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

}