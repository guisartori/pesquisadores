<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Post;

class PrincipalController extends Controller {
    private $app;
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function index() {

        self::setViewParam('nameController',$this->app->getNameController());

        $oListaVaga = Post::feed();
        self::setViewParam('aListaVagas',$oListaVaga);

        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/funcoes/curtidasEcomentarios.js');

        $this->render('principal/index');

    }

    public function getSugestoes() {
        if(isset($_POST['idProprio'])) {
            $idLogado = $_POST['idProprio'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "SELECT * FROM usuario WHERE usuario.id NOT IN (SELECT id_solicitante
                FROM amizade WHERE id_requisitado = '$idLogado')
                AND usuario.id NOT IN (SELECT amizade.id_requisitado 
                FROM amizade WHERE amizade.id_solicitante = '$idLogado') 
                AND usuario.id != '$idLogado' LIMIT 6");

            while($row = mysqli_fetch_assoc($result)) {
                $row["listagem"] = "
                    <div class='suggestions-list' data-id-user-list='".$row['id']."'>
                        <div class='suggestion-usd'>
                            <img src='http://via.placeholder.com/35x35' alt='".$row['titulo']."'>
                            <div class='sgt-text' style='white-space: nowrap;width: 150px;overflow: hidden;text-overflow: ellipsis;'>
                                <h4 class='text-capitalize' style='text-align: left !important;'>".$row['titulo']."</h4>
                                <span class='profissao-sidebar text-capitalize'>".$row['profissao']."</span>
                            </div>
                            <span class='add-amigo' data-id-usuario='".$row['id']."' data-nome-usuario='".$row['titulo']."'><i class='la la-plus'></i></span>
                        </div>
                    </div>  
                    ";
                ?>
                <?php
                echo $row["listagem"];
            }
        }
    }

    public function getDadosAmizade() {
        // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
        //TODO: COLOCAR CONEXÃO PADRÃO 
        $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

        $idSolicitante = $_POST['idSolicitante'];
        $idRequisitado = $_POST['idRequisitado'];
        $nome = $_POST['nome'];
        $nomeSolicitante = $_POST['nomeSolicitante'];

        $result = mysqli_query($conn, "INSERT INTO amizade (id_solicitante, id_requisitado, nome_requisitado, nome_solicitado, status) VALUES ('$idSolicitante', '$idRequisitado', '$nome', '$nomeSolicitante', '0')");
    }

    public function getFotoPerfil() {
        if(isset($_POST['idUser'])) {
            $idLogado = $_POST['idUser'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "SELECT * FROM fotoPerfil WHERE id_usuario = '$idLogado' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $row["listagem"] = " ".$row['imagem']." ";
                    ?>
                    <?php
                    header('Content-Type: application/json');
                    echo json_encode(array('foto' => ' '.$row["listagem"].' '));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('foto' => 'profile-default.png'));
            }
        }
    }

    public function getSolicitacoesAmizades() {
        if(isset($_POST['idUser'])) {
            $idLogado = $_POST['idUser'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "SELECT COUNT(*) FROM amizade WHERE id_requisitado = '$idLogado' AND status = 0 LIMIT 999");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $row["listagem"] = " ".$row['COUNT(*)']." ";
                    ?>
                    <?php
                    header('Content-Type: application/json');
                    echo json_encode(array('qtdSolicitacoesAmizade' => ' '.$row["listagem"].' '));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('qtdSolicitacoesAmizade' => '0'));
            }
        }
    }

    public function amigos() {
        self::setViewParam('nameController',$this->app->getNameController());

        self::setViewCss('/public/css/pages/principal/principal.css');
        self::setViewCss('/public/css/pages/principal/amigos.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/principal/amigos.js');

        $this->render('principal/amigos');
    }

    public function listagemSolicitacoesAmizade() {
        if(isset($_POST['idProprio'])) {
            $idLogado = $_POST['idProprio'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "SELECT * FROM amizade WHERE id_requisitado = '$idLogado' AND status = 0");

            while($row = mysqli_fetch_assoc($result)) {
                $row["listagem"] = '
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="company_profile_info">
                        <div class="company-up-info">
                            <img src="/public/uploads/fotoPerfil/profile-default.png" alt="Foto do Usuário Solicitante">
                            <h3>'.$row['nome_solicitado'].'</h3>
                            <h4>Profissão</h4>
                            <ul>
                                <li><a href="#" title="" class="follow aceitar-solicitacao" data-id-usuario-solicitante="'.$row['id_solicitante'].'" data-nome-usuario-solicitante="'.$row['nome_solicitado'].'">+ Seguir de volta</a></li>
                                <li style="visibility: hidden;display: none;"><a href="#" title="" class="hire-us recusar-solicitacao" data-id-usuario-solicitante="'.$row['id_solicitante'].'" data-nome-usuario-solicitante="'.$row['nome_solicitado'].'"><i class="fa fa-times" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <a href="/principal/amigo/'.$row["id_solicitante"].'" data-id-search="'.$row["id_solicitante"].'" title="" class="view-more-pro">Ver Perfil</a>
                    </div>
                </div>    
                ';
                ?>
                <?php
                echo $row["listagem"];
            }
        }
    }

    public function processaAceitacaoAmizade() {
        if(isset($_POST['idAceitado']) && isset($_POST['idLogado'])) {
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            $idAceitado = $_POST['idAceitado'];
            $nomeAceitado = $_POST['nomeAceitado'];
            $idLogado = $_POST['idLogado'];
            $nomeLogado = $_POST['nomeLogado'];

            $result = mysqli_query($conn, "INSERT INTO lista_amigos (id_solicitante, id_requisitado, nome_requisitado, nome_solicitante) VALUES ('$idLogado', '$idAceitado', '$nomeAceitado', '$nomeLogado')");
            $result3 = mysqli_query($conn, "INSERT INTO lista_amigos (id_solicitante, id_requisitado, nome_requisitado, nome_solicitante) VALUES ('$idAceitado', '$idLogado', '$nomeLogado', '$nomeAceitado')");
            $result2 = mysqli_query($conn, "UPDATE amizade SET status = '1' WHERE id_solicitante = '$idAceitado' AND id_requisitado = '$idLogado'");
        }
    }

    public function atualizaStatusAceitacaoAmizade() {
        if(isset($_POST['idAceitado']) && isset($_POST['idLogado'])) {
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            $idAceitado = $_POST['idAceitado'];
            $idLogado = $_POST['idLogado'];

            $result2 = mysqli_query($conn, "UPDATE amizade SET status = 1 WHERE id_solicitante = '$idLogado' AND id_requisitado = '$idAceitado'");
        }
    }

    public function atualizaStatusNegacaoAmizade() {
        if(isset($_POST['idAceitado']) && isset($_POST['idLogado'])) {
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            $idAceitado = $_POST['idAceitado'];
            $idLogado = $_POST['idLogado'];

            $result2 = mysqli_query($conn, "UPDATE amizade SET status = 1 WHERE id_solicitante = '$idLogado' AND id_requisitado = '$idAceitado'");
            $result2 = mysqli_query($conn, "UPDATE amizade SET status = '1' WHERE id_solicitante = '$idAceitado' AND id_requisitado = '$idLogado'");
        }
    }

    public function refreshListagemAmigos() {
        if(isset($_POST['idProprio'])) {
            $idLogado = $_POST['idProprio'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "SELECT * FROM lista_amigos WHERE id_requisitado = '$idLogado'");

            while($row = mysqli_fetch_assoc($result)) {
                $row["listagem"] = '
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="company_profile_info">
                        <div class="company-up-info card-item-amigos">
                            <img src="/public/uploads/fotoPerfil/profile-default.png" alt="Foto do Usuário Solicitante">
                            <h3>'.$row['nome_solicitante'].'</h3>
                            <h4>Profissão</h4>
                        </div>
                        <a href="/principal/amigo/'.$row["id_solicitante"].'" data-id-search="'.$row["id_solicitante"].'" title="" class="view-more-pro">Ver Perfil</a>
                    </div>
                </div>    
                ';
                ?>
                <?php
                echo $row["listagem"];
            }
        }
    }

    public function amigo(){
        self::setViewParam('aAmigo',Usuario::listar($this->app->getParams()[0]));
        self::setViewParam('aFoto',Usuario::listarFoto($this->app->getParams()[0]));
        self::setViewParam('aCapa',Usuario::listarCapa($this->app->getParams()[0]));
        self::setViewParam('aVisao',Usuario::listarVisaoG($this->app->getParams()[0]));
        self::setViewParam('aListaExperiencia',Usuario::listarExperiencia($this->app->getParams()[0]));
        self::setViewParam('aListaEducacao',Usuario::listarEducacao($this->app->getParams()[0]));
        self::setViewParam('aListaLocalizacao',Usuario::listarLocalizacao($this->app->getParams()[0]));
        self::setViewParam('aListaHabilidades',Usuario::listarHabilidades($this->app->getParams()[0]));
        self::setViewParam('aListaVagas',Usuario::listarVagas($this->app->getParams()[0]));


        self::setViewCss('/public/css/pages/principal/principal.css');

        self::setViewJs('/public/js/principal/principal.js');
        self::setViewJs('/public/js/funcoes/listagens/sugestoes.js');
        self::setViewJs('/public/js/perfil/perfil-amigo.js');

        $this->render('principal/amigo');
    }

    public function getDeveriaConhecer() {
        if(isset($_POST['idProprio'])) {
            $idLogado = $_POST['idProprio'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "SELECT * FROM usuario WHERE usuario.id NOT IN (SELECT id_solicitante
                FROM lista_amigos WHERE id_requisitado = '$idLogado')
                AND usuario.id NOT IN (SELECT lista_amigos.id_requisitado 
                FROM lista_amigos WHERE lista_amigos.id_solicitante = '$idLogado') 
                AND usuario.id != '$idLogado' LIMIT 10");

            while($row = mysqli_fetch_assoc($result)) {
                $row["listagem"] = '
                    <div class="user-profy">
                        <img src="/public/uploads/fotoPerfil/profile-default.png" alt="" style="width: 57px;height: 57px;">
                        <h3>'.$row['titulo'].'</h3>
                        <span>'.$row['profissao'].'</span>
                        <ul>
                            <li><a title="Adicionar Amigo" data-id-usuario="'.$row['id'].'" data-nome-usuario="'.$row['titulo'].'"  class="add-amigo btn btn-block btn-success" style="background-color: #8b87aa;border: 1px solid #6153ce;height: 35px;padding-top: 0.22em;padding-left: 1em;padding-right: 1em;font-size: 15px;cursor: pointer;border-radius: 50px;"><i class="la la-plus"></i> Seguir</a></li>
                        </ul>
                        <a href="/principal/amigo/'.$row['id'].'" title="">Visualizar Perfil</a>
                    </div>  
                    ';
                ?>
                <?php
                echo $row["listagem"];
            }
        }
    }

    public function verificaSeEhAmigo() {
        if(isset($_POST['de']) && isset($_POST['para'])) {

            $de = $_POST['de'];
            $para = $_POST['para'];

            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            $result = mysqli_query($conn, "SELECT * FROM amizade WHERE id_solicitante = '$de' AND id_requisitado = '$para' ORDER BY id DESC LIMIT 1");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('amigo'=> '1'));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('amigo'=> '0'));
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function getAmigosEmComum() {
        if(isset($_POST['de']) && isset($_POST['para'])) {
            $de = $_POST['de'];
            $para = $_POST['para'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "select * from amizade where id_solicitante = '$para' and id_requisitado in( select id_requisitado from amizade where id_solicitante = '$de' or id_requisitado = '$de' GROUP BY id_solicitante) and id_requisitado != '$de' or id_solicitante = '$para' and id_requisitado in( select id_solicitante from amizade where id_solicitante = '$de' or id_requisitado = '$de' GROUP BY id_solicitante) and id_requisitado != '$de' LIMIT 10");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $row["listagem"] = '

                    <li><a href="/principal/amigo/'.$row['id_requisitado'].'" title="'.$row['nome_requisitado'].'" alt="'.$row['nome_requisitado'].'"><img src="/public/uploads/fotoPerfil/profile-default.png" style="width: 70px;height: 70px;" alt=""></a></li>
                    ';
                    ?>
                    <?php
                    echo $row["listagem"];
                }
            } else {

            }
        }
    }

    public function getTotalSeguidoresUsuarioLogado() {
        if(isset($_POST['perfil'])) {

            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            $result = mysqli_query($conn, "SELECT COUNT(id_solicitante) AS totalSeguindo FROM amizade WHERE status = '0'");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('seguidores'=> $row['totalSeguindo']));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('seguidores'=> '0'));
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function getTotalSeguidoresVoltaUsuarioLogado() {
        if(isset($_POST['perfil'])) {

            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            $result = mysqli_query($conn, "SELECT COUNT(id_solicitante) AS totalSeguindo FROM amizade WHERE status = '1'");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    header('Content-Type: application/json');
                    echo json_encode(array('seguidoresVolta'=> $row['totalSeguindo']));
                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('seguidoresVolta'=> '0'));
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function curtir() {
        if(isset($_POST['idUser']) && isset($_POST['idPublicacao'])) {
            $idUser = $_POST['idUser'];
            $idPublicacao = $_POST['idPublicacao'];

            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            $result = mysqli_query($conn, "SELECT * FROM curtidas WHERE id_publicacao = '".$idPublicacao."' AND id_user = '".$idUser."'");

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    mysqli_query($conn, "DELETE FROM curtidas WHERE id_user = '".$idUser."' AND id_publicacao = '".$idPublicacao."'");
                    header('Content-Type: application/json');
                    echo json_encode(array('curtir'=> '0', 'pb' => $idPublicacao));
                }
            } else {
                mysqli_query($conn, "INSERT INTO curtidas (id_user, id_publicacao) VALUES ('".$idUser."', '".$idPublicacao."')");
                header('Content-Type: application/json');
                echo json_encode(array('curtir'=> '1', 'pb' => $idPublicacao));
            }
        } else {
            $this->render('error/usuario');
        }
    }

    public function comentar() {
        if(isset($_POST['id_usuario']) && isset($_POST['id_postagem']) && isset($_POST['comentario'])) {
            $idUser = $_POST['id_usuario'];
            $idPublicacao = $_POST['id_postagem'];
            $comentario = $_POST['comentario'];
            $dataHora = date('Y-m-d H:i:s');

            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");

            mysqli_query($conn, "INSERT INTO comentarios (id_postagem, id_usuario, comentario, dataHora) VALUES ('$idPublicacao', '$idUser', '$comentario', '$dataHora')");

            header("Location: /principal/index");

        } else {
            $this->render('error/usuario');
        }
    }

    public function comentarios() {
        if(isset($_POST['idPublicacao'])) {
            $idPublicacao = $_POST['idPublicacao'];
            // $conn = mysqli_connect("remotemysql.com", "xuzhvu3ZzJ", "neVSzrJgAW", "xuzhvu3ZzJ");
            //TODO: COLOCAR CONEXÃO PADRÃO 
            $conn = mysqli_connect("localhost:3306", "root", "", "pesquisadores");
            $result = mysqli_query($conn, "SELECT vaga.*, comentarios.comentario
                        FROM comentarios
                        INNER JOIN vaga ON vaga.id = comentarios.id_postagem");

            while($row = mysqli_fetch_assoc($result)) {
                $row["listagem"] = '
                    <div class="card">
                    <div class="card-header">'.$row['nomeUsuario'].'</div>
                        <div class="card-body">
                        '.$row['comentario'].'
                        </div>
                    </div>  
                    ';
                ?>
                <?php
                echo $row["listagem"];
            }
        }
    }
}