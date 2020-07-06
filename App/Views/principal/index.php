<input type="hidden" id="id-logado" value="<?php echo \App\Lib\Auth::usuario()->id; ?>">
<input type="hidden" id="id-amigo">
<input type="hidden" id="nome-amigo">
<input type="hidden" id="nome-logado" value="<?php echo \App\Lib\Auth::usuario()->usuario; ?>">
<style>
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

<div class="wrapper">
    <?php include __DIR__ . "/../components/header.php"; ?>

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
                                                <img style="width: 110px; height: 110px" src="<?php echo ($aViewVar['usuario']['foto_perfil']) ? $aViewVar['usuario']['foto_perfil'] : "http://via.placeholder.com/110x110"; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="user-specs">
                                            <h3><?php echo \App\Lib\Auth::usuario()->usuario; ?></h3>
                                            <span><?php echo \App\Lib\Auth::usuario()->profissao; ?></span>
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
                                            <div class="lds-facebook">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
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
                                        <img style="width: 50px; height: 50px" src="<?php echo ($aViewVar['usuario']['foto_perfil']) ? $aViewVar['usuario']['foto_perfil'] : "http://via.placeholder.com/50x50"; ?>" alt="">
                                    </div>
                                    <div class="post-st">
                                        <ul>
                                            <?php if ($aViewVar['usuario']['tipo'] == 1) { ?><li><a class="publicacao-jb active" href="#" title="">Nova publicação</a></li><?php } ?>
                                            <li><a class="post-jb active" href="#" title="">Novo post</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="posts-section">

                                    <?php
                                    if (!count($aViewVar['posts'])) {
                                    ?>
                                        <div class="alert alert-warning" role="alert">Nada ainda foi publicado...</div>
                                    <?php
                                    } else {
                                        foreach ($aViewVar['posts'] as $post) {
                                            include __DIR__ . '/../components/post.php';
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

    <div class="post-popup job_post">
        <div class="post-project">
            <h3>Novo post</h3>
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
                            <input type="text" name="palavras_chave" placeholder="Palavras chave: separe por (;)">
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li><button class="active" type="submit" value="post">Compartilhar Publicação</button></li>
                                <li><a href="#" title="">Cancelar</a></li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="tipo" value="0">
                </form>
            </div>
            <a href="#" title=""><i class="la la-times-circle-o"></i></a>
        </div>
    </div>

    <div class="post-popup job_publicacao">
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
                            <input type="text" name="local" placeholder="Local/intituição de publicação">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" name="ano_publicacao" placeholder="Ano da publicação">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" name="url" placeholder="URL do artigo">
                        </div>
                        <div class="col-lg-12">
                            <textarea name="texto" placeholder="Escreva um resumo"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <input type="text" name="palavras_chave" placeholder="Palavras chave: separe por (;)">
                        </div>
                        <div class="col-lg-12">
                            <ul>
                                <li><button class="active" type="submit" value="post">Compartilhar Publicação</button></li>
                                <li><a href="#" title="">Cancelar</a></li>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="tipo" value="1">
                </form>
            </div>
            <a href="#" title=""><i class="la la-times-circle-o"></i></a>
        </div>
    </div>
</div>