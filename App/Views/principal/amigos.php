<input type="hidden" id="id-logado" value="<?php echo \App\Lib\Auth::usuario()->id; ?>">
<input type="hidden" id="id-amigo">
<input type="hidden" id="nome-amigo">
<input type="hidden" id="nome-logado" value="<?php echo \App\Lib\Auth::usuario()->usuario; ?>">
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


                            </div>
                            <div class="post-topbar">
                                <h3>Seguidores</h3>
                            </div>
                            <div class="post-bar">
                                <div class="companies-list">
                                    <div id="content-amigos" class="row">
                                        <?php foreach ($aViewVar['seguidores'] as $seguidor) { ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                                <div class="company_profile_info">
                                                    <div class="company-up-info card-item-amigos">
                                                        <img src="<?php echo ($seguidor['foto_perfil']) ? $seguidor['foto_perfil'] : "/public/uploads/fotoPerfil/profile-default.png"; ?>" alt="">

                                                        <h3><?php echo $seguidor['nome']; ?></h3>
                                                        <h4><?php echo $seguidor['profissao']; ?></h4>
                                                    </div>
                                                    <a href="/usuario/perfil/<?php echo $seguidor['id']; ?>" data-id-search="<?php echo $seguidor['id']; ?>" title="" class="view-more-pro">Ver Perfil</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>

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
        <h3>Post a job</h3>
        <div class="post-project-fields">
            <form>
                <div class="row">
                    <div class="col-lg-12">
                        <input type="text" name="title" placeholder="Título">
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
</div>