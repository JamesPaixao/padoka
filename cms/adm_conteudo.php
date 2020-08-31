<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CMS</title>

        <?php
            require_once('modulos/imports.php');
        ?>
    </head>

    <body>
        <div id="div_cms">
            <?php
                require_once('modulos/menu.php');
            ?>

            <div id="div_submenus_cms">
                <div class="div_menu_itens">
                    <a href="pagina_conteudos.php">
                        <div class="item_menu_imagem">
                            <img src="./imagens/conteudo.png" alt="Icone da opção">
                        </div>

                        <div class="item_menu_nome">Conteúdos</div>
                    </a>
                </div>

                <div class="div_menu_itens">
                    <a href="pagina_lojas.php">
                        <div class="item_menu_imagem">
                            <img src="./imagens/loja.png" alt="Icone da opção">
                        </div>

                        <div class="item_menu_nome">Lojas</div>
                    </a>
                </div>
            </div>

            <div id="footer_cms">
                 James ⚝ Paixão
            </div>
        </div>
    </body>
</html>