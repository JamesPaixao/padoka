<?php
    if(isset($_POST['modo'])){
        if($_POST['modo'] == 'visualizar'){
            if(isset($_POST['id'])){
                $id = $_POST['id'];

                require_once('conexao_bd.php');

                $conexao = conexaoMysql();

                $sqlQuerySelectNivelAcesso = "select tblNivelAcesso.*
                from tblNivelAcesso
                where idNivelAcesso = " .$id;

                // echo($sqlQuerySelect);

                $querySelectNivelAcesso = mysqli_query($conexao, $sqlQuerySelectNivelAcesso);

                if($rsNivelAcesso = mysqli_fetch_assoc($querySelectNivelAcesso)){
                    $nomeNivel = $rsNivelAcesso['nomeNivel'];
                    $conteudo = $rsNivelAcesso['acessoConteudo'];
                    $faleConosco = $rsNivelAcesso['acessoFaleConosco'];
                    $produto = $rsNivelAcesso['acessoProduto'];
                    $usuarios = $rsNivelAcesso['acessoUsuarios'];
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

                <div class="modal_fields  ">Acesso ao adm. Conteúdo:</div>

                <div class="modal_fields  ">Acesso ao adm. Fale Conosco:</div>

                <div class="modal_fields  ">Acesso ao adm. Produto:</div>

                <div class="modal_fields  ">Acesso ao adm. Usuários:</div>
            </div>

            <div id="div_infos">
                <div class="modal_text  "><?=$nomeNivel?></div>

                <div class="modal_text  ">
                    <?php
                        if($conteudo == 1){
                            echo('Sim');
                        }
                        else{
                            echo('Não');
                        }
                    ?>
                </div>

                <div class="modal_text  ">
                    <?php
                        if($faleConosco == 1){
                            echo('Sim');
                        }
                        else{
                            echo('Não');
                        }
                    ?>
                </div>

                <div class="modal_text  ">
                    <?php
                        if($produto == 1){
                            echo('Sim');
                        }
                        else{
                            echo('Não');
                        }
                    ?>
                </div>

                <div class="modal_text  ">
                    <?php
                        if($usuarios == 1){
                            echo('Sim');
                        }
                        else{
                            echo('Não');
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>