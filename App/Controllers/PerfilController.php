<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Post;
use App\Models\Experiencia;
use App\Models\Formacao;
use App\Models\Habilidade;
use App\Models\Notificacao;
use App\Models\Seguidor;
use App\Models\Topico;

class PerfilController extends Controller
{
    private $app;
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index()
    {
        $idUsuario =  \App\Lib\Auth::usuario()->id;

        self::setViewParam('nameController', $this->app->getNameController());

        $usuario = Usuario::mostrar($idUsuario);

        $posts = Post::todos($idUsuario);
        self::setViewParam('posts', $posts);

        $oListaExperiencia = Experiencia::todos($idUsuario);
        $oListaEducacao = Formacao::todos($idUsuario);
        $oListaHabilidades = Habilidade::todos($idUsuario);
        $topicos = Topico::getTopicosInteressado($idUsuario);
        $notificacoes = Notificacao::ultimasDez($idUsuario);

        self::setViewParam('usuario', $usuario);
        self::setViewParam('aListaExperiencia', $oListaExperiencia);
        self::setViewParam('aListaEducacao', $oListaEducacao);
        self::setViewParam('aListaHabilidades', $oListaHabilidades);
        self::setViewParam('topicos', $topicos);
        self::setViewParam('notificacoes', $notificacoes);

        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/funcoes/curtidasEcomentarios.js');
        self::setViewJs('/public/js/perfil/perfil.js');
        self::setViewJs('/public/js/perfil/perfil-amigo.js');

        $this->render('perfil/index');
    }

    public function editar()
    {

        $idUsuario =  \App\Lib\Auth::usuario()->id;
        self::setViewParam('nameController', $this->app->getNameController());

        $oUsuario = Usuario::mostrar($idUsuario)[0];
        $oListaExperiencia = Experiencia::todos($idUsuario);
        $oListaEducacao = Formacao::todos($idUsuario);
        $oListaHabilidades = Habilidade::todos($idUsuario);
        $topicos = Topico::todos();
        $notificacoes = Notificacao::ultimasDez($idUsuario);

        self::setViewParam('aUsuario', $oUsuario);
        self::setViewParam('aListaExperiencia', $oListaExperiencia);
        self::setViewParam('aListaEducacao', $oListaEducacao);
        self::setViewParam('aListaHabilidades', $oListaHabilidades);
        self::setViewParam('topicos', $topicos);
        self::setViewParam('notificacoes', $notificacoes);

        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/jquery.mask.min.js');
        self::setViewJs('/public/js/perfil/editar.js');

        $this->render('perfil/editar');
    }

    public function uploadCapaPerfil()
    {
        // echo "opa";
        $idUsuario = $_POST['usuario'];
        $nomeImagemUpload = time() . '_' . $_FILES['save-foto-capa']['name'];
        $target = 'public/uploads/capa/' . $nomeImagemUpload;

        if (move_uploaded_file($_FILES['save-foto-capa']['tmp_name'], $target)) {

            Usuario::inserirFotoCapa($target, $idUsuario);
            $this->redirect('perfil/editar');
        } else {
            echo "erro";
            // $this->render('error/usuario');
        }
    }

    public function uploadFoto()
    {

        $idUsuario = $_POST['usuario'];
        $nomeImagemUpload = time() . '_' . $_FILES['save-foto-user']['name'];
        $target = 'public/uploads/fotoPerfil/' . $nomeImagemUpload;

        if (move_uploaded_file($_FILES['save-foto-user']['tmp_name'], $target)) {

            Usuario::inserirFotoPerfil($target, $idUsuario);
            $this->redirect('perfil/editar/');
        } else {
            $this->render('error/usuario');
        }
    }

    public function removerFotoPerfil()
    {
        $idUsuario = $_POST['idUsuario'];

        Usuario::removerFotoPerfil($idUsuario);
    }

    public function removerFotoCapa()
    {
        $idUsuario = $_POST['idUsuario'];

        Usuario::removerFotoCapa($idUsuario);
    }

    //TODO DAQUI PRA BAIXO REVISAR

    public function atualizarInformacoes()
    {
        $nome = $_POST['nome'];
        $profissao = $_POST['profissao'];
        $idUser = $_POST['idUser'];
        $email = $_POST['email'];
        $dataNasc = $_POST['dataNasc'];
        $salario = $_POST['salario'];
        $inicio = $_POST['inicio'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $instrucao = $_POST['instrucao'];

        $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

        $sql2 = "UPDATE usuario SET titulo = '" . $nome . "', profissao = '" . $profissao . "', email = '" . $email . "', data_nascimento = '" . $dataNasc . "', inicio_trabalho = '" . $inicio . "', cidade = '" . $cidade . "', estado = '" . $estado . "', salario = '" . $salario . "', nivel_instrucao = '" . $instrucao . "' WHERE id = '$idUser'";
        if (mysqli_query($conn, $sql2)) {
            $this->redirect('perfil/editar/');
        } else {
            $this->render('error/usuario');
        }
    }

    public function getInformacoesPerfil()
    {
        if (isset($_POST['idUser'])) {

            $idUser = $_POST['idUser'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT * FROM usuario WHERE id = '$idUser' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('titulo' => $row['titulo'], 'profissao' => $row['profissao'], 'email' => $row['email'], 'dataNasc' => $row['data_nascimento'], 'inicio' => $row['inicio_trabalho'], 'cidade' => $row['cidade'], 'estado' => $row['estado'], 'instrucao' => $row['nivel_instrucao'], 'salario' => $row['salario']));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function inserirVisaoGeral()
    {
        $visao = $_POST['textar'];
        $idUser = $_POST['idUser'];

        $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

        $sql = "INSERT INTO visaoGeral (id_usuario, visao) VALUES ('$idUser', '$visao')";
        if (mysqli_query($conn, $sql)) {
            $this->redirect('perfil/editar/');
        } else {
            $this->render('error/usuario');
        }
    }

    public function salvarVaga()
    {

        if ($_FILES['arquivo']['name'] != NULL) {

            $nomeUpload = time() . '_' . $_FILES['arquivo']['name'];
            $target = 'public/uploads/arquivos/' . $nomeUpload;

            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $target)) {
                $_POST['endereco_arquivo'] = $target;
            } else {
                $this->render('error/usuario');
            }
        }
        if (Post::novo($_POST)) {
            $usuario = Usuario::mostrar($_POST['id_usuario'])[0];
            $seguidores = Seguidor::getSeguidores($_POST['id_usuario']);
            foreach ($seguidores as $seguidor) {
                NotificacaoController::novoPostDeAmigoSeguido($usuario['nome'], $_POST['titulo'], $seguidor['id']);
            }
            header("Location: http://localhost/principal");
        }

        $this->render('error/usuario');
    }

    public function buscarUsuario()
    {

        $resultado = Usuario::buscar($_POST['query']);

        echo $resultado;
    }

    public function recomendarPerfil()
    {
        if (isset($_POST['idUser']) && isset($_POST['idPerfil'])) {

            $idUser = $_POST['idUser'];
            $idPerfil = $_POST['idPerfil'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "INSERT INTO recomendacoes (id_amigo, id_pessoal) VALUES ('$idPerfil', '$idUser')";
            if (mysqli_query($conn, $sql)) {
                $result = mysqli_query($conn, "SELECT * FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser' LIMIT 1");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        header('Content-Type: application/json');
                        echo json_encode(array('curtiu' => '1'));
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('curtiu' => '0'));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function removerRecomendacao()
    {
        if (isset($_POST['idUser']) && isset($_POST['idPerfil'])) {

            $idUser = $_POST['idUser'];
            $idPerfil = $_POST['idPerfil'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "DELETE FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser'";
            if (mysqli_query($conn, $sql)) {
                $result = mysqli_query($conn, "SELECT * FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser' LIMIT 1");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        header('Content-Type: application/json');
                        echo json_encode(array('curtiu' => '1'));
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('curtiu' => '0'));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function getLikes()
    {
        if (isset($_POST['idPerfil'])) {

            $idPerfil = $_POST['idPerfil'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT COUNT(*) FROM recomendacoes WHERE id_amigo = '$idPerfil'");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('qtdRecomendacoes' => $row['COUNT(*)']));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function verificarRecomendacao()
    {
        if (isset($_POST['idPerfil']) && isset($_POST['idUser'])) {

            $idPerfil = $_POST['idPerfil'];
            $idUser = $_POST['idUser'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT * FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser' LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('curtiu' => '1'));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('curtiu' => '0'));
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function excluirVaga()
    {
        if (isset($_POST['idUser']) && isset($_POST['idVaga'])) {

            $idUser = $_POST['idUser'];
            $idVaga = $_POST['idVaga'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "DELETE FROM vaga WHERE id = '$idVaga' AND id_usuario = '$idUser'";
            if (mysqli_query($conn, $sql)) {
                $this->redirect('principal/');
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function editarVaga()
    {
        if (isset($_POST['idVaga']) && isset($_POST['titulo']) && isset($_POST['categoria']) && isset($_POST['habilidade']) && isset($_POST['preco']) && isset($_POST['integral']) && isset($_POST['descricao']) && isset($_POST['idUser'])) {

            $idUser = $_POST['idUser'];
            $idVaga = $_POST['idVaga'];
            $titulo = $_POST['titulo'];
            $categoria = $_POST['categoria'];
            $habilidade = $_POST['habilidade'];
            $preco = $_POST['preco'];
            $integral = $_POST['integral'];
            $descricao = $_POST['descricao'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "UPDATE vaga SET titulo = '" . $titulo . "', categoria = '" . $categoria . "', habilidade = '" . $habilidade . "', preco = '" . $preco . "', integral = '" . $integral . "', descricao = '" . $descricao . "' WHERE id = '$idVaga' AND id_usuario = '$idUser'";
            if (mysqli_query($conn, $sql)) {
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }
}
