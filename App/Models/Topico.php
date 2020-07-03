<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

class Topico {
    public static function todos(){
        $db = new DB();
        try{
            $query = $db->query("SELECT * FROM topicos");
            return $query->fetchAll();
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public static function add($idUsuario, $idTopico){
        $db = new DB();
        try{
            $db->insert('usuarios_topicos', 'id_usuario, id_topico', "'".$idUsuario."', '".$idTopico."'");
            return true;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public static function remove($idUsuario, $idTopico){
        $db = new DB();
        try{
            $db->delete('usuarios_topicos', "id_usuario = '".$idUsuario."' AND id_topico = '".$idTopico."'");
            return true;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }

    public static function verificaInteresse($idUsuario, $idTopico){
        $db = new DB();

        try{
            $query = $db->query("SELECT 
                            CASE WHEN EXISTS (SELECT id FROM usuarios_topicos ut 
                                                WHERE ut.id_usuario = '".$idUsuario."' 
                                                AND ut.id_topico = '".$idTopico."')
                            THEN 'TRUE' 
                            ELSE 'FALSE'
                            END AS interesse
                        FROM usuarios_topicos");
            return $query->fetchAll()[0]['interesse'] == 'TRUE';
        } catch (Exception $e){
            return json_encode($e->getMessage());
        }
    }

    public static function getTopicosInteressado($idUsuario){
        $db = new DB();
        try{
            $query = $db->query("SELECT t.nome
                                FROM topicos t 
                                LEFT JOIN usuarios_topicos ut
                                ON ut.id_topico = t.id
                                WHERE ut.id_usuario = '".$idUsuario."'");
            return $query->fetchAll();
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
}