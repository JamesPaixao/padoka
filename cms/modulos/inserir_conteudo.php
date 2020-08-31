<?php
    require_once('conexao_bd.php');
    $conexao = conexaoMysql();

    if(isset($_POST['submit_cms'])){
        if($_GET['modo']){
            if($_GET['modo'] == 'inserir'){
                $titulo = $_POST['titulo_input'];
                $texto = $_POST['texto_area'];
                $destino = $_POST['destino_select'];

                session_start();
                $imagem = $_SESSION['imagem_nome'];

                $sqlQueryInsert = "
                    insert into tblConteudo ( titulo, imagem, texto, visibilidade, destino )
                        values ( '".$titulo."', '".$imagem."', '".$texto."', '1', '".$destino."' );
                ";

                session_destroy();

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