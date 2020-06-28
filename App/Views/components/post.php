<div class="post-bar content-vaga" data-id-vaga="<?php echo $post['id']; ?>" data-id-usuario-vaga="<?php echo $post['id_usuario']; ?>" data-titulo-vaga="<?php echo $post['titulo']; ?>">
    <div class="post_topbar">
        <div class="usy-dt">
        <!-- TODO: COLOCAR A FOTO DE PERFIL DO USUÁRIO -->
            <img src="http://via.placeholder.com/50x50" alt="">
            <div class="usy-name">
                <h3><?php echo $post['nome']; ?></h3>
                <span><img src="/public/images/clock.png" alt=""><?php echo $post['data_hora']; ?></span>
            </div>
        </div>
        <div class="ed-opts">
            <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
            <ul class="ed-options">
            <!-- TODO COLOCAR AQUI AS FUNCIONALIDADES DE CURTIR EDITAR ETC -->
                <li class="li-editar-vaga" data-id-vaga="<?php echo $post['id']; ?>" data-id-usuario-vaga="<?php echo $post['id_usuario']; ?>" data-titulo-vaga="<?php echo $post['titulo']; ?>" data-categoria-vaga="<?php echo $post['categoria']; ?>" data-habilidade-vaga="<?php echo $post['habilidade']; ?>" data-preco-vaga="<?php echo $post['preco']; ?>" data-integral-vaga="<?php echo $post['integral']; ?>" data-descricao-vaga="<?php echo $post['descricao']; ?>"><a href="#" title="">Editar esta postagem</a></li>
                <li class="li-excluir-vaga" data-id-vaga="<?php echo $post['id']; ?>" data-id-usuario-vaga="<?php echo $post['id_usuario']; ?>" data-titulo-vaga="<?php echo $post['titulo']; ?>"><a href="#" title="">Excluir postagem</a></li>
            </ul>
        </div>
    </div>
    <div class="epi-sec">
        <ul class="descp">
            <!-- TODO COLOCAR PUBLICAÇÃO OU POSTAGEM -->
            <li><img src="/public/images/icon8.png" alt=""><span><?php echo $post['categoria']; ?></span></li>
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
                <a href="javascript:void(0)" class="curtir-postagem" data-id-postagem="<?php echo $post['id']; ?>"><i class="la la-heart"></i>Curtir Postagem</a>
                <!-- <img src="/public/images/liked-img.png" alt=""> -->

            </li>
            <li>
                <a href="javascript:void(0)" title="CLIQUE PARA COMENTAR" data-id-postagem="<?php echo $post['id']; ?>" class="comentar"><i class="la la-comments-o"></i>Fazer Comentário</a>
            </li>
            <li>
                <a href="javascript:void(0)" title="VER COMENTARIOS" data-id-postagem="<?php echo $post['id']; ?>" class="comentarios"><i class="la la-envelope-o"></i>Ver Comentário</a>
            </li>
        </ul>
        <a><i class="la la-eye"></i>Visualizações 0</a>
        <br>
        <form action="/principal/comentar" method="post" class="mr-3 d-none form-comentario" form-id="<?php echo $post['id']; ?>">
            <input type="hidden" name="id_postagem" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="id_usuario" value="<?php  echo \App\Lib\Auth::usuario()->id; ?>">
            <div class="form-group">
                <textarea name="comentario" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-sm btn-primary float-right" style="background-color: #8b87aa;border-color: transparent;box-shadow: 0 8px 16px -8px black;">Postar Comentário</button>
        </form>
    </div>
</div>