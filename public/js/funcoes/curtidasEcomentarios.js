$(document).ready(function () {
    
    $('.curtir-postagem').on('click', function () {

        var idPost = $(this).attr('data-id-postagem');
        var idUsuario = $('#id-logado').val();

        if (!$(this).hasClass('text-danger')){
            $.ajax({
                url:"/curtir",
                method:"POST",
                data:{idUsuario, idPost},
                success:function(n){
                        Swal.fire({
                            icon: 'success',
                            title: 'Você curtiu uma publicacção',
                            showCloseButton: false,
                            showCancelButton: false,
                            focusConfirm: false,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    $('a[data-id-postagem="'+idPost+'"].curtir-postagem').addClass('text-danger');
                }
            });
        } else {
            $.ajax({
                url:"/curtir/descurtir",
                method:"POST",
                data:{idUsuario, idPost},
                success:function(){
                    Swal.fire({
                        icon: 'success',
                        title: 'Curtida Removida',
                        showCloseButton: false,
                        showCancelButton: false,
                        focusConfirm: false,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('a[data-id-postagem="'+idPost+'"].curtir-postagem').removeClass('text-danger');
                }
            })
        }

    });


    //COMENTARIO
    $('.comentar').on('click', function () {
        var idPublicacao = $(this).attr('data-id-postagem');

        $('.form-comentario[form-id="'+idPublicacao+'"]').removeClass('d-none');

    });

    $('.comentarios').on('click', function () {
        var idPost = $(this).attr('data-id-post');
        $.ajax({
            url:"/comentario/todos/",
            method:"POST",
            data:{id_post: idPost},
            success:function(n){
                $('#modal-comentarios').modal('show');
                $('.content-coments').html(n);
            }
        });
    });
});