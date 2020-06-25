$(document).ready(function () {
   setTimeout(function () {
       //$('#data-nascimento').mask('00/00/0000');
       $('#data_validade_cartao').mask('00/0000')
   },250);


    $('body').on('click', function () {
        if ($('input#check-condicoes').is(':checked')) {
            $('#btn-cad-form').prop('disabled', false);
            $('#btn-cad-form').removeClass('disabled');
        } else {
            $('#btn-cad-form').prop('disabled', true);
            $('#btn-cad-form').addClass('disabled');
            $('#btn-cad-form').attr('alt', 'Você precisa ler e estar de acordo com os nossos Termos!');
            $('#btn-cad-form').attr('title', 'Você precisa ler e estar de acordo com os nossos Termos!');
        }
    });

    $('#tipo-conta').on('change', function () {
       if($(this).val() == 'GT') {
           $('.info-cartao').addClass('invisivel');
           $('#numero_cartao').prop('required', false);
           $('#nome_cartao').prop('required', false);
           $('#data_validade_cartao').prop('required', false);
           $('#cvc_cartao').prop('required', false);
       } else if($(this).val() == 'PG') {
           $('.info-cartao').removeClass('invisivel');
           $('#numero_cartao').prop('required', true);
           $('#nome_cartao').prop('required', true);
           $('#data_validade_cartao').prop('required', true);
           $('#cvc_cartao').prop('required', true);
       }
    });
});