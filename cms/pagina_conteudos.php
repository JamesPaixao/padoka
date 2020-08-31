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
                        $sqlQuerySelect = "select * from tblConteudo
                            where tblConteudo.destino = 'c'
                            order by tblConteudo.titulo";
                    break;

                    case "s":
                        $sqlQuerySelect = "select * from tblConteudo
                            where tblConteudo.destino = 's'
                            order by tblConteudo.titulo";
                    break;

                    default:
                        $sqlQuerySelect = "select * from tblConteudo order by tblConteudo.titulo";
                    break;
                }
            }
        }
    }
    else{
        $sqlQuerySelect = "select * from tblConteudo order by tblConteudo.titulo";
    }

    $titulo =  null;
    $imagem = null;
    $texto = null;
    $destino = null;

    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'editar'){
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $querySelectConteudo = "
                    select *
                    from tblConteudo
                    where tblConteudo.idConteudo = ".$id;
                
                $selectDados = mysqli_query($conexao, $querySelectConteudo);

                if($rsDados = mysqli_fetch_assoc($selectDados)){
                    $idConteudo = $rsDados['idConteudo'];
                    $titulo =  $rsDados['titulo'];
                    $imagemAntiga = $rsDados['imagem'];
                    $imagem = $imagemAntiga;
                    $texto = $rsDados['texto'];
                    $destino = $rsDados['destino'];

                    $action = "modulos/atualizar.php?modo=atualizar&origem=adm_conteudo&imagemAntiga=".$imagemAntiga."&id=".$idConteudo."&url=".$url;
                }
            }
        }   
    }
    else{
        $action = "modulos/inserir_conteudo.php?modo=inserir&url=".$url;
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
                            Titulo: <input type="text" name="titulo_input" value="<?=$titulo?>">
                        </div>

                        <div class="input_cadastro">
                            Texto: 
                            <textarea name="texto_area" id="" cols="30" rows="10"><?=$texto?></textarea>
                        </div>
                        <div class="input_cadastro">
                            Destino:
                            <select name="destino_select">
                                <option value="c" 
                                    <?php
                                        if($destino == 'c'){
                                            echo('selected');
                                        }
                                    ?>
                                >
                                    Curiosidades
                                </option>

                                <option value="s"
                                    <?php
                                        if($destino == 's'){
                                            echo('selected');
                                        }
                                    ?>        
                                >
                                    Sobre a Empresa
                                </option>
                            </select>
                        </div>
                    
                        <div class="botaoRegistrar">
                            <input type="submit" name="submit_cms" value="Registrar">
                        </div>
                    </form>
                </div>

                <form name="filtro_adm_fale_conosco" action="pagina_conteudos.php?modo=filtrar" method="post">
                    Filtro:
                    <input type="radio" name="input_filter" value="a" checked>Todos
                    <input type="radio" name="input_filter" value="c">Curiosidades
                    <input type="radio" name="input_filter" value="s">Sobre Empresa

                    <input type="submit" value="filtrar" name="botao_filtrar">
                </form>

                <div class="div_comentarios">
                    <div class="titulo_do_conteudo">Título</div>
                    <div class="imagem_do_conteudo">Imagem</div>
                    <div class="conteudo_destino_mensagem">Destino</div>
                    <div class="conteudo_texto">Texto</div>
                    <div class="visibilidade_conteudo">Visivel</div>
                </div>

                <?php
                    $i = 0;
                    while($rsSelect = mysqli_fetch_assoc($select)){
                        ?>
                            <div class="div_comentarios">
                                <div class="titulo_do_conteudo"><?=$rsSelect['titulo']?></div>
                                <div class="imagem_do_conteudo">
                                    <img src="arquivos/<?=$rsSelect['imagem']?>" class="imagens">
                                </div>
                                <div class="conteudo_destino_mensagem">
                                    <?php
                                        if($rsSelect['destino'] == 'c'){
                                            echo("Curiosidades");
                                        }
                                        else{
                                            echo("Sobre a empresa");
                                        }
                                    ?>
                                </div>
                                <div class="conteudo_texto"><?=$rsSelect['texto']?></div>
                                <div class="visibilidade_conteudo">
                                    <?php
                                        if( ($rsSelect['visibilidade']) == '1' ){
                                            echo("<img src='imagens/positivo.png' onclick=".'"'."mudarVisibilidade('".$rsSelect['idConteudo']."','".$rsSelect['visibilidade']."', 'pagina_conteudos', '".$url."')".'"'." class='visibilidadeIcone colorir_de_verde'>");
                                        }
                                        else{
                                            echo("<img src='imagens/negativo.png' onclick=".'"'."mudarVisibilidade('".$rsSelect['idConteudo']."','".$rsSelect['visibilidade']."', 'pagina_conteudos', '".$url."')".'"'." class='visibilidadeIcone colorir_de_vermelho'>");
                                        }
                                    ?>
                                </div>

                                <a onclick="return confirm('Deseja realmente excluir o registro?');"
                                href="./modulos/deletar.php?modo=excluir&id=<?=$rsSelect['idConteudo']?>&imagem=<?=$rsSelect['imagem']?>&origem=adm_conteudo&url=<?=$url?>">
                                    <div class="excluir"></div>
                                </a>

                                <div class="visualizar" onclick="visualizarConteudo(<?=$rsSelect['idConteudo']?>);"></div>

                                <a href="pagina_conteudos.php?modo=editar&id=<?=$rsSelect['idConteudo']?>">
                                    <div class="editar"></div>
                                </a>
                            </div>
                        <?php

                        $i++;
                    }   
                ?>
            </div>

            <div id="footer_cms">
                 James ⚝ Paixão
            </div>
        </div>
    </body>
</html>