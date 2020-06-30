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
            $nivel_instrucao = $data['nivel_instrucao'];

            $db->insert('usuarios',
                        "nome,
                        senha,
                        email,
                        data_nascimento,
                        inicio_trabalho,
                        cidade,
                        cpf,
                        estado,
                        profissao,
                        tipo,
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

    //TODO: ACERTAR MÉTODO
    public static function atualizar($data)  {
        try {
            $db = new DB();

            $id = $data['id'];

            $data['senha'] = base64_encode($data['senha']);

        //     $db->update('usuario',
        //         "usuario = '".$data['usuario']."',senha = '".$data['senha']."',
        //          perfil = '".$data['perfil']."' 
        //          WHERE id = $id");

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

}