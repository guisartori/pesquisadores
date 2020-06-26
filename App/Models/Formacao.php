<?php

namespace App\Models;

use App\Lib\DB;

class Formacao
{

    public static function novo($data)  {
        try {

            $db = new DB();

            $db->insert('formacoes',
                "id_usuario,
                titulo,
                texto,
                ano_inicio,
                ano_fim", "'".$data['id_usuario']."',
                '".$data['titulo']."',
                '".$data['texto']."',
                '".$data['ano_inicio']."',
                '".$data['ano_fim']."'"
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
                "SELECT f.id, f.titulo, f.texto, f.ano_inicio, f.ano_fim
                    FROM formacoes f
                    WHERE f.id_usuario = '". $idUsuario ."'
                    ORDER BY id DESC"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

}