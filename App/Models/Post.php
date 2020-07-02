<?php

namespace App\Models;

use App\Lib\DB;
use Exception;

class Post
{

    public static function novo($data)  {
        try {

            $db = new DB();

            $date = date('Y-m-d H:i:s');

            $db->insert('posts',
                "id_usuario,
                titulo,
                texto,
                data_hora", "'".$data['id_usuario']."',
                '".$data['titulo']."',
                '".$data['texto']."',
                '".$date."'"
            );
            // TODO: ROTA DINAMICA
            // header("Location: https://app-pesquisadores.herokuapp.com/principal");
            // header("Location: http://localhost/principal");
            return true;
            
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public static function mostrar($idPost){
        try{
            $db = new DB();
            $query = $db->query("SELECT * FROM posts WHERE id = '".$idPost."'");
            return $query->fetchAll();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public static function feed($idUsuario) {
        $db = new DB();

        try {
            $query = $db->query(
                "SELECT p.id, p.titulo, p.data_hora, p.texto, u.nome, p.id_usuario, u.foto_perfil
                 FROM posts p
                 LEFT JOIN usuarios u ON u.id = p.id_usuario
                 WHERE p.id_usuario IN 
                    (SELECT s.id_seguindo 
                     FROM seguidores s 
                     WHERE s.id_seguidor = '".$idUsuario."') 
                 OR p.id_usuario = '".$idUsuario."'
                 ORDER BY data_hora DESC"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function todos($idUsuario) {
        $db = new DB();

        try {

            $query = $db->query(
                "SELECT p.id, p.titulo, p.data_hora, p.texto, u.nome, p.id_usuario, u.foto_perfil
                    FROM posts p LEFT JOIN usuarios u ON u.id = p.id_usuario 
                    WHERE p.id_usuario = '".$idUsuario."'
                    ORDER BY data_hora DESC"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function excluir($idPost){
        $db = new DB();

        try {
            $db->delete('posts', "id = '".$idPost."'" );
            return "id = '".$idPost."'";
        } catch (Exception $e){
            echo $e->getMessage();
            return $e->getMessage();
        }
    }

    public static function editar($idPost, $titulo, $texto){
        $db = new DB();

        try{
            $db->update('posts', "titulo = '".$titulo."', texto = '".$texto."'", "id = '".$idPost."'");
            return true;
        } catch (Exception $e){
            return json_encode($e->getMessage());
        }
    }

}