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

    .notificacoes {
        position: relative;
    }

    .notificacoes .badge {
        position: absolute;
        background: #33aa33;
        color: #fff;
        width: 16px;
        height: 16px;
        right: 20px;
        top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box-notificacoes {
        position: absolute;
        background: #ffffff;
        width: 450px;
        z-index: 99;
        min-height: 80px;
        box-shadow: 0px 9px 19px -8px rgba(0, 0, 0, 0.75);
        border-radius: 4px;
        right: 0px;
    }

    .divider {
        border-bottom: 1px solid #dadada;
    }

    .hidden {
        display: none !important;

    }

    .new {
        background: #dadada;
    }
</style>

<script>
    function abrirNotificacoes() {
        idNotificado = $("#id-logado").val();
        // alert(idNotificado)
        $.ajax({
            url: "/notificacao/visualizarNotificacao/",
            method: "POST",
            data: {
                idNotificado
            },
            success: (a) => {
                // console.log(a)
            }
        });
    }
</script>

<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="principal.html" title=""><img src="/public/images/logo.png" alt=""></a>
            </div>
            <div class="search-bar">
                <form>
                    <input type="text" name="country" autocomplete="off" id="country" placeholder="&#xF007; Pesquise por nome, email, etc..." class="typeahead" style="font-family:Arial, FontAwesome">
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

                    <li class="notificacoes">
                        <span class="badge <?php echo $aViewVar['qtdNovasNotificacoes'] == 0 ? 'hidden' : ''; ?>"><?php echo $aViewVar['qtdNovasNotificacoes'] ?></span>
                        <a href="#" title="" onmouseover="javascript: abrirNotificacoes()">
                            <span><i class="fa fa-bell" aria-hidden="true"></i></span>
                            Notificações
                        </a>
                        <ul class="box-notificacoes " id="boxNotificacoes">
                            <?php if (count($aViewVar['notificacoes']) > 0) { ?>
                                <?php foreach ($aViewVar['notificacoes'] as $notificacao) { ?>
                                    <li class="divider <?php echo $notificacao['status'] == 0 ? 'new' : ''; ?>"><?php echo $notificacao['texto']; ?></li>

                                <?php } ?>
                            <?php } else { ?>
                                <li>Nenhuma notificação</li>
                            <?php } ?>
                        </ul>
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
                    <a title=""><?php echo \App\Lib\Auth::usuario()->usuario; ?></a>
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