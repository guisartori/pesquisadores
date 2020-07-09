<style>
    .topicos {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .topicos li {
        height: 40px;
        border: #444 1px solid;
        background: #dadada;
        border-radius: 2px;
        display: flex !important;
        padding: 8px !important;
        margin: 4px;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .topicos li.selected {
        background: #728062;
        border: green 1px solid;
        color: white;
    }
</style>

<body>

    <script>
        let countSelectedTopicos = 0

        function toggleTopicoInteresse(element, idTopico) {
            const idUsuario = $("#idUsuario").val();
            if ($(element).hasClass('selected')) {
                $(element).removeClass('selected')
                $.ajax({
                    url: '/topico/remove',
                    method: 'POST',
                    data: {
                        idUsuario,
                        idTopico
                    },
                });
                countSelectedTopicos--
            } else {
                $(element).addClass('selected')
                $.ajax({
                    url: '/topico/add',
                    method: 'POST',
                    data: {
                        idUsuario,
                        idTopico
                    },
                });
                countSelectedTopicos++
            }
            if (countSelectedTopicos >= 3) {
                $('#btContinue').attr("disabled", false);
            } else {
                $('#btContinue').attr("disabled", true);
            }
        }
    </script>
    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="user-profile-ov">
                            <h3>Tópicos de interesse</h3>
                            <p>Selecione pelo menos 3 tópicos de interesse</p>
                            <ul class="topicos">
                                <?php foreach ($aViewVar['topicos'] as $topico) { ?>
                                    <li class="<?php echo App\Lib\Util::verificaInteresse(App\Lib\Auth::usuario()->id, $topico['id']) ? 'selected' : ''; ?>" onclick="javascript: toggleTopicoInteresse(this, <?php echo $topico['id']; ?>)"><?php echo $topico['nome']; ?></li>
                                <?php } ?>
                            </ul>
                            <button class="btn btn-editar btn-sm" disabled onclick="javascript: window.location.href= '/principal'">Continue</button>
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