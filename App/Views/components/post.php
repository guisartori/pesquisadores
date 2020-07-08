<?php
$idUsuarioLogado = \App\Lib\Auth::usuario()->id;

?>
<?php if ($post['tipo'] == 0) { ?>
    <div class="post-bar content-vaga" data-id-vaga="<?php echo $post['id']; ?>" data-id-usuario-vaga="<?php echo $post['id_usuario']; ?>" data-titulo-vaga="<?php echo $post['titulo']; ?>">
        <div class="post_topbar">
            <div class="usy-dt" style="cursor: pointer" onClick="javascript: abrirPerfilUsuario(<?php echo $post['id_usuario']; ?>)">
                <img style="width: 50px; height: 50px" src="<?php echo ($post['foto_perfil']) ? $post['foto_perfil'] : "http://via.placeholder.com/50x50"; ?>" alt="">
                <div class="usy-name">
                    <h3><?php echo $post['nome']; ?></h3>
                    <!-- <span><img src="/public/images/clock.png" alt=""><?php //echo \App\Lib\Util::convertDate($post['data_hora']); 
                                                                            ?></span> -->
                </div>
            </div>
            <div class="ed-opts" style="<?php echo $idUsuarioLogado == $post['id_usuario'] ? '' : 'display:none'; ?>">
                <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                <ul class="ed-options">
                    <li class="li-editar-post" data-id-post="<?php echo $post['id']; ?>" data-titulo-post="<?php echo $post['titulo']; ?>" data-texto-post="<?php echo $post['texto']; ?>"><a href="#" title="">Editar esta postagem</a></li>
                    <li class="li-excluir-post" data-id-post="<?php echo $post['id']; ?>"><a href="#" title="">Excluir postagem</a></li>
                </ul>
            </div>
        </div>
        <div class="epi-sec">
            <ul class="descp">
                <!-- TODO COLOCAR PUBLICAÇÃO OU POSTAGEM -->
                <li><img src="/public/images/icon8.png" alt=""><span><?php echo $post['categoria']; ?>Post</span></li>
                <li><img src="/public/images/icon9.png" alt=""><span>Brasil</span></li>
            </ul>

        </div>
        <div class="job_descp">
            <h3><?php echo $post['titulo']; ?></h3>
            <p><?php echo $post['texto']; ?></p>
        </div>
        <div class="job-status-bar">
            <ul class="like-com">
                <li>
                    <a href="javascript:void(0)" class="curtir-postagem <?php echo (App\Lib\Util::taCurtido($post['id'], $idUsuarioLogado)) ? 'text-danger' : ''; ?>" data-id-postagem="<?php echo $post['id']; ?>">
                        <?php echo App\Lib\Util::qtdCurtidas($post['id']); ?> &nbsp;
                        <i class="la la-heart"></i>Curtir Postagem
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" title="CLIQUE PARA COMENTAR" data-id-postagem="<?php echo $post['id']; ?>" class="comentar"><i class="la la-comments-o"></i>Fazer Comentário</a>
                </li>
                <li>
                    <a href="javascript:void(0)" title="VER COMENTARIOS" data-id-post="<?php echo $post['id']; ?>" class="comentarios"><i class="la la-envelope-o"></i>Ver Comentário</a>
                </li>
            </ul>
            <form action="/comentario/novo" method="post" class="mr-3 d-none form-comentario" form-id="<?php echo $post['id']; ?>">
                <input type="hidden" name="id_post" value="<?php echo $post['id']; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo \App\Lib\Auth::usuario()->id; ?>">
                <div class="form-group">
                    <textarea name="texto" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary float-right" style="background-color: #8b87aa;border-color: transparent;box-shadow: 0 8px 16px -8px black;">Comentar</button>
            </form>
        </div>
    </div>
<?php } else { ?>
    <div class="post-bar content-vaga" data-id-vaga="<?php echo $post['id']; ?>" data-id-usuario-vaga="<?php echo $post['id_usuario']; ?>" data-titulo-vaga="<?php echo $post['titulo']; ?>">
        <div class="post_topbar">
            <div class="usy-dt" style="cursor: pointer" onClick="javascript: abrirPerfilUsuario(<?php echo $post['id_usuario']; ?>)">
                <img style="width: 50px; height: 50px" src="<?php echo ($post['foto_perfil']) ? $post['foto_perfil'] : "http://via.placeholder.com/50x50"; ?>" alt="">
                <div class="usy-name">
                    <h3><?php echo $post['nome']; ?></h3>
                    <!-- <span><img src="/public/images/clock.png" alt=""><?php //echo \App\Lib\Util::convertDate($post['data_hora']); 
                                                                            ?></span> -->
                </div>
            </div>
            <div class="ed-opts" style="<?php echo $idUsuarioLogado == $post['id_usuario'] ? '' : 'display:none'; ?>">
                <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                <ul class="ed-options">
                    <li class="li-editar-post" data-id-post="<?php echo $post['id']; ?>" data-titulo-post="<?php echo $post['titulo']; ?>" data-texto-post="<?php echo $post['texto']; ?>"><a href="#" title="">Editar esta postagem</a></li>
                    <li class="li-excluir-post" data-id-post="<?php echo $post['id']; ?>"><a href="#" title="">Excluir postagem</a></li>
                </ul>
            </div>
        </div>
        <div class="epi-sec">
            <ul class="descp">
                <!-- TODO COLOCAR PUBLICAÇÃO OU POSTAGEM -->
                <li><img src="/public/images/icon8.png" alt=""><span>Publicação</span></li>
                <li><img src="/public/images/icon9.png" alt=""><span><?php echo $post['local']; ?></span></li>
                <li><img src="/public/images/price1.png" alt=""><span><?php echo $post['ano_publicacao']; ?></span></li>
                <?php if ($post['url'] != '') { ?><li><span><a target="_blank" href="//<?php echo $post['url']; ?>">Artigo</a></span></li> <?php } ?>
                <?php if ($post['arquivo'] != '') { ?><li><span><a target="_blank" href="<?php echo $post['arquivo']; ?>" download>Download</a></span></li> <?php } ?>
            </ul>

        </div>
        <div class="job_descp">
            <h3><?php echo $post['titulo']; ?></h3>
            <p><?php echo $post['texto']; ?></p>
        </div>
        <div class="job-status-bar">
            <ul class="like-com">
                <li>
                    <a href="javascript:void(0)" class="curtir-postagem <?php echo (App\Lib\Util::taCurtido($post['id'], $idUsuarioLogado)) ? 'text-danger' : ''; ?>" data-id-postagem="<?php echo $post['id']; ?>">
                        <?php echo App\Lib\Util::qtdCurtidas($post['id']); ?> &nbsp;
                        <i class="la la-heart"></i>Curtir Postagem
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" title="CLIQUE PARA COMENTAR" data-id-postagem="<?php echo $post['id']; ?>" class="comentar"><i class="la la-comments-o"></i>Fazer Comentário</a>
                </li>
                <li>
                    <a href="javascript:void(0)" title="VER COMENTARIOS" data-id-post="<?php echo $post['id']; ?>" class="comentarios"><i class="la la-envelope-o"></i>Ver Comentário</a>
                </li>
            </ul>
            <form action="/comentario/novo" method="post" class="mr-3 d-none form-comentario" form-id="<?php echo $post['id']; ?>">
                <input type="hidden" name="id_post" value="<?php echo $post['id']; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo \App\Lib\Auth::usuario()->id; ?>">
                <div class="form-group">
                    <textarea name="texto" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary float-right" style="background-color: #8b87aa;border-color: transparent;box-shadow: 0 8px 16px -8px black;">Comentar</button>
            </form>
        </div>
    </div>
<?php } ?>

<script>
    function abrirPerfilUsuario(idUsuario) {
        window.location.href = "/usuario/perfil/" + idUsuario;
    }
</script>

<div class="modal fade" id="modal-confirmacao-exluir-vaga" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-light">
                <h5 class="modal-title" id="exampleModalLabel">Tem certeza?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="cursor: pointer !important;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <strong>Realmente deseja excluir o post?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal" style="cursor: pointer !important;">Cancelar exclusão</button>
                <button id="excluirPostagem" type="button" class="btn btn-danger" style="cursor: pointer !important;">Sim, quero excluir esta postagem!</button>
            </div>
        </div>
    </div>
</div>

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