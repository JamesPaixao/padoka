<?php
    if(isset($_POST['modo'])){
        if($_POST['modo'] == 'visualizar'){
            if(isset($_POST['id'])){
                $id = $_POST['id'];

                require_once('conexao_bd.php');

                $conexao = conexaoMysql();

                $sqlQuerySelect = "select *
                from tblFaleConosco
                where idFaleConosco = " .$id;

                // echo($sqlQuerySelect);

                $selectFaleConosco = mysqli_query($conexao, $sqlQuerySelect);

                if($rsFaleConosco = mysqli_fetch_assoc($selectFaleConosco)){
                    $nome = $rsFaleConosco['nome'];
                    $telefone = $rsFaleConosco['telefone'];
                    $celular = $rsFaleConosco['celular'];
                    $email = $rsFaleConosco['email'];
                    $homePage = $rsFaleConosco['homePage'];
                    $linkFace = $rsFaleConosco['linkFacebook'];
                    $profissao = $rsFaleConosco['profissao'];
                    $intuito = $rsFaleConosco['intuito'];
                    $mensagem = $rsFaleConosco['mensagem'];
                    $genero = $rsFaleConosco['genero'];
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
                <div class="modal_fields  ">Nome:</div>

                <div class="modal_fields  ">Telefone:</div>

                <div class="modal_fields  ">Celular:</div>

                <div class="modal_fields  ">Email:</div>

                <div class="modal_fields  ">Home page (página pessoal):</div>

                <div class="modal_fields  ">Link do facebook:</div>

                <div class="modal_fields  ">Profissão:</div>

                <div class="modal_fields  ">Intuito:</div>

                <div class="modal_fields  ">Mensagem:</div>

                <div class="modal_fields  ">Genero:</div>
            </div>

            <div id="div_infos">
                <div class="modal_text  "><?=$nome?></div>

                <div class="modal_text  "><?=$telefone?></div>

                <div class="modal_text  "><?=$celular?></div>

                <div class="modal_text  "><?=$email?></div>

                <div class="modal_text  "><?=$homePage?></div>

                <div class="modal_text  "><?=$linkFace?></div>

                <div class="modal_text  "><?=$profissao?></div>

                <div class="modal_text  "><?php
                                                                    if($intuito == 'c'){
                                                                        echo('Crítica');
                                                                    }
                                                                    else{
                                                                        echo('Sugestão');
                                                                    }
                                                                ?></div>

                <div class="modal_text  "><?=$mensagem?></div>

                <div class="modal_text  "><?php
                                                                    if($genero == 'm'){
                                                                        echo('Masculino');
                                                                    }
                                                                    elseif($genero == 'f'){
                                                                        echo('Feminino');
                                                                    }
                                                                    else{
                                                                        echo('Outro');
                                                                    }
                                                                ?></div>
            </div>
        </div>
    </body>
</html>