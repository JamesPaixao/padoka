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
                    case "v":
                        $sqlQuerySelect = "select * from tblLoja
                            where tblLoja.visibilidade = 1
                            order by tblLoja.nomeLoja";
                    break;

                    case "n":
                        $sqlQuerySelect = "select * from tblLoja
                            where tblLoja.visibilidade = 0
                            order by tblLoja.nomeLoja";
                    break;

                    default:
                        $sqlQuerySelect = "select * from tblLoja order by tblLoja.nomeLoja";
                    break;
                }
            }
        }
    }
    else{
        $sqlQuerySelect = "select * from tblLoja order by tblLoja.nomeLoja";
    }

    $nome =  null;
    $imagem = null;
    $texto = null;
    $endereco = null;

    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'editar'){
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $querySelectConteudo = "
                    select *
                    from tblLoja
                    where tblLoja.idLoja = ".$id;
                
                $selectDados = mysqli_query($conexao, $querySelectConteudo);

                if($rsDados = mysqli_fetch_assoc($selectDados)){
                    $idLoja = $rsDados['idLoja'];
                    $nome =  $rsDados['nomeLoja'];
                    $imagemAntiga = $rsDados['fotoLoja'];
                    $imagem = $imagemAntiga;
                    $texto = $rsDados['textoLoja'];
                    $endereco = $rsDados['enderecoLoja'];

                    $action = "modulos/atualizar.php?modo=atualizar&origem=pagina_lojas&imagemAntiga=".$imagemAntiga."&id=".$idLoja."&url=".$url;
                }
            }
        }   
    }
    else{
        $action = "modulos/inserir_loja.php?modo=inserir&url=".$url;
    }

    $select = mysqli_query($conexao, $sqlQuerySelect);
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
                <div class="div_cadastro">
                    <div class="titulo_do_cadastro">Cadastro Conteúdo</div>

                    <form action="modulos/uploadImagem.php" name="formImagem" id="formImagem" method="POST" enctype="multipart/form-data">
                        <div class="input_cadastro">
                            Imagem: <input type="file" name="fleImagem" id="inputImagem" accept="image/png, image/gif, image/jpg, image/jpeg" value="<?=$imagem?>">
                        </div>

                        <div id="image_view">
                            <?php
                                if($imagem != null){
                                    echo("<img src='arquivos/" . $imagem . "'>");
                                }
                            ?>
                        </div>
                    </form>
                    
                    <form action="<?=$action?>" name="form_adm_conteudo" id="form_adm_conteudo" method="post" enctype="multipart/form-data">
                        <div class="input_cadastro">
                            Nome da Loja: <input type="text" name="nome_input" value="<?=$nome?>">
                        </div>

                        <div class="input_cadastro">
                            Endereco: <input type="text" name="endereco_input" value="<?=$endereco?>">
                        </div>

                        <div class="input_cadastro">
                            Texto: 
                            <textarea name="texto_area" id="" cols="30" rows="10"><?=$texto?></textarea>
                        </div>
                    
                        <div class="botaoRegistrar">
                            <input type="submit" name="submit_cms" value="Registrar">
                        </div>
                    </form>
                </div>

                <form name="filtro_adm_fale_conosco" action="pagina_lojas.php?modo=filtrar" method="post">
                    Filtro:
                    <input type="radio" name="input_filter" value="a" checked>Todos
                    <input type="radio" name="input_filter" value="v">Visivel
                    <input type="radio" name="input_filter" value="n">Não visivel
                    <input type="submit" value="filtrar" name="botao_filtrar">
                </form>
                
                <div class="div_comentarios">
                    <div class="nome_loja">Nome</div>
                    <div class="foto_loja">Imagem</div>
                    <div class="endereco_loja">Endereço</div>
                    <div class="texto_loja">Texto</div>
                    <div class="visibilidade_conteudo">Visivel</div>
                </div>

                <?php
                    while($rsSelect = mysqli_fetch_assoc($select)){
                        ?>
                            <div class="div_comentarios">
                                <div class="nome_loja"><?=$rsSelect['nomeLoja']?></div>
                                <div class="foto_loja">
                                    <img src="arquivos/<?=$rsSelect['fotoLoja']?>" class="imagens">
                                </div>
                                <div class="endereco_loja"><?=$rsSelect['enderecoLoja']?></div>
                                <div class="texto_loja"><?=$rsSelect['textoLoja']?></div>
                                <div class="visibilidade_conteudo">
                                    <?php
                                        if( ($rsSelect['visibilidade']) == '1' ){
                                            echo("<img src='imagens/positivo.png' onclick=".'"'."mudarVisibilidade('".$rsSelect['idLoja']."','".$rsSelect['visibilidade']."', 'pagina_lojas', '".$url."')".'"'." class='visibilidadeIcone colorir_de_verde'>");
                                        }
                                        else{
                                            echo("<img src='imagens/negativo.png' onclick=".'"'."mudarVisibilidade('".$rsSelect['idLoja']."','".$rsSelect['visibilidade']."', 'pagina_lojas', '".$url."')".'"'." class='visibilidadeIcone colorir_de_vermelho'>");
                                        }
                                    ?>
                                </div>

                                <a onclick="return confirm('Quer realmente excluir o registro?');"
                                href="./modulos/deletar.php?modo=excluir&id=<?=$rsSelect['idLoja']?>&imagem=<?=$rsSelect['fotoLoja']?>&origem=pagina_lojas&url=<?=$url?>">
                                    <div class="excluir"></div>
                                </a>

                                <div class="visualizar" onclick="visualizar_loja(<?=$rsSelect['idLoja']?>);"></div>

                                <a href="pagina_lojas.php?modo=editar&id=<?=$rsSelect['idLoja']?>">
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