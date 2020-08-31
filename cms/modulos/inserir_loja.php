<?php
    require_once('conexao_bd.php');
    $conexao = conexaoMysql();

    if(isset($_POST['submit_cms'])){
        if($_GET['modo']){
            if($_GET['modo'] == 'inserir'){
                $nome = $_POST['nome_input'];
                $texto = $_POST['texto_area'];
                $endereco = $_POST['endereco_input'];

                session_start();
                $imagem = $_SESSION['imagem_nome'];

                $sqlQueryInsert = "
                    insert into tblLoja (
                        nomeLoja, enderecoLoja, fotoLoja, textoLoja, visibilidade
                    )
                    values ( '".$nome."', '".$endereco."', '".$imagem."', '".$texto."', '1' );
                ";

                if(mysqli_query($conexao, $sqlQueryInsert)){
                    $url = $_GET['url'];
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
        }
    }
?>