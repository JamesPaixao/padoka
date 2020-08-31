<div id="div_header">
    <div id="div_cms_nome">
        CMS - Sistema de Gerenciamento do Site
    </div>

    <div id="div_cms_imagem">
        <img src="./imagens/gerencia_logo_sem_fundo.png" alt="Logo do Sistema">
    </div>
</div>

<div id="div_menus_cms">
                <div id="div_itens_menu_cms">
                    <?php
                        if($_SESSION['acessoConteudo'] == '1'){
                            echo("
                                <div class='div_menu_itens'>
                                    <a href='adm_conteudo.php'>
                                        <div class='item_menu_imagem'>
                                            <img src='./imagens/gerencia_icone_preto_sem_fundo.png' alt='Icone opção'>
                                        </div>
            
                                        <div class='item_menu_nome'>Adm. Conteúdo</div>
                                    </a>
                                </div>
                            ");
                        }

                        if($_SESSION['acessoProduto'] == '1'){
                            echo("
                                <div class='div_menu_itens'>
                                    <a href='adm_produtos.php'>
                                        <div class='item_menu_imagem'>
                                            <img src='./imagens/bread.png' alt='Icone opção'>
                                        </div>
            
                                        <div class='item_menu_nome'>Adm. Produtos</div>
                                    </a>
                                </div>
                            ");
                        }

                        if($_SESSION['acessoUsuarios'] == '1'){
                            echo("
                                <div class='div_menu_itens'>
                                    <a href='adm_usuarios.php'>
                                        <div class='item_menu_imagem'>
                                            <img src='./imagens/reparar_icon.png' alt='Icone opção'>
                                        </div>
            
                                        <div class='item_menu_nome'>Adm. Usuários</div>
                                    </a>
                                </div>
                            ");
                        }

                        if($_SESSION['acessoFaleConosco'] == '1'){
                            echo("
                                <div class='div_menu_itens'>
                                    <a href='adm_fale_conosco.php'>
                                        <div class='item_menu_imagem'>
                                            <img src='./imagens/mensagem.png' alt='Icone opção'>
                                        </div>
            
                                        <div class='item_menu_nome'>Adm. Fale conosco</div>
                                    </a>
                                </div>
                            ");
                        }
                    ?>
                </div>
                <div id="div_mensagens_cms">
                    <div id="div_bem_vindo" class=" ">
                        Bem vindo, 
                        <?php
                            echo($_SESSION['nomeUsuario']);
                        ?>
                    </div>
                    <div id="div_logout" class=" ">
                        <a href="../index.php">Sair do Sistema</a>
                    </div>
                </div>
            </div>