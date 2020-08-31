<?php
    if(isset($_POST['modo'])){
        if($_POST['modo'] == 'visualizar'){
            if(isset($_POST['id'])){
                $id = $_POST['id'];

                require_once('conexao_bd.php');

                $conexao = conexaoMysql();

                $sqlQuerySelectNivelAcesso = "select tblConteudo.*
                from tblConteudo
                where idConteudo = " .$id;

                $querySelectNivelAcesso = mysqli_query($conexao, $sqlQuerySelectNivelAcesso);

                if($rsSelect = mysqli_fetch_assoc($querySelectNivelAcesso)){
                    $titulo = $rsSelect['titulo'];
                    $imagem = $rsSelect['imagem'];
                    $texto = $rsSelect['texto'];
                    $visibilidade = $rsSelect['visibilidade'];
                    $destino = $rsSelect['destino'];
                }
            }
        }
    }
?>

<html>
    <head>
        <title>Visualizar Contatos</title>

        <?php
            require_once('imports.php');
        ?>
    </head>

    <body>
        <a class="fechar"></a>

        <div id="modal_content">
            <div class="modal_title  ">Informações</div>

            <div id="div_modal_fields">
                <div class="modal_fields  ">Titulo:</div>

                <div class="modal_imagefield  ">Imagem:</div>

                <div class="modal_fields  ">Visivel:</div>

                <div class="modal_fields  ">Destino:</div>

                <div class="modal_fields  ">Texto:</div>
            </div>

            <div id="div_infos">
                <div class="modal_text  "><?=$titulo?></div>

                <div class="modal_image">
                    <img src="arquivos/<?=$imagem?>" alt="<?=$imagem?>">
                </div>

                <div class="modal_text  ">
                    <?php
                        if($visibilidade == 1){
                            echo('Sim');
                        }
                        else{
                            echo('Não');
                        }
                    ?>
                </div>

                <div class="modal_text  ">
                    <?php
                        if($destino == 'c'){
                            echo('Curiosidades');
                        }
                        else{
                            echo('Sobre a Empresa');
                        }
                    ?>
                </div>

                <div class="modal_infos  "><?=$texto?></div>
            </div>
        </div>
    </body>
</html>