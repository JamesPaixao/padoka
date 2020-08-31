<?php
    if(isset($_POST['modo'])){
        if($_POST['modo'] == 'visualizar'){
            if(isset($_POST['id'])){
                $id = $_POST['id'];

                require_once('conexao_bd.php');

                $conexao = conexaoMysql();

                $sqlQuerySelectNivelAcesso = "select tblLoja.*
                from tblLoja
                where idLoja = " .$id;

                // echo($sqlQuerySelect);

                $querySelectNivelAcesso = mysqli_query($conexao, $sqlQuerySelectNivelAcesso);

                if($rsSelect = mysqli_fetch_assoc($querySelectNivelAcesso)){
                    $nomeLoja = $rsSelect['nomeLoja'];
                    $fotoLoja = $rsSelect['fotoLoja'];
                    $textoLoja = $rsSelect['textoLoja'];
                    $visibilidade = $rsSelect['visibilidade'];
                    $enderecoLoja = $rsSelect['enderecoLoja'];
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
                <div class="modal_fields  ">Nome da Loja:</div>

                <div class="modal_imagefield  ">Foto da Loja:</div>

                <div class="modal_fields  ">Visivel:</div>

                <div class="modal_fields  ">Endereço da Loja:</div>

                <div class="modal_fields  ">Texto:</div>
            </div>

            <div id="div_infos">
                <div class="modal_text  "><?=$nomeLoja?></div>

                <div class="modal_image">
                    <img src="arquivos/<?=$fotoLoja?>" alt="<?=$fotoLoja?>">
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

                <div class="modal_text  "><?=$enderecoLoja?></div>

                <div class="modal_infos  "><?=$textoLoja?></div>
            </div>
        </div>
    </body>
</html>