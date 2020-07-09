<body>

    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="user-profile-ov">
                            <h3>Tópicos de interesse</h3>
                            <ul class="topicos">
                                <?php foreach ($aViewVar['topicos'] as $topico) { ?>
                                    <li class="<?php echo App\Lib\Util::verificaInteresse(App\Lib\Auth::usuario()->id, $topico['id']) ? 'selected' : ''; ?>" onclick="javascript: toggleTopicoInteresse(this, <?php echo $topico['id']; ?>)"><?php echo $topico['nome']; ?></li>
                                <?php } ?>
                            </ul>
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