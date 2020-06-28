<?php

namespace App\Models;

use App\Lib\DB;
use App\Lib\Util;

class Usuario
{
    public static function logar($data)
    {
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
                        '".$profissao."', 
                        '".$tipo."', 
                        '".$nivel_instrucao."'"
            );

            $query = $db->query(
                "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'"
            );

            return $query->fetch();

        }catch (\Exception $e){
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

    public static function atualizar($data)
    {
        try {
            $db = new DB();

            $id = $data['id'];

            $data['senha'] = base64_encode($data['senha']);

            $db->update('usuario',
                "usuario = '".$data['usuario']."',senha = '".$data['senha']."',
                 perfil = '".$data['perfil']."' 
                 WHERE id = $id");

        }catch (Exception $e){
            echo $e->getMessage();

        }

    }

    public static function excluir($id)
    {
        try {
            $db = new DB();

            $db->delete('usuario',"id = $id");

        }catch (Exception $e){
            exit($e->getMessage());

        }

    }


    //TODO POSSIVELMENTE REMOVER
    public static function salvarLocalizacao($data)  {
        try {

            $db = new DB();

            $titulo = $data['titulo'];
            $texto = $data['texto'];
            $idUsuario    = $data['id_usuario'];

            $db->insert('localizacao',
                "id_usuario,titulo,texto",
                "'".$idUsuario."','".$titulo."','".$texto."'"
            );

            header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");

        }catch (\Exception $e){
            echo $e->getMessage();

        }
    }


    public static function listarLocalizacao($id=null) {
        $db = new DB();

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        try {

            if($id) {
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM localizacao WHERE id_usuario = '".$id."' ORDER BY id DESC"
                );

                return $query->fetch();
            }else{
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM localizacao WHERE id_usuario = '".$idUsuario."' ORDER BY id DESC"
                );

                return $query->fetchAll();

            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

}