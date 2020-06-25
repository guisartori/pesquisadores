
<footer class="d-none">
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

    <script type="text/javascript" src="/public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/js/popper.js"></script>
    <script type="text/javascript" src="/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/public/js/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="/public/js/slick.min.js"></script>
    <script type="text/javascript" src="/public/js/scrollbar.js"></script>
    <script type="text/javascript" src="/public/js/typeahead.js"></script>
    <script type="text/javascript" src="/public/js/sweetalert2.all.min.js"></script>

    <script type="text/javascript" src="/public/js/script.js"></script>

    <script>
        $(document).ready(function () {
           setTimeout(function () {
               $('#country').keyup(function(){
                   var query = $(this).val();
                   if(query != '')
                   {
                       $.ajax({
                           url:"/perfil/buscarUsuario",
                           method:"POST",
                           data:{query:query},
                           success:function(data)
                           {
                               $('#countryList').fadeIn();
                               $('#countryList').html(data);
                           }
                       });
                   }
               });
               $(document).on('click', 'li', function(){
                   $('#country').val($(this).text());
                   $('#countryList').fadeOut();
               });
           },500);
        });
    </script>

    <?php echo $aViewJs; ?>
</body>
</html>

