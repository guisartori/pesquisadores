<style>
    .topicos{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .topicos li{
        height: 40px;
        border: #444 1px solid;
        background: #dadada;
        border-radius: 2px;
        display: flex !important;
        padding: 8px !important;
        margin: 4px;
        justify-content: center;
        align-items: center;
        /* cursor: pointer; */
    }
</style>
<body>
<input id="idUsuario" type="hidden" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
<input type="hidden" id="id-logado" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
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
                        <h3 class="tc"><a href="/login/sair" title=""><i class="la la-sign-out" style="color: #e44d3a;"></i> Sair</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <section class="cover-sec">
        <img id="img-capa" src="<?php echo ($aViewVar['usuario'][0]['foto_capa']) ? $aViewVar['usuario'][0]['foto_capa'] : "http://via.placeholder.com/1600x400"; ?>" alt="CAPA DO PERFIL DO USUÁRIO" title="CAPA DO PERFIL DO USUÁRIO" style="width: 1600px !important; max-width: 1600px !important; height: 400px !important; max-height: 400px !important;">
    </section>


    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="main-left-sidebar">
                                <div class="user_profile">
                                    <div class="user-pro-img">
                                        <img src="<?php echo ($aViewVar['usuario'][0]['foto_perfil']) ? $aViewVar['usuario'][0]['foto_perfil'] : "http://via.placeholder.com/170x170"; ?>" alt="" style="width: 170px !important; max-width: 170px !important; height: 170px !important; max-height: 170px !important;">
                                    </div>
                                    <div class="user_pro_status">

                                        <ul class="flw-status">
                                            <li>
                                                <span>Seguindo</span>
                                                <b class="qtdSeguidoresUser">0</b>
                                            </li>
                                            <li>
                                                <span>Seguidores</span>
                                                <b>0</b>
                                            </li>
                                        </ul>
                                    </div>

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
                        <div class="col-lg-9">
                            <div class="main-ws-sec">
                                <div class="user-tab-sec">
                                    <h3><?php  echo \App\Lib\Auth::usuario()->usuario; ?></h3>
                                    <p>  </p>
                                    <div class="star-descp">
                                        <span><?php  echo \App\Lib\Auth::usuario()->profissao; ?></span>

                                    </div>
                                    <div class="tab-feed">
                                        <ul>
                                            <li data-tab="feed-dd" class="active">
                                                <a href="#" title="">
                                                    <img src="/public/images/ic1.png" alt="">
                                                    <span>Publicações</span>
                                                </a>
                                            </li>
                                            <li data-tab="info-dd">
                                                <a href="#" title="">
                                                    <img src="/public/images/ic2.png" alt="">
                                                    <span>Informações</span>
                                                </a>
                                            </li>
                                            <?php if(!App\Lib\Util::jaRecomendado(\App\Lib\Auth::usuario()->id, $aViewVar['usuario'][0]['id'])) { ?>
                                                <li data-tab="feed-dd" class="x">
                                                    <a class="recomendarPerfil" data-id-perfil="<?php echo $aViewVar['usuario'][0]['id']; ?>" title="" style="text-decoration: none !important;color: #b2b2b2;cursor: pointer;">
                                                        <span id="qtd-likes" class="badge badge-pill badge-danger" style="position: absolute;color: #FFFFFF;font-size: 14px;line-height: 0.98;padding-top: 0.4em;padding-bottom: 0.4em;margin-left: 74px;margin-top: -9px;">
                                                            <?php echo App\Lib\Util::qtdRecomendacoes($aViewVar['usuario'][0]['id']) ?>
                                                        </span>
                                                        <i class="la la-thumbs-o-up" style="font-size: 34px;"></i>
                                                        <span data-toggle="tooltip" data-placement="bottom" title="RECOMENDAR USUÁRIO">Recomendar</span>
                                                    </a>
                                                </li>
                                            <?php } else { ?>
                                                <li data-tab="feed-dd" class="x active">
                                                    <a class="desRecomendarPerfil" data-id-perfil="<?php echo $aViewVar['usuario'][0]['id']; ?>" title="" style="text-decoration: none !important;color: #b2b2b2;cursor: pointer;">
                                                        <span id="qtd-likes" class="badge badge-pill badge-danger" style="position: absolute;color: #FFFFFF;font-size: 14px;line-height: 0.98;padding-top: 0.4em;padding-bottom: 0.4em;margin-left: 110px;margin-top: -9px;">
                                                            <?php echo App\Lib\Util::qtdRecomendacoes($aViewVar['usuario'][0]['id']) ?>
                                                        </span>
                                                        <i class="la la-thumbs-o-up" style="font-size: 34px;"></i>
                                                        <span data-toggle="tooltip" data-placement="bottom" title="Desfazer recomendação">Remover recomendação</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-feed-tab current" id="feed-dd">
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
                                <div class="product-feed-tab" id="info-dd">
                                    <div class="user-profile-ov">
                                        <h3>Visão geral</h3>
                                        <p id="texto-visao-geral">
                                            <?php echo $aViewVar['usuario'][0]['visao_geral'] ?>
                                        </p>
                                    </div>
                                    <div class="user-profile-ov st2">
                                        <h3>Experiência</h3>
                                        <?php
                                        if(!count($aViewVar['aListaExperiencia'])){
                                        ?>
                                        <div class="alert alert-danger" role="alert">Nenhuma experiência cadastrada!</div>
                                        <?php
                                        } else {
                                        ?>
                                        <?php
                                        foreach($aViewVar['aListaExperiencia'] as $aExperiencia) {
                                        ?>
                                        <h4><?php echo $aExperiencia['titulo']; ?></h4>
                                        <p><?php echo $aExperiencia['texto']; ?></p>

                                        <?php
                                        }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                        <p class="no-margin">  </p>
                                    </div>
                                    <div class="user-profile-ov">
                                        <h3>Educação</h3>
                                        <?php
                                        if(!count($aViewVar['aListaEducacao'])){
                                            ?>
                                            <div class="alert alert-danger" role="alert">Nenhuma informação de Educação cadastrada!</div>
                                            <?php
                                        } else {
                                            ?>
                                            <?php
                                            foreach($aViewVar['aListaEducacao'] as $aEducacao) {
                                                ?>
                                                <h4><?php echo $aEducacao['titulo']; ?></h4>
                                                <span> <?php echo $aEducacao['ano_inicio']; ?> - <?php echo $aEducacao['ano_fim']; ?> </span>
                                                <p><?php echo $aEducacao['texto']; ?></p>

                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    
                                    <div class="user-profile-ov">
                                        <h3>Habilidades</h3>
                                        <ul>
                                            <?php
                                            if(!count($aViewVar['aListaHabilidades'])){
                                                ?>
                                                <div class="alert alert-danger" role="alert">Nenhuma habilidade encontrada!</div>
                                                <?php
                                            } else {
                                                ?>
                                                <ul>
                                                    <?php
                                                    foreach($aViewVar['aListaHabilidades'] as $aHabilidades) {
                                                        ?>

                                                        <li><a data-id-habilidade="<?php echo $aHabilidades['id']; ?>" href="#" title="<?php echo $aHabilidades['nome']; ?>" alt="<?php echo $aHabilidades['nome']; ?>"><?php echo $aHabilidades['nome']; ?></a></li>

                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <div class="user-profile-ov">
                                    <h3>Tópicos de interesse</h3>
                                        <ul class="topicos">
                                            <?php foreach($aViewVar['topicos'] as $topico){ ?>
                                                <li ><?php echo $topico['nome']; ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3" style="transform: translate(0px, 13.6em);">
                            <div class="right-sidebar">
                                <div class="message-btn d-none">
                                    <a href="#" title=""><i class="fa fa-envelope"></i> Mensagens</a>
                                </div>
                                <div class="widget widget-portfolio" style="display:none !important;visibility: hidden !important;">
                                    <div class="wd-heady">
                                        <h3>Portfólio</h3>
                                        <img src="/public/images/photo-icon.png" alt="">
                                    </div>
                                    <div class="pf-gallery">
                                        <ul>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                            <li><a href="#" title=""><img src="http://via.placeholder.com/70x70" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="overview-box" id="create-portfolio">
        <div class="overview-edit">
            <h3>Criar Portfólio</h3>
            <form>
                <input type="text" name="pf-name" placeholder="Portfolio Name">
                <div class="file-submit">
                    <input type="file" name="file">
                </div>
                <div class="pf-img">
                    <img src="http://via.placeholder.com/60x60" alt="">
                </div>
                <input type="text" name="website-url" placeholder="htp://www.example.com">
                <button type="submit" class="save">Salvar</button>
                <button type="submit" class="cancel">Cancelar</button>
            </form>
            <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
        </div>
    </div>

</div>
</body>