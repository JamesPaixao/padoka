<?php
    require_once("./modulos/conexao_bd.php");
    $conexao = conexaoMysql();

    $dominio= $_SERVER['HTTP_HOST'];
    $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];

    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'filtrar'){
            if(isset($_POST['botao_filtrar'])){
                $filtro = $_POST['input_filter'];
                if($filtro != 'a'){
                    $sqlQuerySelect = "select * from tblFaleConosco where intuito = '" . $filtro . "'";    
                }
                else{
                    $sqlQuerySelect = "select * from tblFaleConosco";        
                }
                $select = mysqli_query($conexao, $sqlQuerySelect);
            }
        }
    }
    else{
        $sqlQuerySelect = "select * from tblFaleConosco";

        $select = mysqli_query($conexao, $sqlQuerySelect);
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
                <form name="filtro_adm_fale_conosco" action="./adm_fale_conosco.php?modo=filtrar" method="post">
                    Filtro:
                    <input type="radio" name="input_filter" value="a" checked>Todos
                    <input type="radio" name="input_filter" value="c">Críticas
                    <input type="radio" name="input_filter" value="s">Sugestões

                    <input type="submit" value="FILTRAR" name="botao_filtrar">
                </form>
                
                <div class="div_comentarios">
                    <div class="nome_comentario">Nome</div>
                    <div class="celular_comentario">Celular</div>
                    <div class="email_comentario">Email</div>
                    <div class="intuito_comentario">Intuito</div>
                    <div class="mensagem_comentario">Mensagem</div>
                </div>

                <?php
                    while($rsSelect = mysqli_fetch_assoc($select)){
                        ?>
                            <div class="div_comentarios">
                                <div class="nome_comentario"><?=$rsSelect['nome']?></div>
                                <div class="celular_comentario"><?=$rsSelect['celular']?></div>
                                <div class="email_comentario"><?=$rsSelect['email']?></div>
                                <div class="intuito_comentario"><?php
                                     if($rsSelect['intuito'] == 'c'){
                                        echo('Crítica');
                                    }
                                    else{
                                        echo('Sugestão');
                                    }
                                ?></div>
                                <div class="mensagem_comentario"><?=$rsSelect['mensagem']?></div>

                                <a onclick="return confirm('Deseja realmente excluir o registro?');"
                                href="./modulos/deletar.php?modo=excluir&id=<?=$rsSelect['idFaleConosco']?>&tabela=tblFaleConosco&coluna=idFaleConosco&url=<?=$url?>">
                                    <div class="excluir"></div>
                                </a>

                                <div class="visualizar" onclick="visualizar_fale_conosco(<?=$rsSelect['idFaleConosco']?>);"></div>
                            </div>
                        <?php
                ?>
            </div>
            <div id="footer_cms">
                 James ⚝ Paixão
            </div>
        </div>
    </body>
</html>