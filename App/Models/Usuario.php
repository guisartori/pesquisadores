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
        $senha = $data['senha'];
        // $senha      = Util::hash($data['senha']);

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

            $nome = $data['titulo'];
            $senha      = Util::hash($data['senha']);
            $email    = $data['email'];
            $data_nascimento = $data['data_nascimento'];
            $inicio_trabalho = $data['inicio_trabalho'];
            $cidade = $data['cidade'];
            // $salario = $data['salario'];
            $estado = $data['estado'];
            $profissao = $data['profissao'];
            $tipo = $data['tipo'];
            $numero_cartao = $data['numero_cartao'];
            $nome_cartao = $data['nome_cartao'];
            $data_validade_cartao = $data['data_validade_cartao'];
            $cvc_cartao = $data['cvc_cartao'];
            $nivel_instrucao = $data['nivel_instrucao'];

            $db->insert('usuario',
                        "titulo,senha,email,data_nascimento,inicio_trabalho,cidade,estado,profissao,tipo,numero_cartao,nome_cartao,data_validade_cartao,cvc_cartao,nivel_instrucao",
                        "'".$nome."','".$senha."', '".$email."', '".$data_nascimento."', '".$inicio_trabalho."', '".$cidade."', '".$estado."', '".$profissao."', '".$tipo."', '".$numero_cartao."', '".$nome_cartao."', '".$data_validade_cartao."', '".$cvc_cartao."', '".$nivel_instrucao."'"
            );

            $query = $db->query(
                "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'"
            );

            return $query->fetch();

        }catch (\Exception $e){
            echo $e->getMessage();

        }

    }

    public static function listar($id=null) {
        $db = new DB();

        try {

            if($id) {
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM usuarios WHERE id = $id"
                );

                return $query->fetch();
            }else{
                // Faz a consulta
                $query = $db->query(
                    'SELECT * FROM usuarios ORDER BY usuario'
                );

                return $query->fetchAll();

            }
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


    //TODO COLOCAR DENTRO DE MODEL FORMACAO
    public static function salvarEducacao($data)  {
        try {

            $db = new DB();

            $titulo = $data['titulo'];
            $idUsuario = $data['id_usuario'];
            $anoInicio = $data['ano_inicio'];
            $anoFim = $data['ano_fim'];
            $texto = $data['texto'];

            $db->insert('educacao',
                "id_usuario,titulo,ano_inicio,ano_fim,texto",
                "'".$idUsuario."','".$titulo."','".$anoInicio."','".$anoFim."','".$texto."'"
            );

            header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");

        }catch (\Exception $e){
            echo $e->getMessage();

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


    //TODO COLOCAR DENTRO DE MODEL HABILIDADE
    public static function salvarHabilidade($data)  {
        try {

            $db = new DB();

            $habilidade = $data['habilidade'];
            $idUsuario    = $data['id_usuario'];

            $db->insert('habilidades',
                "id_usuario,habilidade",
                "'".$idUsuario."','".$habilidade."'"
            );

            //TODO: ROTA DINAMICA 
            // header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");
            header("Location: localhost/perfil/editar");

        }catch (\Exception $e){
            echo $e->getMessage();

        }
    }

    
    public static function listarVisaoG($id=null) {
        $db = new DB();

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        try {

            if($id) {
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM visaoGeral WHERE id_usuario = '".$id."' ORDER BY id DESC"
                );

                return $query->fetch();
            }else{
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM visaoGeral WHERE id_usuario = '".$idUsuario."' ORDER BY id DESC"
                );

                return $query->fetchAll();

            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function listarEducacao($id=null) {
        $db = new DB();

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        try {

            if($id) {
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM educacao WHERE id_usuario = '".$id."' ORDER BY id DESC"
                );

                return $query->fetch();
            }else{
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM educacao WHERE id_usuario = '".$idUsuario."' ORDER BY id DESC"
                );

                return $query->fetchAll();

            }
        }catch (Exception $e){
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

    public static function listarHabilidades($id=null) {
        $db = new DB();

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        try {

            if($id) {
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM habilidades WHERE id_usuario = '".$id."' ORDER BY id DESC"
                );

                return $query->fetchAll();
            }else{
                // Faz a consulta
                $query = $db->query(
                    "SELECT * FROM habilidades WHERE id_usuario = '".$idUsuario."' ORDER BY id DESC"
                );

                return $query->fetchAll();

            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    

    public static function listarFoto($id=null) {
        $db = new DB();

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        try {

            if($id) {
                // Faz a consulta
                $query = $db->query(
                    "SELECT img FROM imgPerfil WHERE usuario = '".$id."' ORDER BY id DESC LIMIT 1"
                );

                return $query->fetch();
            }else{
                // Faz a consulta
                $query = $db->query(
                    "SELECT img FROM imgPerfil WHERE id_usuario = '".$idUsuario."' ORDER BY id DESC LIMIT 1"
                );

                return $query->fetchAll();

            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

    public static function listarCapa($id=null) {
        $db = new DB();

        $idUsuario =  \App\Lib\Auth::usuario()->id;

        try {

            if($id) {
                // Faz a consulta
                $query = $db->query(
                    "SELECT profile_image FROM capaPerfil WHERE id_usuario = '".$id."' ORDER BY id DESC LIMIT 1"
                );

                return $query->fetch();
            }else{
                // Faz a consulta
                $query = $db->query(
                    "SELECT profile_image FROM capaPerfil WHERE id_usuario = '".$idUsuario."' ORDER BY id DESC LIMIT 1"
                );

                return $query->fetchAll();

            }
        }catch (Exception $e){
            echo $e->getMessage();
        }

    }


}