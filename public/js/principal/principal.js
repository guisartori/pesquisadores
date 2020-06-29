$(document).ready(function () {
    var excluirPost = function(idPost) {
        $.ajax({
           url: '/post/excluir',
           method: 'POST',
           data: {id_post: idPost},
           success: function (d) {
            console.log(d)
               Swal.fire({
                   position: 'center',
                   icon: 'success',
                   title: 'Publicação excluída!',
                   showConfirmButton: false,
                   timer: 1500
               });
               setTimeout(function () {
                   window.location.reload();
               },1500);
           }
        });
    };

    var editarVaga = function(idPost, titulo, texto) {
        $.ajax({
            url: '/post/editar',
            method: 'POST',
            data: {id: idPost, titulo: titulo, texto: texto},
            success: function (d) {
                Swal.fire({
                    icon: 'success',
                    title: 'Publicação Alterada!',
                    text: 'Sua publicação foi alterada com sucesso!',
                    showConfirmButton: false,
                    timer: 1500,
                })
                setTimeout(function () {
                    window.location.reload()
                    // window.location.href = "https://app-pesquisadores.herokuapp.com/principal/";
                },1600);
            }
        });
    };

    $('.li-editar-post').on('click', function () {
       var idPost = $(this).attr('data-id-post');
       var titulo = $(this).attr('data-titulo-post');
       var texto = $(this).attr('data-texto-post');

       $('#modal-editar-vaga').on('show.bs.modal', function (event) {
            $('#titulo-publicacao-editar').text(titulo);

            $('.titulo-editar-vaga').val(titulo);
            $('.descricao-editar-vaga').val(texto);

            $('#btn-editar-vaga').on('click', function () {
                var tituloEdit = $('.titulo-editar-vaga').val();
                var textoEdit = $('.descricao-editar-vaga').val();

                setTimeout(function () {
                    editarVaga(idPost, tituloEdit, textoEdit);
                },150);
                $('#modal-editar-vaga').modal('hide');
            });
        });

        $('#modal-editar-vaga').modal('show');

    });

    $('.li-excluir-post').on('click', function () {
       var idPost = $(this).attr('data-id-post');

        $('#modal-confirmacao-exluir-vaga').on('show.bs.modal', function (event) {

            $('#excluirPostagem').on('click', function () {
                excluirPost(idPost);
                $('#modal-confirmacao-exluir-vaga').modal('hide');
            });
        });

        $('#modal-confirmacao-exluir-vaga').modal('show');

    });


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});