$(document).ready(function () {
    var idUsuario = $('#idUsuario').val();

    var getVisaoGeral = function() {
        $.ajax({
            url: '/perfil/getVisao',
            method: 'POST',
            data: {idUser: idUsuario},
            success: function (v) {
                $('#texto-visao-geral').text(v.visao);
            }
        });
    };

    setTimeout(function () {
        $.ajax({
            url: '/principal/verificaSeEhAmigo',
            method: 'POST',
            data: {de: $('#idUsuario').val(), para: $('#id-do-amigo').val()},
            success: function (v) {
                if(v.amigo == '1') {
                    $('#li-do-amigo').remove();
                } else if(v.amigo == '0') {

                }
            }
        });
    },500);


    setTimeout(function () {
        $.ajax({
            url: '/principal/getAmigosEmComum',
            method: 'POST',
            data: {de: $('#idUsuario').val(), para: $('#id-do-amigo').val()},
            success: function (v) {
               $('#amigosEmComum').html(v);
            }
        });
    },500);

    var verificaSeJaRecomendou = function (getIdPerfil, idUsuario) {
        $.ajax({
            url: '/perfil/verificarRecomendacao',
            method: 'POST',
            data: {idPerfil: getIdPerfil, idUser: idUsuario},
            success: function (v) {
                if(v.curtiu == '1') {
                    $('.la-thumbs-o-up').css('color', '#dc3545');
                    $('.recomendarPerfil').addClass('removerRecomendacao');
                    //$('.recomendarPerfil').removeAttr('data-id-perfil');
                    $('.recomendarPerfil').removeClass('recomendarPerfil');

                    $('.removerRecomendacao').on('click', function () {
                        getIdPerfil = $(this).attr('data-id-perfil');

                        $.ajax({
                            url: '/perfil/removerRecomendacao',
                            method: 'POST',
                            data: {idPerfil: getIdPerfil, idUser: idUsuario},
                            success: function (r) {
                                if(r.curtiu == '1') {
                                    $('.la-thumbs-o-up').css('color', '#dc3545');
                                } else if(r.curtiu == '0') {
                                    $('.la-thumbs-o-up').css('color', '#b2b2b2');
                                    $('.removerRecomendacao').addClass('recomendarPerfil');
                                    $('.removerRecomendacao').removeClass('removerRecomendacao');
                                    location.reload();
                                    stop();
                                }
                                refreshContadorLikes(getIdPerfil, idUsuario);
                                verificaSeJaRecomendou(getIdPerfil, idUsuario);
                            }
                        });
                    });

                } else if(v.curtiu == '0') {
                    $('.removerRecomendacao').addClass('recomendarPerfil');
                    $('.removerRecomendacao').removeClass('removerRecomendacao');
                }
                refreshContadorLikes(getIdPerfil, idUsuario);
            }
        });
    };

    verificaSeJaRecomendou($('.recomendarPerfil').attr('data-id-perfil'), $('#idUsuario').val());

    var refreshContadorLikes = function (idPerfil, idUsuario) {
        $.ajax({
           url: '/perfil/getLikes',
           method: 'POST',
           data: {idPerfil: idPerfil},
           success: function (l) {
               $('#qtd-likes').text(l.qtdRecomendacoes);
               verificaSeJaRecomendou(idPerfil, idUsuario);

               $('.removerRecomendacao').on('click', function () {
                   getIdPerfil = $(this).attr('data-id-perfil');

                   $.ajax({
                       url: '/perfil/removerRecomendacao',
                       method: 'POST',
                       data: {idPerfil: getIdPerfil, idUser: idUsuario},
                       success: function (r) {
                           if(r.curtiu == '1') {
                               $('.la-thumbs-o-up').css('color', '#dc3545');
                           } else if(r.curtiu == '0') {
                               $('.la-thumbs-o-up').css('color', '#b2b2b2');
                               $('.removerRecomendacao').addClass('recomendarPerfil');
                               $('.removerRecomendacao').removeClass('removerRecomendacao');
                               location.reload();
                               stop();
                           }
                           refreshContadorLikes(getIdPerfil, idUsuario);
                           verificaSeJaRecomendou(getIdPerfil, idUsuario);
                       }
                   });
               });
           }
        });
    };

    $('.recomendarPerfil').on('click', function () {
       getIdPerfil = $(this).attr('data-id-perfil');

       $.ajax({
          url: '/perfil/recomendarPerfil',
          method: 'POST',
          data: {idPerfil: getIdPerfil, idUser: idUsuario},
          success: function (r) {
              if(r.curtiu == '1') {
                $('.la-thumbs-o-up').css('color', '#dc3545');
                  $('.recomendarPerfil').addClass('removerRecomendacao');
                  //$('.recomendarPerfil').removeAttr('data-id-perfil');
                  $('.recomendarPerfil').removeClass('recomendarPerfil');

                  $('.removerRecomendacao').on('click', function () {
                      getIdPerfil = $(this).attr('data-id-perfil');

                      $.ajax({
                          url: '/perfil/removerRecomendacao',
                          method: 'POST',
                          data: {idPerfil: getIdPerfil, idUser: idUsuario},
                          success: function (r) {
                              if(r.curtiu == '1') {
                                  $('.la-thumbs-o-up').css('color', '#dc3545');
                              } else if(r.curtiu == '0') {
                                  $('.la-thumbs-o-up').css('color', '#b2b2b2');
                                  $('.removerRecomendacao').addClass('recomendarPerfil');
                                  $('.removerRecomendacao').removeClass('removerRecomendacao');
                                  location.reload();
                                  stop();
                              }
                              refreshContadorLikes(getIdPerfil, idUsuario);
                              verificaSeJaRecomendou(getIdPerfil, idUsuario);
                          }
                      });
                  });

              } else if(r.curtiu == '0') {

              }
              refreshContadorLikes(getIdPerfil, idUsuario);
          }
       });
    });
});
