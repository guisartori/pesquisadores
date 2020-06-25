<?php

namespace App\Controllers;

use App\Lib\Auth;
use App\Models\Usuario;

class PerfilController extends Controller {
    private $app;
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index() {

        self::setViewParam('nameController',$this->app->getNameController());

        $oListaVaga = Usuario::listarVagas();
        self::setViewParam('aListaVagas',$oListaVaga);

        $oListaExperiencia = Usuario::listarExperiencia();
        $oListaEducacao = Usuario::listarEducacao();
        $oListaLocalizacao = Usuario::listarLocalizacao();
        $oListaHabilidades = Usuario::listarHabilidades();

        self::setViewParam('aListaExperiencia',$oListaExperiencia);
        self::setViewParam('aListaEducacao',$oListaEducacao);
        self::setViewParam('aListaLocalizacao',$oListaLocalizacao);
        self::setViewParam('aListaHabilidades',$oListaHabilidades);

        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/perfil/perfil.js');

        $this->render('perfil/index');

    }

    public function editar() {

        self::setViewParam('nameController',$this->app->getNameController());

        $oListaExperiencia = Usuario::listarExperiencia();
        $oListaEducacao = Usuario::listarEducacao();
        $oListaLocalizacao = Usuario::listarLocalizacao();
        $oListaHabilidades = Usuario::listarHabilidades();

        self::setViewParam('aListaExperiencia',$oListaExperiencia);
        self::setViewParam('aListaEducacao',$oListaEducacao);
        self::setViewParam('aListaLocalizacao',$oListaLocalizacao);
        self::setViewParam('aListaHabilidades',$oListaHabilidades);


        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/perfil/editar.js');

        $this->render('perfil/editar');

    }

    public function uploadCapaPerfil() {
        if(isset($_POST['save-capa'])) {
            $id_user = $_POST['id_user'];
            $nomeImagemUpload = time() . '_' . $_FILES['save-capa-user']['name'];

            $target = 'public/uploads/capa//'.$nomeImagemUpload;

            if (move_uploaded_file($_FILES['save-capa-user']['tmp_name'], $target)) {
                $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
                $sql = "INSERT INTO capaPerfil (id_usuario, profile_image) VALUES ('$id_user', '$nomeImagemUpload')";

                if(mysqli_query($conn, $sql)) {
                    $this->redirect('perfil/editar/');
                }
            } else {
                $this->render('error/usuario');
            }

        }
    }

    public function getCapaPerfil() {
        if(isset($_POST['idUser'])) {

            $idUser = $_POST['idUser'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT * FROM capaPerfil WHERE id_usuario = '$idUser' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('src'=> $row['profile_image']));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('src' => 'capa-default.png'));
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function getFotoPerfil() {
        if(isset($_POST['idUser'])) {

            $idUser = $_POST['idUser'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT * FROM imgPerfil WHERE usuario = '$idUser' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('src'=> $row['img']));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('src' => 'profile-default.png'));
            }
        } else {
            $this->render('error/usuario');
        }
    }



    public function uploadFoto() {

        $id_user = $_POST['usuario'];
        $nomeImagemUpload = time() . '_' . $_FILES['save-foto-user']['name'];

        $target = 'public/uploads/fotoPerfil//'.$nomeImagemUpload;

        if (move_uploaded_file($_FILES['save-foto-user']['tmp_name'], $target)) {
            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            $sql = "INSERT INTO imgPerfil (usuario, img) VALUES ('$id_user', '$nomeImagemUpload')";

            if(mysqli_query($conn, $sql)) {
                $this->redirect('perfil/editar/');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function atualizarInformacoes() {
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

        $sql2 = "UPDATE usuario SET titulo = '".$nome."', profissao = '".$profissao."', email = '".$email."', data_nascimento = '".$dataNasc."', inicio_trabalho = '".$inicio."', cidade = '".$cidade."', estado = '".$estado."', salario = '".$salario."', nivel_instrucao = '".$instrucao."' WHERE id = '$idUser'";
        if(mysqli_query($conn, $sql2)) {
            $this->redirect('perfil/editar/');
        } else {
            $this->render('error/usuario');
        }
    }

    public function getInformacoesPerfil() {
        if(isset($_POST['idUser'])) {

            $idUser = $_POST['idUser'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT * FROM usuario WHERE id = '$idUser' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('titulo'=> $row['titulo'], 'profissao'=> $row['profissao'], 'email'=> $row['email'], 'dataNasc'=> $row['data_nascimento'], 'inicio'=> $row['inicio_trabalho'], 'cidade'=> $row['cidade'], 'estado'=> $row['estado'], 'instrucao'=> $row['nivel_instrucao'], 'salario' => $row['salario']));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function inserirVisaoGeral() {
        $visao = $_POST['textar'];
        $idUser = $_POST['idUser'];

        $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

        $sql = "INSERT INTO visaoGeral (id_usuario, visao) VALUES ('$idUser', '$visao')";
        if(mysqli_query($conn, $sql)) {
            $this->redirect('perfil/editar/');
        } else {
            $this->render('error/usuario');
        }
    }

    public function getVisao() {
        if(isset($_POST['idUser'])) {

            $idUser = $_POST['idUser'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT * FROM visaoGeral WHERE id_usuario = '$idUser' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('visao'=> $row['visao']));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function salvarExperiencia() {
        if($oUser = Usuario::salvarExperiencia($_POST)){

            header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");
            $this->render('perfil/editar');
        }

        $this->render('error/usuario');
    }

    public function salvarEducacao() {
        if($oUser = Usuario::salvarEducacao($_POST)){

            header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");
            $this->render('perfil/editar');
        }

        $this->render('error/usuario');
    }

    public function salvarLocalizacao() {
        if($oUser = Usuario::salvarLocalizacao($_POST)){

            header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");
            $this->render('perfil/editar');
        }

        $this->render('error/usuario');
    }

    public function salvarHabilidade() {
        if($oUser = Usuario::salvarHabilidade($_POST)){

            header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");
            $this->render('perfil/editar');
        }

        $this->render('error/usuario');
    }

    public function salvarVaga() {
        if($oUser = Usuario::salvarVaga($_POST)){

            header("Location: https://app-pesquisadores.herokuapp.com/perfil/editar");
            $this->render('perfil/editar');
        }

        $this->render('error/usuario');
    }

    public function buscarUsuario() {
        $connect = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
        if(isset($_POST["query"]))
        {
            $output = '';
            $query = "SELECT * FROM usuario WHERE titulo LIKE '%".$_POST["query"]."%'";
            $result = mysqli_query($connect, $query);
            $output = '<ul class="list-unstyled">';
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result))
                {
                    $output .= '<li><a href="/principal/amigo/'.$row["id"].'" data-id-search="'.$row["id"].'">'.$row["titulo"].'</a></li>';
                }
            }
            else
            {
                $output .= '<li>Nenhum usuario encontrado!</li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function recomendarPerfil() {
        if(isset($_POST['idUser']) && isset($_POST['idPerfil'])) {

            $idUser = $_POST['idUser'];
            $idPerfil = $_POST['idPerfil'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "INSERT INTO recomendacoes (id_amigo, id_pessoal) VALUES ('$idPerfil', '$idUser')";
            if(mysqli_query($conn, $sql)) {
                $result = mysqli_query($conn, "SELECT * FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser' LIMIT 1");
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        header('Content-Type: application/json');
                        echo json_encode(array('curtiu'=> '1'));
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('curtiu'=> '0'));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function removerRecomendacao() {
        if(isset($_POST['idUser']) && isset($_POST['idPerfil'])) {

            $idUser = $_POST['idUser'];
            $idPerfil = $_POST['idPerfil'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "DELETE FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser'";
            if(mysqli_query($conn, $sql)) {
                $result = mysqli_query($conn, "SELECT * FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser' LIMIT 1");
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        header('Content-Type: application/json');
                        echo json_encode(array('curtiu'=> '1'));
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(array('curtiu'=> '0'));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function getLikes() {
        if(isset($_POST['idPerfil'])) {

            $idPerfil = $_POST['idPerfil'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT COUNT(*) FROM recomendacoes WHERE id_amigo = '$idPerfil'");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('qtdRecomendacoes'=> $row['COUNT(*)']));
                }
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function verificarRecomendacao() {
        if(isset($_POST['idPerfil']) && isset($_POST['idUser'])) {

            $idPerfil = $_POST['idPerfil'];
            $idUser = $_POST['idUser'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $result = mysqli_query($conn, "SELECT * FROM recomendacoes WHERE id_amigo = '$idPerfil' AND id_pessoal = '$idUser' LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('curtiu'=> '1'));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('curtiu'=> '0'));
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function excluirVaga() {
        if(isset($_POST['idUser']) && isset($_POST['idVaga'])) {

            $idUser = $_POST['idUser'];
            $idVaga = $_POST['idVaga'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "DELETE FROM vaga WHERE id = '$idVaga' AND id_usuario = '$idUser'";
            if(mysqli_query($conn, $sql)) {
                $this->redirect('principal/');
            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function editarVaga() {
        if(isset($_POST['idVaga']) && isset($_POST['titulo']) && isset($_POST['categoria']) && isset($_POST['habilidade']) && isset($_POST['preco']) && isset($_POST['integral']) && isset($_POST['descricao']) && isset($_POST['idUser'])) {

            $idUser = $_POST['idUser'];
            $idVaga = $_POST['idVaga'];
            $titulo = $_POST['titulo'];
            $categoria = $_POST['categoria'];
            $habilidade = $_POST['habilidade'];
            $preco = $_POST['preco'];
            $integral = $_POST['integral'];
            $descricao = $_POST['descricao'];

            $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");

            $sql = "UPDATE vaga SET titulo = '".$titulo."', categoria = '".$categoria."', habilidade = '".$habilidade."', preco = '".$preco."', integral = '".$integral."', descricao = '".$descricao."' WHERE id = '$idVaga' AND id_usuario = '$idUser'";
            if(mysqli_query($conn, $sql)) {

            } else {
                $this->render('error/usuario');
            }
        } else {
            $this->render('error/usuario');
        }
    }

}