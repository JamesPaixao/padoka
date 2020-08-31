<?php
    if(isset($_POST['modo'])){
        if($_POST['modo'] == 'visualizar'){
            if(isset($_POST['id'])){
                $id = $_POST['id'];

                require_once('conexao_bd.php');

                $conexao = conexaoMysql();

                $sqlQuerySelectUsuario = "select tblUsuario.*
                from tblUsuario
                where idUsuario = " .$id;

                $querySelectUsuario = mysqli_query($conexao, $sqlQuerySelectUsuario);

                if($rsUsuario = mysqli_fetch_assoc($querySelectUsuario)){
                    $nome = $rsUsuario['nome'];
                    $login = $rsUsuario['login'];
                    $senha = $rsUsuario['senha'];
                    $idNivelAcesso = $rsUsuario['idNivelAcesso'];
                }

                $sqlQuerySelectNivelAcesso = "select tblNivelAcesso.nomeNivel
                from tblNivelAcesso
                where idNivelAcesso = " .$idNivelAcesso;

                $querySelectNivelAcesso = mysqli_query($conexao, $sqlQuerySelectNivelAcesso);

                if($rsNivelAcesso = mysqli_fetch_assoc($querySelectNivelAcesso)){
                    $nomeNivelAcesso = $rsNivelAcesso['nomeNivel'];
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
            <div class="modal_title">Informações</div>

            <div id="div_modal_fields">
                <div class="modal_fields">Nome:</div>

                <div class="modal_fields">Login:</div>

                <div class="modal_fields">Senha:</div>

                <div class="modal_fields">Nivel Acesso:</div>
            </div>

            <div id="div_infos">
                <div class="modal_text"><?=$nome?></div>

                <div class="modal_text"><?=$login?></div>

                <div class="modal_text"><?=$senha?></div>

                <div class="modal_text"><?=$nomeNivelAcesso?></div>
            </div>
        </div>
    </body>
</html>