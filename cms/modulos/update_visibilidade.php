<?php
    require_once('conexao_bd.php');
    $conexao = conexaoMysql();

    if($_GET['origem'] == 'pagina_conteudos'){
        $id = $_GET['id'];
        $visibilidadeAntiga = $_GET['visibilidadeAntiga'];
        $url = $_GET['url'];

        switch($visibilidadeAntiga){
            case "1":
                $novaVisibilidade = 0;
            break;

            case "0":
                $novaVisibilidade = 1;
            break;
        }

        $sqlQueryAtualizar = "
            update tblConteudo
            set visibilidade = ".$novaVisibilidade."
            where idConteudo = ".$id;

        if(mysqli_query($conexao, $sqlQueryAtualizar)){
            $url = $_GET['url'];
            echo($url);
            header('location:' . $url);
        }
        else{
            echo("
                <script>
                    alert('Erro ao executar o script!);

                    window.history.back();
                </script>
            ");
        }
    }
    elseif($_GET['origem'] == 'pagina_lojas'){
        $id = $_GET['id'];
        $visibilidadeAntiga = $_GET['visibilidadeAntiga'];
        $url = $_GET['url'];

        switch($visibilidadeAntiga){
            case "1":
                $novaVisibilidade = 0;
            break;

            case "0":
                $novaVisibilidade = 1;
            break;
        }

        $sqlQueryAtualizar = "
            update tblLoja
            set visibilidade = ".$novaVisibilidade."
            where idLoja = ".$id;

        if(mysqli_query($conexao, $sqlQueryAtualizar)){
            $url = $_GET['url'];
            echo($url);
            header('location:' . $url);
        }
        else{
            echo("
                <script>
                    alert('Erro ao executar o script!);

                    window.history.back();
                </script>
            ");
        }
    }
?>