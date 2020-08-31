<?php
    require_once('modulos/conexao_bd.php');
    $conexao = conexaoMysql();

    $dominio= $_SERVER['HTTP_HOST'];
    $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];

    if(isset($_POST['botao_filtrar'])){
        if($_GET['modo']){
            if($_GET['modo'] == 'filtrar'){
                $filtro = $_POST['input_filter'];

                switch($filtro){
                    case "c":
                        $sqlQuerySelectNiveis = "select tblNivelAcesso.*
                            from tblNivelAcesso
                            where tblNivelAcesso.acessoConteudo = 1
                            order by tblNivelAcesso.nomeNivel";
                    break;

                    case "f":
                        $sqlQuerySelectNiveis = "select tblNivelAcesso.*
                            from tblNivelAcesso
                            where tblNivelAcesso.acessoFaleConosco = 1
                            order by tblNivelAcesso.nomeNivel";
                    break;

                    case "p":
                        $sqlQuerySelectNiveis = "select tblNivelAcesso.*
                            from tblNivelAcesso
                            where tblNivelAcesso.acessoProduto = 1
                            order by tblNivelAcesso.nomeNivel";
                    break;

                    case "u":
                        $sqlQuerySelectNiveis = "select tblNivelAcesso.*
                            from tblNivelAcesso
                            where tblNivelAcesso.acessoUsuarios = 1
                            order by tblNivelAcesso.nomeNivel";
                    break;

                    default:                    
                        $sqlQuerySelectNiveis = "select * from tblNivelAcesso 
                        order by tblNivelAcesso.nomeNivel";
                    break;
                }
            }
        }
    }
    else{
        $sqlQuerySelectNiveis = "select * from tblNivelAcesso order by tblNivelAcesso.nomeNivel";
    }

    $querySelectNiveis = mysqli_query($conexao, $sqlQuerySelectNiveis);

    $action = "modulos/inserir_nivel_acesso.php?modo=inserir&url=" .$url;

    $idNivelAcesso = null;
    $nomeNivel = null;
    $acessoConteudo = null;
    $acessoFaleConosco = null;
    $acessoProdutos = null;
    $acessoUsuarios = null;

    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'editar'){
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $querySelectNivel = "
                    select tblNivelAcesso.*
                    from tblNivelAcesso
                    where tblNivelAcesso.idNivelAcesso = ".$id;
                
                $selectDados = mysqli_query($conexao, $querySelectNivel);

                if($rsInfoNivelAcesso = mysqli_fetch_assoc($selectDados)){
                    $idNivelAcesso = $rsInfoNivelAcesso['idNivelAcesso'];
                    $nomeNivel = $rsInfoNivelAcesso['nomeNivel'];
                    $acessoConteudo = $rsInfoNivelAcesso['acessoConteudo'];
                    $acessoFaleConosco = $rsInfoNivelAcesso['acessoFaleConosco'];
                    $acessoProdutos = $rsInfoNivelAcesso['acessoProduto'];
                    $acessoUsuarios = $rsInfoNivelAcesso['acessoUsuarios'];

                    $action = "modulos/atualizar.php?modo=atualizar&id=".$rsInfoNivelAcesso['idNivelAcesso']."&url=".$url."&origem=pagina_niveis_acesso";
                }
            }
        }
    }
?>

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
        <div id="modal">
            <div id="modal_content">
            </div>
        </div>

        <div id="div_cms">
            <?php
                require_once('modulos/menu.php');
            ?>

            <div id="div_submenus_cms">
                <form name="form_adm_nivel_acesso" action="<?=$action?>" method="post">
                    <div class="div_cadastro">
                        <div class="titulo_do_cadastro">Cadastro Nivel</div>

                        <div class="input_cadastro">
                            Nome do novo nível:
                            <input type="text" name="nome_nivel_input" required value="<?=$nomeNivel?>">
                        </div>

                        <div class="input_cadastro">
                            Acesso ao adm. Conteúdo:
                        </div>

                        <div class="input_cadastro">
                            <input type="radio" name="adm_conteudo_radio" value="1" 
                                <?php
                                    if($acessoConteudo == '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Sim

                            <input type="radio" name="adm_conteudo_radio" value="0" 
                                <?php
                                    if($acessoConteudo != '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Não
                        </div>

                        <div class="input_cadastro">
                            <!-- <input type="checkbox" name="cbxAdmFaleConosco" value="1" checked> -->
                            Acesso ao adm. Fale Conosco:
                        </div>

                        <div class="input_cadastro">
                            <input type="radio" name="adm_fale_conosco_radio" value="1"
                                <?php
                                    if($acessoFaleConosco == '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Sim
                            <input type="radio" name="adm_fale_conosco_radio" value="0" 
                                <?php
                                    if($acessoFaleConosco != '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Não
                        </div>

                        <div class="input_cadastro">
                            Acesso ao administrador de Produto:
                        </div>

                        <div class="input_cadastro">
                            <input type="radio" name="adm_produto_radio" value="1"
                                <?php
                                    if($acessoProdutos == '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Sim
                            <input type="radio" name="adm_produto_radio" value="0" 
                                <?php
                                    if($acessoProdutos != '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Não
                        </div>

                        <div class="input_cadastro">
                            Acesso ao adm. Usuário:
                        </div>

                        <div class="input_cadastro">
                            <input type="radio" name="adm_usuario_radio" value="1"
                                <?php
                                    if($acessoUsuarios == '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Sim
                            <input type="radio" name="adm_usuario_radio" value="0" 
                                <?php
                                    if($acessoUsuarios != '1'){
                                        echo("checked");
                                    }
                                ?>
                            >Não
                        </div>

                        <div class="botaoRegistrar">
                            <input type="submit" name="submit_cms" value="Registrar">
                        </div>
                    </div>
                </form>

                <form name="formAdmNiveisAcessoFiltro" action="pagina_niveis_acesso.php?modo=filtrar" method="post">
                    Filtro:
                    <input type="radio" name="input_filter" value="a" checked>Todos
                    <input type="radio" name="input_filter" value="c">Conteúdo
                    <input type="radio" name="input_filter" value="f">Fale Conosco
                    <input type="radio" name="input_filter" value="p">Produtos
                    <input type="radio" name="input_filter" value="u">Usuários

                    <input type="submit" value="filtrar" name="botao_filtrar">
                </form>
                
                <div class="div_comentarios">
                    <div class="nome_nivel">Nome Nivel</div>
                    <div class="nivel_permissao">Acesso Conteúdo</div>
                    <div class="nivel_permissao">Acesso Fale Conosco</div>
                    <div class="nivel_permissao">Acesso Produto</div>
                    <div class="nivel_permissao">Acesso Usuário</div>
                </div>

                <?php
                    while($rsSelect = mysqli_fetch_assoc($querySelectNiveis)){
                        ?>
                            <div class="div_comentarios">
                                <div class="nome_nivel"><?=$rsSelect['nomeNivel']?></div>

                                <div class="nivel_permissao">
                                    <?php
                                        if($rsSelect['acessoConteudo'] == 1){
                                            echo('Sim');
                                        }
                                        else{
                                            echo('Não');
                                        }
                                    ?>
                                </div>

                                <div class="nivel_permissao">
                                    <?php
                                        if($rsSelect['acessoFaleConosco'] == 1){
                                            echo('Sim');
                                        }
                                        else{
                                            echo('Não');
                                        }
                                    ?>
                                </div>

                                <div class="nivel_permissao">
                                    <?php
                                        if($rsSelect['acessoProduto'] == 1){
                                            echo('Sim');
                                        }
                                        else{
                                            echo('Não');
                                        }
                                    ?>
                                </div>

                                <div class="nivel_permissao">
                                    <?php
                                        if($rsSelect['acessoUsuarios'] == 1){
                                            echo('Sim');
                                        }
                                        else{
                                            echo('Não');
                                        }
                                    ?>
                                </div>

                                <a onclick="return confirm('Deseja realmente excluir o registro? Todos os usuários que utilizam este nível de acesso também serão excluídos!    ');"
                                href="modulos/deletar_nivel_acesso.php?modo=excluir&id=<?=$rsSelect['idNivelAcesso']?>&url=<?=$url?>">
                                    <div class="excluir"></div>
                                </a>

                                <div class="visualizar" onclick="visualizarNivelAcesso(<?=$rsSelect['idNivelAcesso']?>);"></div>

                                <a href="pagina_niveis_acesso.php?modo=editar&id=<?=$rsSelect['idNivelAcesso']?>">
                                    <div class="editar"></div>
                                </a>
                            </div>
                        <?php
                    }
                ?>
            </div>

            <div id="footer_cms">
                 James ⚝ Paixão
            </div>
        </div>
    </body>
</html>