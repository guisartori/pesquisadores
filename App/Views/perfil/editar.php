<style>
    .cover-sec > label.upload-capa {
        display: inline-block;
        color: #e44d3a;
        font-size: 16px;
        background-color: #fff;
        border: 1px solid #e44d3a;
        position: absolute;
        top: 30px;
        right: 0;
        padding: 10px 15px;
        font-weight: 600;
        margin-right: 15px;
        cursor: pointer !important;
    }

    .deletar-habilidade:hover{
        color:#e44d3a;
        cursor: pointer;
    }
</style>

<body>

<script>
function removerFotoPerfil(idUsuario){
    $.ajax({
        url: '/perfil/removerFotoPerfil',
        method: 'POST',
        data: {idUsuario},
        success: function (d) {
            window.location.reload()
        }
    });
}

function removerFotoCapa(idUsuario){
    $.ajax({
        url: '/perfil/removerFotoCapa',
        method: 'POST',
        data: {idUsuario},
        success: function (d) {
            window.location.reload()
        }
    });
}
</script>

<!-- MODAL UPLOAD FOTO DE PERFIL -->
<div id="chama-modal-upload-foto-perfil" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Foto de Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" method="post" action="/perfil/uploadFoto" enctype="multipart/form-data">
            <div class="modal-body">
                <input id="id_user2" name="usuario" type="hidden" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
                <input type="file" id="upload-" name="save-foto-user" class="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onClick="javascript:removerFotoPerfil(<?php  echo \App\Lib\Auth::usuario()->id; ?>)" data-dismiss="modal">Remover</button>
                <button type="submit" class="btn btn-primary" name="save-foto">Salvar Foto</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL UPLOAD FOTO DE CAPA -->
<div id="chama-modal-upload-foto-capa" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alterar Foto de Capa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" method="post" action="/perfil/uploadCapaPerfil" enctype="multipart/form-data">
            <div class="modal-body">
                    <input id="id_user2" name="usuario" type="hidden" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
                    <input type="file" id="upload-" name="save-foto-capa" class="">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" onClick="javascript:removerFotoCapa(<?php  echo \App\Lib\Auth::usuario()->id; ?>)" data-dismiss="modal">Remover</button>
                <button type="submit" class="btn btn-primary" name="save-foto">Salvar Foto</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
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
                                Amigos
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
                        <a class="nomeUser" id="nomeUser" title=""><?php echo $aViewVar['aUsuario']['nome'] ?></a>
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



    <form class="form-upload-capa-perfil" method="post" action="/perfil/uploadCapaPerfil" enctype="multipart/form-data">
        <section class="cover-sec">
            <button class="btn btn-lg btn-danger btn-block btn-upload d-none" name="save-capa" type="submit" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;margin: auto;height: 70px;cursor: alias;"><i class="la la-check" style="font-size: 1.2em;margin-right: 0.3em;"></i> CLIQUE PARA CARREGAR A FOTO SELECIONADA!</button>
            
            <input id="id_user" name="id_user" type="hidden" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
            <img id="img-capa" src="<?php echo ($aViewVar['aUsuario']['foto_capa']) ? $aViewVar['aUsuario']['foto_capa'] : "/public/images/capa-default2.png"; ?>" alt="CAPA DO PERFIL DO USUÁRIO" title="CAPA DO PERFIL DO USUÁRIO" style="width: 1600px !important; max-width: 1600px !important; height: 400px !important; max-height: 400px !important;">
            <label for="upload-capa" class="upload-capa"  data-toggle="modal" data-target="#chama-modal-upload-foto-capa"><i class="fa fa-camera" style="margin-right: 0.3em;"></i>Alterar Imagem</label>
            <!-- <input type="file" id="upload-capa" name="save-capa-user" class="d-none"> -->
        </section>
    </form>


    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="main-left-sidebar">
                                <div class="user_profile">
                                    <div class="user-pro-img chama-modal-upload-foto-perfil" data-toggle="modal" data-target="#chama-modal-upload-foto-perfil">
                                        <img id="img-usuario-foto-perfil" src="<?php echo ($aViewVar['aUsuario']['foto_perfil']) ? $aViewVar['aUsuario']['foto_perfil'] : "http://via.placeholder.com/170x170"; ?>" alt="" style="width: 170px !important; max-width: 170px !important; height: 170px !important; max-height: 170px !important;">
                                        <a href="#" title=""><i class="fa fa-camera"></i></a>
                                    </div>
                                    <div class="user_pro_status">
                                        <ul class="flw-status">
                                            <li>
                                                <span>Seguindo</span>
                                                <b class="qtdSeguidoresUser">
                                                    <?php echo \App\Models\Seguidor::getTotalSeguindo(\App\Lib\Auth::usuario()->id)[0]['total']; ?>
                                                </b>
                                            </li>
                                            <li>
                                                <span>Seguidores</span>
                                                <b class="seguindoVolta">
                                                <?php echo \App\Models\Seguidor::getTotalSeguidores(\App\Lib\Auth::usuario()->id)[0]['total']; ?>
                                                </b>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="container">
                            <div class="main-ws-sec">
                                <div class="user-tab-sec">
                                    <h3><?php echo $aViewVar['aUsuario']['nome']; ?></h3>
                                    <p>  </p>
                                    <div class="star-descp" style="margin-bottom: 0px;">
                                    <span><?php echo $aViewVar['aUsuario']['profissao']; ?></span>
                                    <h3><span class="nomeUser"></span> <span class="badge badge-danger chama-modal-editar-nome" style="cursor: pointer;font-size: 15px;"><button class="btn btn-editar btn-sm">EDITAR INFORMAÇÕES</button></span></h3>
                                    
                                    <div class="tab-feed st2" >
                                        <ul style="padding-top: 40px;">

                                            <li data-tab="info-dd">
                                                <a href="#" title="">
                                                    <img src="/public/images/ic2.png" alt="">
                                                    <span>Informações</span>
                                                </a>
                                            </li>

                                            <li data-tab="portfolio-dd" style="display:none;visibility: hidden;">
                                                <a href="#" title="">
                                                    <img src="/public/images/ic3.png" alt="">
                                                    <span style="display: none;visibility: hidden;">Portfólio</span>
                                                </a>
                                            </li>
                                            <li data-tab="payment-dd" style="display:none !important;visibility: hidden !important;">
                                                <a href="#" title="">
                                                    <img src="/public/images/ic6.png" alt="">
                                                    <span>Pagamento</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-feed-tab" id="info-dd">
                                    <div class="user-profile-ov">
                                        <h3><a href="#" title="" class="overview-open link-visao-geral">Visão Geral</a> <a href="#" title="" class="overview-open link-visao-geral"><button class="btn btn-editar btn-sm">EDITAR INFORMAÇÕES</button></a></h3>
                                        <p id="content-visao-geral"><?php echo $aViewVar['aUsuario']['visao_geral']; ?></p>
                                    </div>
                                    <div class="user-profile-ov st2">
                                        <h3><a href="#" title="" class="exp-bx-open">Experiência</a>
                                        
                                        </a> <a href="#" title="" class="exp-bx-open"><i class="fa fa-plus-square"></i></a></h3>

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
                                                    <h4><?php echo $aExperiencia['titulo']; ?> <a data-id-experiencia="<?php echo $aExperiencia['id']; ?>" title=""><button class="btn btn-danger btn-sm" onClick="javascript: window.location.href = '/experiencia/deletar/<?php echo $aExperiencia['id']; ?>'">REMOVER</button></a></h4>
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
                                        <h3><a href="#" title="" class="ed-box-open">Educação</a> <a href="#" title="" class="ed-box-open"><i class="fa fa-plus-square"></i></a></h3>

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
                                                <h4><?php echo $aEducacao['titulo']; ?> <a data-id-educacao="<?php echo $aEducacao['id']; ?>" title=""><button class="btn btn-danger btn-sm" onClick="javascript: window.location.href = '/formacao/deletar/<?php echo $aEducacao['id']; ?>'">REMOVER</button></a></h4>
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
                                        <h3><a href="#" title="" class="skills-open">Habilidades</a> <a href="#" title="" class="skills-open"><i class="fa fa-plus-square"></i></a></h3>
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

                                                    <li><a><?php echo $aHabilidades['nome']; ?><i class="fa fa-trash deletar-habilidade" onClick="javascript: window.location.href = '/habilidade/deletar/<?php echo $aHabilidades['id']; ?>'" ></i></a></li>

                                                    <?php
                                                }
                                                ?>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-feed-tab" id="saved-jobs">
                                    <div class="posts-section">
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Codificador Épico</span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>

                                            </div>
                                            <div class="job_descp">
                                                <h3>Desenvolvedor Wordpress Senior</h3>
                                                <ul class="job-dt">
                                                    <li><a href="#" title="">Integral</a></li>
                                                    <li><span>$90 / hr</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">ver mais</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Curtir</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentarios 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 50</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Codificador Épico</span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>

                                            </div>
                                            <div class="job_descp">
                                                <h3> Desenvolvedor Wordpress Senior</h3>
                                                <ul class="job-dt">
                                                    <li><a href="#" title="">Integral</a></li>
                                                    <li><span>R$90 / hr</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">view more</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Curtir</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentarios 75</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 150</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Codificador Épico</span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>

                                            </div>
                                            <div class="job_descp">
                                                <h3>Senior Wordpress Developer</h3>
                                                <h3> Desenvolvedor Wordpress Senior</h3>
                                                <ul class="job-dt">
                                                    <li><a href="#" title="">Integral</a></li>
                                                    <li><span>R$90 / hr</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">view more</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Curtir</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentarios 65</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 450</a>
                                            </div>
                                        </div><!--post-bar end-->
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Codificador Épico</span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>

                                            </div>
                                            <div class="job_descp">

                                                <h3> Desenvolvedor Wordpress Senior</h3>
                                                <ul class="job-dt">
                                                    <li><a href="#" title="">Integral</a></li>
                                                    <li><span>R$90 / hr</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">view more</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Curtir</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentarios 175</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 650</a>
                                            </div>
                                        </div>
                                        <div class="process-comm">
                                            <a href="#" title=""><img src="images/process-icon.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-feed-tab" id="my-bids">
                                    <div class="posts-section">
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Desenvolvedor Frontend </span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title="" class="bid_now">De um lance</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Site simples </h3>
                                                <ul class="job-dt">
                                                    <li><span>R$300 - R$350</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">ver mais</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                    <li><a href="#" title="">Photoshop</a></li>
                                                    <li><a href="#" title="">Illustrator</a></li>
                                                    <li><a href="#" title="">Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Recomendações</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentários 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 50</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Desenvolvedor Frontend</span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title="" class="bid_now">De um lance</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Aplicativo de compras IOS</h3>
                                                <ul class="job-dt">
                                                    <li><span>R$390 - R$1150</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">ver mais</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                    <li><a href="#" title="">Photoshop</a></li>
                                                    <li><a href="#" title="">Illustrator</a></li>
                                                    <li><a href="#" title="">Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Recomendações</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentários 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 50</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Desenvolvedor Frontend</span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title="" class="bid_now">De um lance</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Site simples 2 </h3>
                                                <ul class="job-dt">
                                                    <li><span>R$300 - R$350</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">ver mais</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                    <li><a href="#" title="">Photoshop</a></li>
                                                    <li><a href="#" title="">Illustrator</a></li>
                                                    <li><a href="#" title="">Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Recomendações</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentários 215</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 550</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="http://via.placeholder.com/50x50" alt="">
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="images/clock.png" alt="">3 minutos atrás</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Editar uma postagem</a></li>
                                                        <li><a href="#" title="">Não foi Salvo</a></li>
                                                        <li><a href="#" title="">Liberar</a></li>
                                                        <li><a href="#" title="">Fechar</a></li>
                                                        <li></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="images/icon8.png" alt=""><span>Desenvolvedor Frontend</span></li>
                                                    <li><img src="images/icon9.png" alt=""><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title=""><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title=""><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title="" class="bid_now">De um lance</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Aplicativo de compras IOS</h3>
                                                <ul class="job-dt">
                                                    <li><span>R$390 - R$1150</span></li>
                                                </ul>
                                                <p>. <a href="#" title="">ver mais</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                    <li><a href="#" title="">Photoshop</a></li>
                                                    <li><a href="#" title="">Illustrator</a></li>
                                                    <li><a href="#" title="">Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i>Recomendações</a>
                                                        <img src="images/liked-img.png" alt="">

                                                    </li>
                                                    <li><a href="#" title="" class="com"><img src="images/com.png" alt=""> Comentários 200</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Visualizações 1550</a>
                                            </div>
                                        </div><!--post-bar end-->
                                        <div class="process-comm">
                                            <a href="#" title=""><img src="images/process-icon.png" alt=""></a>
                                        </div><!--process-comm end-->
                                    </div><!--posts-section end-->
                                </div><!--product-feed-tab end-->
                                <div class="product-feed-tab" id="portfolio-dd">
                                    <div class="portfolio-gallery-sec">
                                        <h3>Portfolio</h3>
                                        <div class="gallery_pf">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/271x174" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="http://via.placeholder.com/170x170" alt="">
                                                        <a href="#" title=""><img src="images/all-out.png" alt=""></a>
                                                    </div><!--gallery_pt end-->
                                                </div>
                                            </div>
                                        </div><!--gallery_pf end-->
                                    </div><!--portfolio-gallery-sec end-->
                                </div><!--product-feed-tab end-->
                                <div class="product-feed-tab" id="payment-dd">
                                    <div class="billing-method">
                                        <ul>
                                            <li>
                                                <h3>Adicionar método de pagamento</h3>
                                                <a href="#" title=""><i class="fa fa-plus-circle"></i></a>
                                            </li>
                                            <li>
                                                <h3>Ver atividade</h3>
                                                <a href="#" title="">Visualizar tudo</a>
                                            </li>
                                            <li>
                                                <h3>Total</h3>
                                                <span>R$0.00</span>
                                            </li>
                                        </ul>
                                        <div class="lt-sec">
                                            <img src="images/lt-icon.png" alt="">
                                            <h4>Todas as suas transações são salvas aqui</h4>
                                            <a href="#" title="">Clique aqui</a>
                                        </div>
                                    </div><!--billing-method end-->
                                    <div class="add-billing-method">
                                        <h3>Adicionar Forma de Pagamento</h3>
                                        <h4><img src="images/dlr-icon.png" alt=""><span>Utilizando a Pesquisadores o pagamento é garantido</span></h4>
                                        <div class="payment_methods">
                                            <h4>Cartão de Débito e Crédito</h4>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="cc-head">
                                                            <h5>Número do Cartão</h5>
                                                            <ul>
                                                                <li><img src="images/cc-icon1.png" alt=""></li>
                                                                <li><img src="images/cc-icon2.png" alt=""></li>
                                                                <li><img src="images/cc-icon3.png" alt=""></li>
                                                                <li><img src="images/cc-icon4.png" alt=""></li>
                                                            </ul>
                                                        </div>
                                                        <div class="inpt-field pd-moree">
                                                            <input type="text" name="cc-number" placeholder="">
                                                            <i class="fa fa-credit-card"></i>
                                                        </div><!--inpt-field end-->
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="cc-head">
                                                            <h5>Primeiro nome</h5>
                                                        </div>
                                                        <div class="inpt-field">
                                                            <input type="text" name="f-name" placeholder="">
                                                        </div><!--inpt-field end-->
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="cc-head">
                                                            <h5>Último nome</h5>
                                                        </div>
                                                        <div class="inpt-field">
                                                            <input type="text" name="l-name" placeholder="">
                                                        </div><!--inpt-field end-->
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="cc-head">
                                                            <h5>Data de validade</h5>
                                                        </div>
                                                        <div class="rowwy">
                                                            <div class="row">
                                                                <div class="col-lg-9 pd-left-none no-pd">
                                                                    <div class="inpt-field">
                                                                        <input type="text" name="f-name" placeholder="">
                                                                    </div><!--inpt-field end-->
                                                                </div>
                                                                <div class="col-lg-9 pd-right-none no-pd">
                                                                    <div class="inpt-field">
                                                                        <input type="text" name="f-name" placeholder="">
                                                                    </div><!--inpt-field end-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <div class="cc-head">
                                                            <h5>Código de Segurança <i class="fa fa-question-circle"></i></h5>
                                                        </div>
                                                        <div class="inpt-field">
                                                            <input type="text" name="l-name" placeholder="">
                                                        </div><!--inpt-field end-->
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit">Continuar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <h4>Adicionar conta Paypal</h4>
                                        </div>
                                    </div><!--add-billing-method end-->
                                </div><!--product-feed-tab end-->
                            </div><!--main-ws-sec end-->
                        </div>
                        <div class="col-lg-3" style="transform: translate(0px, 13.6em);">
                            <div class="right-sidebar">
                                <div class="message-btn d-none">
                                    <a href="#" title=""><i class="fa fa-envelope"></i>Mensagens</a>
                                </div>
                                <div class="widget widget-portfolio" style="display:none !important;visibility: hidden !important;">
                                    <div class="wd-heady">
                                        <h3>Portfólio</h3>
                                        <img src="images/photo-icon.png" alt="">
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

    <footer>
        <div class="footy-sec mn no-margin">
            <div class="container">
                <ul>
                    <li><a href="#" title="">Ajuda</a></li>
                    <li><a href="#" title="">Política de Privacidade</a></li>
                    <li><a href="#" title="">Carreira</a></li>
                    <li><a href="#" title="">Fórum</a></li>
                    <li><a href="#" title="">Fale Conosco</a></li>
                </ul>
                <p><img src="images/copy-icon2.png" alt="">Copyright 2020 - Universidade Presbiteriana Mackenzie</p>
            </div>
        </div>
    </footer>

    <div class="overview-box" id="overview-box">
        <div class="overview-edit">
            <h3>Visão geral</h3>
            <!-- <span>5000 caracteres restantes</span> -->
            <form method="POST" action="/usuario/atualizarVisaoGeral">
                <textarea id="edit-visao-geral" name="visao_geral"><?php echo $aViewVar['aUsuario']['visao_geral']; ?></textarea>
                <button id="btn-salvar-visao-geral" type="submit" class="save">Salvar</button>
                <button type="submit" class="cancel">Cancelar</button>
                <input type="hidden" name="id" value="<?php echo App\Lib\Auth::usuario()->id; ?>">
            </form>
            <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
        </div>
    </div>

    <!-- MODAL EXPERIENCIA -->
    <div class="overview-box" id="experience-box">
        <div class="overview-edit">
            <h3>Experiência</h3>
            <form method="post" action="/experiencia/salvar">
                <input type="text" name="titulo" placeholder="Título">
                <input type="hidden" name="id_usuario" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
                <textarea name="texto"></textarea>
                <button type="submit" class="save">Salvar</button>
                <button type="button" class="cancel">Cancelar</button>
            </form>
            <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
        </div>
    </div>

    <div class="overview-box" id="education-box">
        <div class="overview-edit">
            <h3>Educação</h3>
            <form method="post" action="/formacao/novo">
                <input type="hidden" name="id_usuario" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
                <input type="text" name="titulo" placeholder="Escola / Universidade">
                <div class="datepicky">
                    <div class="row">
                        <div class="col-lg-9 no-left-pd">
                            <div class="datefm">
                                <input type="text" class="data-formacao" name="ano_inicio" placeholder="Início (ex: mm/aaaa)" >
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <div class="col-lg-9 no-left-pd">
                            <div class="datefm">
                                <input type="text" name="ano_fim" class="data-formacao" placeholder="Conclusão (ex: mm/aaaa)" class="datepicker">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <input type="text" name="degree" placeholder="Degree"> -->
                <textarea name="texto" placeholder="Descrição"></textarea>
                <button type="submit" class="save">Salvar</button>
                <!-- <button type="submit" class="save-add">Salvar & adicionar mais</button> -->
                <button type="button" class="cancel">Cancelar</button>
            </form>
            <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
        </div>
    </div>

    <div class="overview-box" id="location-box">
        <div class="overview-edit">
            <h3>Localização</h3>
            <form method="post" action="/perfil/salvarLocalizacao">
                <input type="hidden" name="id_usuario" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
                <input name="titulo" type="text" placeholder="Estado/País">
                <input type="text" name="texto" placeholder="Endereço (ex: Av Ibirapuera, 1000 - SP)">
                <!--
               <div class="datefm">

                   <select>
                       <option>País</option>
                       <option value="pakistan">Paquistão</option>
                       <option value="england">Inglaterra</option>
                       <option value="india">India</option>
                       <option value="usa">Estados Unidos</option>
                   </select>
                   <i class="fa fa-globe"></i>

                </div>
                   -->
                <!--
                <div class="datefm">
                    <select>
                        <option>Cidade</option>
                        <option value="london">Londres</option>
                        <option value="new-york">Nova York</option>
                        <option value="sydney">Sydney</option>
                        <option value="chicago">Chicago</option>
                    </select>
                    <i class="fa fa-map-marker"></i>
                </div>
                -->
                <button type="submit" class="save">Salvar</button>
                <button type="button" class="cancel">Cancelar</button>
            </form>
            <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
        </div>
    </div>

    <div class="overview-box" id="skills-box">
        <div class="overview-edit">
            <h3>Habilidades</h3>
            <ul class="invisivel">
                <li><a href="#" title="" class="skl-name">HTML</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
                <li><a href="#" title="" class="skl-name">php</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
                <li><a href="#" title="" class="skl-name">css</a><a href="#" title="" class="close-skl"><i class="la la-close"></i></a></li>
            </ul>
            <form method="post" action="/habilidade/salvar">
                <input type="text" name="nome" placeholder="ex: PHP, Administração, Negociação...">
                <input type="hidden" name="id_usuario" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
                <button type="submit" class="save">Salvar</button>
                <!-- <button type="submit" class="save-add">Save & adicionar mais</button> -->
                <button type="button" class="cancel">Cancelar</button>
            </form>
            <a href="#" title="" class="close-box"><i class="la la-close"></i></a>
        </div>
    </div>

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

<!-- Modal -->
<div class="modal" id="modal-capa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Carregando a foto da Capa...</h5>
            </div>
            <div class="modal-body">
                Estamos quase lá, aguarde o término do carregamento... a foto será carreganda em instantes!
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = () => {
        $('.data-formacao').mask('00/0000')
    }
</script>


<!-- MODAL EDITAR NOME & PROFISSAO -->
<div id="modal-edit-nome-profissao" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form method="POST" action="/usuario/atualizar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atualizar Informações Pessoais</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        
                        <div class="form-group">
                            <label for="nome-sobrenome" class="col-form-label">Nome e Sobrenome:</label>
                            <input type="text" class="form-control" value="<?php echo $aViewVar['aUsuario']['nome']; ?>" name="nome" id="nome-sobrenome" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">E-mail:</label>
                            <input type="email" class="form-control" value="<?php echo $aViewVar['aUsuario']['email']; ?>" name="email" id="email" placeholder="seu-email@pesquisadores.com" required>
                        </div>
                        <div class="form-group">
                            <label for="dataNasc" class="col-form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control"  value="<?php echo $aViewVar['aUsuario']['data_nascimento']; ?>" name="data_nascimento" id="dataNasc" placeholder="dd/mm/aaaa" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-profissao" class="col-form-label">Profissão:</label>
                            <input type="text" class="form-control" value="<?php echo $aViewVar['aUsuario']['profissao']; ?>" name="profissao" id="edit-profissao" placeholder="Analista..." required>
                        </div>
                        <div class="form-group">
                            <label for="nivel-instrucao" class="col-form-label">Nível de Instrução:</label>
                            <input type="text" class="form-control" id="nivel-instrucao" name="nivel_instrucao" value="<?php echo $aViewVar['aUsuario']['nivel_instrucao']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="inicio-area" class="col-form-label">Quando iniciou na Área:</label>
                            <input type="text" class="form-control" id="inicio-area" name="inicio_trabalho" value="<?php echo $aViewVar['aUsuario']['inicio_trabalho']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cidade" class="col-form-label">Cidade:</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $aViewVar['aUsuario']['cidade']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="estado" class="col-form-label">Estado:</label>
                            <select class="form-control" name="estado" id="estado" required="">
                                <option>Selecione o Estado...</option>
                                <option value="AC" <?php echo $aViewVar['aUsuario']['estado'] == "AC" ? 'selected' : ''; ?> >Acre</option>
                                <option value="AL" <?php echo $aViewVar['aUsuario']['estado'] == "AL" ? 'selected' : ''; ?>>Alagoas</option>
                                <option value="AP" <?php echo $aViewVar['aUsuario']['estado'] == "AP" ? 'selected' : ''; ?>>Amapá</option>
                                <option value="AM" <?php echo $aViewVar['aUsuario']['estado'] == "AM" ? 'selected' : ''; ?>>Amazonas</option>
                                <option value="BA" <?php echo $aViewVar['aUsuario']['estado'] == "BA" ? 'selected' : ''; ?>>Bahia</option>
                                <option value="CE" <?php echo $aViewVar['aUsuario']['estado'] == "CE" ? 'selected' : ''; ?>>Ceará</option>
                                <option value="DF" <?php echo $aViewVar['aUsuario']['estado'] == "DF" ? 'selected' : ''; ?>>Distrito Federal</option>
                                <option value="ES" <?php echo $aViewVar['aUsuario']['estado'] == "ES" ? 'selected' : ''; ?>>Espírito Santo</option>
                                <option value="GO" <?php echo $aViewVar['aUsuario']['estado'] == "GO" ? 'selected' : ''; ?>>Goiás</option>
                                <option value="MA" <?php echo $aViewVar['aUsuario']['estado'] == "MA" ? 'selected' : ''; ?>>Maranhão</option>
                                <option value="MT" <?php echo $aViewVar['aUsuario']['estado'] == "MT" ? 'selected' : ''; ?>>Mato Grosso</option>
                                <option value="MS" <?php echo $aViewVar['aUsuario']['estado'] == "MS" ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                                <option value="MG" <?php echo $aViewVar['aUsuario']['estado'] == "MG" ? 'selected' : ''; ?>>Minas Gerais</option>
                                <option value="PA" <?php echo $aViewVar['aUsuario']['estado'] == "PA" ? 'selected' : ''; ?>>Pará</option>
                                <option value="PB" <?php echo $aViewVar['aUsuario']['estado'] == "PB" ? 'selected' : ''; ?>>Paraíba</option>
                                <option value="PR" <?php echo $aViewVar['aUsuario']['estado'] == "PR" ? 'selected' : ''; ?>>Paraná</option>
                                <option value="PE" <?php echo $aViewVar['aUsuario']['estado'] == "PE" ? 'selected' : ''; ?>>Pernambuco</option>
                                <option value="PI" <?php echo $aViewVar['aUsuario']['estado'] == "PI" ? 'selected' : ''; ?>>Piauí</option>
                                <option value="RJ" <?php echo $aViewVar['aUsuario']['estado'] == "RJ" ? 'selected' : ''; ?>>Rio de Janeiro</option>
                                <option value="RN" <?php echo $aViewVar['aUsuario']['estado'] == "RN" ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                                <option value="RS" <?php echo $aViewVar['aUsuario']['estado'] == "RS" ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                                <option value="RO" <?php echo $aViewVar['aUsuario']['estado'] == "RO" ? 'selected' : ''; ?>>Rondônia</option>
                                <option value="RR" <?php echo $aViewVar['aUsuario']['estado'] == "RR" ? 'selected' : ''; ?>>Roraima</option>
                                <option value="SC" <?php echo $aViewVar['aUsuario']['estado'] == "SC" ? 'selected' : ''; ?>>Santa Catarina</option>
                                <option value="SP" <?php echo $aViewVar['aUsuario']['estado'] == "SP" ? 'selected' : ''; ?>>São Paulo</option>
                                <option value="SE" <?php echo $aViewVar['aUsuario']['estado'] == "SE" ? 'selected' : ''; ?>>Sergipe</option>
                                <option value="TO" <?php echo $aViewVar['aUsuario']['estado'] == "TO" ? 'selected' : ''; ?>>Tocantins</option>
                            </select>
                        </div>
                    
                </div>
                <input type="hidden" name="id" value="<?php echo App\Lib\Auth::usuario()->id; ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button id="btn-atualizarInformacoes" type="submit" class="btn btn-primary">Atualizar Informações</button>
                </div>
            </div>
        </form>
    </div>
</div>


</body>