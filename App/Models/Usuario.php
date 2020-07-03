<?php

namespace App\Models;

use App\Lib\DB;
use App\Lib\Util;
use Exception;

class Usuario
{
    public static function logar($data) {
        $db = new DB();

        $email    = $data['email'];
        $senha      = Util::hash($data['senha']);

        try {
            $query = $db->query(
                "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'"
            );
            return $query->fetch();
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function buscar($query){
        $db = new DB();

        try {
            $query = $db->query(
                "SELECT DISTINCT * FROM usuarios u
                LEFT JOIN formacoes f
                ON f.id_usuario = u.id
                WHERE u.nome LIKE '%".$query."%' 
                OR u.email LIKE '%".$query."%'
                OR f.titulo LIKE '%".$query."%'"
            );

            $usuarios = $query->fetchAll();
            $output = '<ul class="list-unstyled">';
            if(count($usuarios) > 0){
                foreach($usuarios as $usuario){
                    $output .= '<li>
                                    <a href="/usuario/perfil/'.$usuario["id"].'" data-id-search="'.$usuario["id"].'">'
                                        .$usuario["nome"]. '<br/>'
                                        .$usuario['email'].
                                    '</a>
                                </li>';
                }
            } else {
                $output .= '<li>Nenhum usuario encontrado!</li>';
            }
            $output .= '</ul>';
            return $output;

        }catch (Exception $e){
            return $e->getMessage();
        }

    }

    public static function salvar($data)  {
        try {

            $db = new DB();

            $nome = $data['nome'];
            $email = $data['email'];
            $senha = Util::hash($data['senha']);
            $data_nascimento = $data['data_nascimento'];
            $inicio_trabalho = $data['inicio_trabalho'];
            $cidade = $data['cidade'];
            $estado = $data['estado'];
            $cpf = $data['cpf'];
            $profissao = $data['profissao'];
            $tipo = $data['tipo'];
            $urlCL = $data['url'];
            $nivel_instrucao = $data['nivel_instrucao'];

            $db->insert('usuarios',
                        "nome,
                        senha,
                        email,
                        data_nascimento,
                        inicio_trabalho,
                        cidade,
                        estado,
                        cpf,
                        profissao,
                        tipo,
                        url_cl,
                        nivel_instrucao",
                        "'".$nome."',
                        '".$senha."', 
                        '".$email."', 
                        '".$data_nascimento."', 
                        '".$inicio_trabalho."', 
                        '".$cidade."', 
                        '".$estado."', 
                        '".$cpf."', 
                        '".$profissao."', 
                        '".$tipo."', 
                        '".$urlCL."', 
                        '".$nivel_instrucao."'"
            );

            $query = $db->query(
                "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'"
            );

            return $query->fetch();

        }catch (Exception $e){
            echo $e->getMessage();

        }

    }

    public static function mostrar($id) {
        $db = new DB();

        try {
            $query = $db->query(
                "SELECT * FROM usuarios u WHERE u.id = '".$id."'"
            );

            return $query->fetchAll();

        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function seguidores($idUsuario) {
        $db = new DB();

        try {
            $query = $db->query(
                "SELECT * 
                FROM usuarios u 
                LEFT JOIN seguidores s
                ON s.id_seguidor = u.id
                WHERE s.id_seguindo = '".$idUsuario."'"
            );

            return $query->fetchAll();

        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public static function inserirFotoPerfil($target, $idUsuario){
        $db = new DB();
        $db->update('usuarios', "foto_perfil = '/".$target."'", "id = '".$idUsuario."'");
        return true;
    }

    public static function inserirFotoCapa($target, $idUsuario){
        $db = new DB();
        $db->update('usuarios', "foto_capa = '/".$target."'", "id = '".$idUsuario."'");
        return true;
    }

    public static function removerFotoPerfil($idUsuario){
        $db = new DB();
        $db->update('usuarios', "foto_perfil = ''", "id = '".$idUsuario."'");
        return true;
    }

    public static function removerFotoCapa($idUsuario){
        $db = new DB();
        $db->update('usuarios', "foto_capa = ''", "id = '".$idUsuario."'");
        return true;
    }

    public static function atualizar($data)  {
        try {
            $db = new DB();

            $id = $data['id'];

            $db->update('usuarios',
                        "nome = '".$data['nome']."',
                         email = '".$data['email']."',
                         data_nascimento = '".$data['data_nascimento']."',
                         profissao = '".$data['profissao']."',
                         nivel_instrucao = '".$data['nivel_instrucao']."',
                         inicio_trabalho = '".$data['inicio_trabalho']."',
                         cidade = '".$data['cidade']."',
                         estado = '".$data['estado']."'",
                        "id = $id");
            return true;

        }catch (Exception $e){
            echo $e->getMessage();

        }
    }

    public static function atualizarVisaoGeral($data)  {
        try {
            $db = new DB();

            $id = $data['id'];

            $db->update('usuarios',
                        "visao_geral = '".$data['visao_geral']."'",
                        "id = $id");
            return true;

        }catch (Exception $e){
            echo $e->getMessage();

        }

    }

    public static function excluir($id) {
        try {
            $db = new DB();

            $db->delete('usuario',"id = $id");

        }catch (Exception $e){
            exit($e->getMessage());

        }

    }

    public static function sugestoes($idUsuario){

        $db = new DB();

        $sql = "SELECT * 
        FROM usuarios u 
        WHERE u.id NOT IN 
            (SELECT s.id_seguindo 
            FROM seguidores s 
            WHERE s.id_seguidor = '".$idUsuario."') 
        AND u.id != '".$idUsuario."'
        LIMIT 10";

        try{
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}