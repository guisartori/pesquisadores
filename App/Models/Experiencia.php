<?php

namespace App\Models;

use App\Lib\DB;

class Experiencia
{

    public static function novo($data)  {
        try {

            $db = new DB();

            $db->insert('experiencias',
                "id_usuario,
                titulo,
                texto", "'".$data['id_usuario']."',
                '".$data['titulo']."',
                '".$data['texto']."'"
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
                "SELECT e.id, e.titulo, e.texto
                    FROM experiencias e
                    WHERE e.id_usuario = '". $idUsuario ."'
                    ORDER BY id DESC"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

}