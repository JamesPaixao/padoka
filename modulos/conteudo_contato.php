<div id="div_conteudo_paginas">
    <div id="div_secao_de_conteudo">
        <div id="div_form">
            <h1>ENTRE EM CONTATO COM A PADOKA</h1>

            <form name="fale_conosco_form" action="./modulos/fale_conosco_insert.php?modo=inserir" method="post">
                <div class="div_input">
                    Nome:
                    <input type="text" name="nome_input" class="inputs">
                </div>

                <div class="div_input">
                    Telefone:
                    <input type="text" name="telefone_input" class="inputs">
                </div>

                <div class="div_input">
                    Celular:
                    <input type="text" name="celular_input" class="inputs">
                </div>

                <div class="div_input">
                    Email:
                    <input type="email" name="email_input" class="inputs">
                </div>

                <div class="div_input">
                    Home Page (Página pessoal):
                    <input type="url" name="home_page_input" class="inputs">
                </div>

                <div class="div_input">
                    Link do Facebook:
                    <input type="url" name="face_input" class="inputs">
                </div>

                <div class="div_input">
                    Profissão:
                    <input type="text" name="profissao_input" class="inputs">
                </div>

                <div class="div_input">
                    Sexo: <p><br></p>
                    <input type="radio" name="sexo_input" value="m" id="m">Masculino
                    <input type="radio" name="sexo_input" value="f" id="f">Feminino
                    <input type="radio" name="sexo_input" value="x" id="x">Outro
                </div>

                <div class="div_input">
                    Desejo realizar uma: <p><br></p>
                    <input type="radio" name="intuito_mensagem_input" value="s" id="s">Sugestão
                    <input type="radio" name="intuito_mensagem_input" value="c" id="c">Critica
                </div>

                <div class="text_area_input">
                    Mensagem:
                    <textarea name="mensagem_input" cols="60" rows="10"></textarea>
                </div>

                <div class="submit_input">
                    <input type="submit" value="ENVIAR" name="enviar_submit">
                </div>
            </form>
        </div>
    </div>
</div>