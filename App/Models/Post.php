<?php

namespace App\Models;

use App\Lib\DB;

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
            header("Location: http://localhost/principal");
            
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public static function feed($idUsuario) {
        $db = new DB();

        //TODO: FAZER APARECER A POSTAGEM APENAS DE QUEM PUBLICOU E DE SEUS AMIGOS. ORDENAR POR DATA
        try {
            $query = $db->query(
                "SELECT * FROM usuarios u 
                 LEFT JOIN seguidores s ON u.id = s.id_seguidor 
                 LEFT JOIN usuarios uu ON s.id_seguindo = uu.id
                 LEFT JOIN posts p ON p.id_usuario = u.id OR p.id_usuario = uu.id
                 WHERE u.id = '".$idUsuario."'
                 ORDER BY data_hora DESC"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function todos($idUsuario) {
        $db = new DB();

        //TODO: FAZER APARECER A POSTAGEM APENAS DE QUEM PUBLICOU E DE SEUS AMIGOS. ORDENAR POR DATA
        try {

            $query = $db->query(
                "SELECT p.id, p.titulo, p.data_hora, p.texto, u.nome 
                    FROM posts p LEFT JOIN usuarios u ON u.id = p.id_usuario 
                    WHERE p.id_usuario = '".$idUsuario."'
                    ORDER BY data_hora DESC"
            );
            return $query->fetchAll();
        
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

}