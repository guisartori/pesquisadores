<input type="hidden" id="id-logado" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
<input type="hidden" id="id-amigo">
<input type="hidden" id="nome-amigo">
<input type="hidden" id="nome-logado" value="<?php  echo \App\Lib\Auth::usuario()->usuario; ?>">
<style>
    .user-account {
        width: 165px !important;
    }

    nav {
        width: 56%;
    }

    .user-info a {
        white-space: nowrap !important;
        width: 91px !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    .post-project h3 {
        float: left;
        width: 100%;
        background-color: #636f56 !important;
        color: #fff;
        text-align: center;
        font-size: 18px;
        font-weight: 500;
        padding: 20px 0;
    }

    .post-project-fields form ul li button.active {
        background-color: #79965a !important;
        color: #fff;
    }
</style>

<!-- Modal Confirmação Excluir -->
<div class="modal fade" id="modal-confirmacao-exluir-vaga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h5 class="modal-title" id="exampleModalLabel">Confirmação de Exclusão de Postagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor: pointer !important;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir a postagem <strong>"<span id="tituloPostagemVaga" class="text-danger text-uppercase"></span>"</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal" style="cursor: pointer !important;">Cancelar exclusão</button>
                <button id="excluirPostagem" type="button" class="btn btn-danger" style="cursor: pointer !important;">Sim, quero excluir esta postagem!</button>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
    <header>
        <div class="container">
            <div class="header-data">
                <div class="logo">
                    <a href="principal.html" title=""><img src="/public/images/logo.png" alt=""></a>
                </div>
                <div class="search-bar">
                    <form>
                        <input type="text" name="country" id="country" placeholder="&#xF007; Digite o nome do amigo..." class="typeahead" style="font-family:Arial, FontAwesome">
                        <div id="countryList"></div>
                        <button type="submit"><i class="la la-search"></i></button>
                    </form>
                </div>
                <nav>
                    <ul>
                        <li>
                            <a href="/principal/" title="">
                                <span><img src="/public/images/icon1.png" alt=""></span>
                                Home
                            </a>
                        </li>

			<li>
                            <a href="/perfil/editar" title="">
                                Editar Perfil
                            </a>
                        </li>

                        <li>
                            <div class="badge-notificacoes invisivel">
                                <span class="badge badge-notificacoes-quantidade"></span>
                            </div>
                            <a href="/principal/amigos" title="">
                                <span><img src="/public/images/icon4.png" alt=""></span>
                                Seguidores
                            </a>

                        </li>
                    </ul>
                </nav>
                <div class="menu-btn">
                    <a href="#" title=""><i class="fa fa-bars"></i></a>
                </div>
                <div class="user-account">
                    <div class="user-info">
                        <img class="foto-perfil-navbar" src="/public/images/perfil/profile-default.png" alt="">
                        <a title=""><?php  echo \App\Lib\Auth::usuario()->usuario; ?></a>
                        <i class="la la-sort-down"></i>
                    </div>
                    <div class="user-account-settingss">


                        <h3>Configurações</h3>
                        <ul class="us-links">
                            <li><a href="/perfil/" title="">Meu Perfil</a></li>
                            <li><a href="/perfil/editar" title="">Editar meu Perfil</a></li>

                        </ul>
                        <h3 class="tc"><a href="/login/sair" title=""><i class="la la-sign-out" style="color: #93d4b2;"></i> Sair</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                            <div class="main-left-sidebar no-margin">
                                <div class="user-data full-width">
                                    <div class="user-profile">
                                        <div class="username-dt">
                                            <div class="usr-pic">
                                                <div class="lds-facebook" style="background: #0d6120;border-radius: 50%;margin-top: 2em;"><div></div><div></div><div></div></div>
                                            </div>
                                        </div>
                                        <div class="user-specs">
                                            <h3><?php  echo \App\Lib\Auth::usuario()->usuario; ?></h3>
                                            <span><?php  echo \App\Lib\Auth::usuario()->profissao; ?></span>
                                        </div>
                                    </div>
                                    <ul class="user-fw-status">
                                        <li>
                                            <h4>Seguindo</h4>
                                            <span class="qtdSeguidoresUser"><?php echo $aViewVar['totalSeguindo'] ?></span>
                                        </li>
                                        <li>
                                            <h4>Seguidores</h4>
                                            <span class="seguindoVolta"><?php echo $aViewVar['totalSeguidores'] ?></span>
                                        </li>
                                        <li>
                                            <a href="/perfil/" title="">Ver Perfil</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="suggestions full-width">
                                    <div class="sd-title">
                                        <h3>Você pode seguir estes usuários</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="suggestions-list">
                                        <div id="content-sugestoes" style="text-align: center;">
                                            <div class="lds-facebook"><div></div><div></div><div></div></div>
                                        </div>
                                        <div class="view-more">
                                            <a href="#" title="">Ver Mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 no-pd">
                            <div class="main-ws-sec">
                                <div class="post-topbar">
                                    <div class="user-picy">
                                        <div class="lds-facebook" style="background: #ffffff;border-radius: 50%;"><div></div><div></div><div></div></div>
                                    </div>
                                    <div class="post-st">
                                        <ul>
                                            <li class="d-none hidden"><a class="post_project" href="#" title="">Postar um Projeto</a></li>
                                            <li><a class="post-jb active" href="#" title="">Compartilhar Publicação</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="posts-section">

                                    <?php
                                        if(!count($aViewVar['posts'])){
                                    ?>
                                        <div class="alert alert-warning" role="alert">Nada ainda foi publicado...</div>
                                    <?php
                                        } else {
                                            foreach($aViewVar['posts'] as $post) {
                                                include __DIR__.'\..\components\post.php';
                                            }
                                        }
                                    ?>


                                    <div class="top-profiles">
                                        <div class="pf-hd">
                                            <h3>Você deveria conhecer:</h3>
                                            <i class="la la-ellipsis-v"></i>
                                        </div>
                                        <div class="profiles-slider" id="content-voce-deveria">
                                            <div class="process-comm">
                                                <div class="spinner">
                                                    <div class="bounce1"></div>
                                                    <div class="bounce2"></div>
                                                    <div class="bounce3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="post-popup pst-pj">
        <div class="post-project">
            <h3>Postar um Projeto</h3>
            <div class="post-project-fields">
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="title" placeholder="Título">
                        </div>
                        <div class="col-lg-12" style="display: none;">
                            <div class="inp-field">
                                <select>
                                    <option class="text-capitalize" val="Categorias">Categorias</option>
                                    <option class="text-capitalize" val="Categoria ">Categoria 1</option>
                                    <option class="text-capitalize" val="Categoria ">Categoria 2</option>
                                    <option class="text-capitalize" val="Categoria ">Categoria 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <textarea name="description" placeholder="Descrição"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li><button class="active" type="submit" value="post">Postar</button></li>
                                <li><a href="#" title="">Cancelar</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <a href="#" title=""><i class="la la-times-circle-o"></i></a>
        </div>
    </div>

    <div class="post-popup job_post">
        <div class="post-project">
            <h3>Compartilhar Publicação</h3>
            <div class="post-project-fields">
                <form method="post" action="/perfil/salvarVaga">
                    <input type="hidden" name="id_usuario" value="<?php echo \App\Lib\Auth::usuario()->id; ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="titulo" placeholder="Título">
                        </div>
                        <div class="col-lg-12">
                            <textarea name="texto" placeholder="O que você está pensando?"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li><button class="active" type="submit" value="post">Compartilhar Publicação</button></li>
                                <li><a href="#" title="">Cancelar</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <a href="#" title=""><i class="la la-times-circle-o"></i></a>
        </div>
    </div>
</div>
<!-- Modal Editar -->
<div class="modal fade" id="modal-editar-vaga" tabindex="-1" role="dialog" aria-labelledby="modal-editar-vagaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Editar Publicação: <span id="titulo-editar-vaga" class="text-danger"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="titulo-editar-vaga" class="col-form-label">Titulo:</label>
                        <input type="text" class="form-control titulo-editar-vaga" id="titulo-editar-vaga">
                    </div>
                    <div class="form-group">
                        <label for="descricao-editar-vaga" class="col-form-label">Descrição:</label>
                        <textarea class="form-control descricao-editar-vaga" id="descricao-editar-vaga"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar Edição</button>
                <button id="btn-editar-vaga" type="button" class="btn btn-secondary">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal comentarios -->
<div class="modal fade" id="modal-comentarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comentários</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-coments"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>