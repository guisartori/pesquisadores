<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

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

            return true;
            
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public static function deletar($idFormacao){
        $db = new DB();

        try{
            $db->delete('formacoes', "id = '".$idFormacao."'");
            return true;
        } catch(Exception $e){
            return $e->getMessage();
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