<style>
    .invisivel{
        display: none !important;
        visibility: hidden !important;
    }
</style>
<body class="sign-in">
    
    <div class="wrapper">
        <div class="sign-in-page">
            <div class="signin-popup">
                <div class="signin-pop">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cmp-info">
                                <h3 class="text-center" style="font-size: 1.75rem;color: #8a86a9;">Pesquisadores</h3>
                                <hr>
                                <img src="/public/images/logo2.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="login-sec">
                                <ul class="sign-control">
                                    <li data-tab="tab-1" class="current"><a href="#" title="">Entrar</a></li>
                                    <li data-tab="tab-2"><a href="#" title="">Cadastre-se!</a></li>
                                </ul>
                                <div class="sign_in_sec current" id="tab-1">

                                    <h3>Faça seu Login - Pesquisadores</h3>
                                    <form action="/login/entrar" method="post">
                                        <div class="row">
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="text" name="email" placeholder="E-mail">
                                                    <i class="la la-user"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="password" name="senha" placeholder="Senha">
                                                    <i class="la la-lock"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="checky-sec">
                                                    <div class="fgt-sec">
                                                        <input type="checkbox" name="cc" id="lembrar-de-mim">
                                                        <label for="lembrar-de-mim">
                                                            <span></span>
                                                        </label>
                                                        <small>Lembrar de mim</small>
                                                    </div>
                                                    <a href="principal.html" title="">Esqueceu sua senha?</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <button type="submit" value="submitBt">Entrar</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="sign_in_sec" id="tab-2">
                                    <div class="signup-tab">
                                        <ul>
                                            <li data-tab="tab-3" class="current invisivel"><a href="#" title="">Usuário</a></li>
                                            <li class="invisivel" data-tab="tab-4"><a href="#" title="">Empresa</a></li>
                                        </ul>
                                    </div>
                                    <div class="dff-tab current" id="tab-3">
                                        <form action="/login/salvar" method="post" id="formNovoUsuario">
                                            <div class="row">
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="nome" placeholder="Nome Completo" required>
                                                        <i class="la la-user"></i>
                                                    </div>
                                                    <div class="sn-field">
                                                        <input type="email" name="email" placeholder="Seu principal e-mail" required>
                                                        <i class="la la-mail-forward"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input id="data-nascimento" type="date" name="data_nascimento" placeholder="Data de Nascimento (dd/mm/aaaa)" required>
                                                        <i class="la la-globe"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input id="cpf" type="text" name="cpf" placeholder="CPF " required>
                                                        <i class="la la-globe"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="profissao" placeholder="Qual a sua profissão?" required>
                                                        <i class="la la-briefcase"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="nivel_instrucao" placeholder="Nível de Instrução" required>
                                                        <i class="la la-graduation-cap"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="inicio_trabalho" placeholder="Quando Iniciou na Area">
                                                        <i class="la la-globe"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="cidade" placeholder="Cidade" required>
                                                        <i class="la la-globe"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <select class="form-control" id="estado" name="estado" required>
                                                            <option>Selecione o Estado...</option>
                                                            <option value="AC">Acre</option>
                                                            <option value="AL">Alagoas</option>
                                                            <option value="AP">Amapá</option>
                                                            <option value="AM">Amazonas</option>
                                                            <option value="BA">Bahia</option>
                                                            <option value="CE">Ceará</option>
                                                            <option value="DF">Distrito Federal</option>
                                                            <option value="ES">Espírito Santo</option>
                                                            <option value="GO">Goiás</option>
                                                            <option value="MA">Maranhão</option>
                                                            <option value="MT">Mato Grosso</option>
                                                            <option value="MS">Mato Grosso do Sul</option>
                                                            <option value="MG">Minas Gerais</option>
                                                            <option value="PA">Pará</option>
                                                            <option value="PB">Paraíba</option>
                                                            <option value="PR">Paraná</option>
                                                            <option value="PE">Pernambuco</option>
                                                            <option value="PI">Piauí</option>
                                                            <option value="RJ">Rio de Janeiro</option>
                                                            <option value="RN">Rio Grande do Norte</option>
                                                            <option value="RS">Rio Grande do Sul</option>
                                                            <option value="RO">Rondônia</option>
                                                            <option value="RR">Roraima</option>
                                                            <option value="SC">Santa Catarina</option>
                                                            <option value="SP">São Paulo</option>
                                                            <option value="SE">Sergipe</option>
                                                            <option value="TO">Tocantins</option>
                                                        </select>
                                                        <i class="la la-map-marker"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd d-none" style="display: none;">
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="password" name="senha" placeholder="Senha" required>
                                                        <i class="la la-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <select class="form-control" id="tipo-conta" name="tipo" required>
                                                            <option>Selecione o tipo de Conta...</option>
                                                            <option value="0">Membro comum</option>
                                                            <option value="1">Pesquisador</option>
                                                        </select>
                                                        <i class="la la-link"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd invisivel" id="CL">
                                                    <div class="sn-field">
                                                        <input type="text" name="url" id="url" placeholder="Currículo Lattes">
                                                        <i class="la la-link"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="checky-sec st2">
                                                        <div class="fgt-sec">
                                                            <input type="checkbox" name="cc" id="check-condicoes">
                                                            <label for="check-condicoes">
                                                                <span></span>
                                                            </label>
                                                            <small>Sim, eu li e concordo com os Termos de Uso do Pesquisadores.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="checky-sec st2">
                                                        <div class="fgt-sec">
                                                            <input type="checkbox" name="ccbr" id="check-br">
                                                            <label for="check-br">
                                                                <span></span>
                                                            </label>
                                                            <small>Declaro que sou brasileiro &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <button class="disabled" id="btn-cad-form" type="submit" value="submitBt" disabled>Vamos começar!</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="send" id="send" value="0">
                                        </form>
                                    </div>
                                    <div class="dff-tab invisivel" id="tab-4">
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="company-name" placeholder="Nome da Empresa">
                                                        <i class="la la-building"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="country" placeholder="País">
                                                        <i class="la la-globe"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="password" name="password" placeholder="Senha">
                                                        <i class="la la-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="password" name="repeat-password" placeholder="Repita a Senha">
                                                        <i class="la la-lock"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="checky-sec st2">
                                                        <div class="fgt-sec">
                                                            <input type="checkbox" name="cc" id="c1">
                                                            <label for="c1">
                                                                <span></span>
                                                            </label>
                                                            <small>Sim, eu li e concordo com os Termos de Uso do Pesquisadores.</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <button id="btn-cad-form-empresa"  type="submit" value="submitBt">Vamos começar!</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = () => {
            $('#tipo-conta').on('change', (e)=> {
                if(e.target.value == 1){
                    $('#CL').removeClass("invisivel")
                } else {
                    !$('#CL').hasClass("invisivel") ? $('#CL').addClass("invisivel") : false
                }
            })
        }
    </script>