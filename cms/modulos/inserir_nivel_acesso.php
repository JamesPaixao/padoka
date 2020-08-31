<?php
    require_once('conexao_bd.php');
    $conexao = conexaoMysql();

    if(isset($_POST['submit_cms'])){
        if($_GET['modo']){
            if($_GET['modo'] == 'inserir'){
                $nomeNivel = $_POST['nome_nivel_input'];
                $acessoConteudo = $_POST['adm_conteudo_radio'];
                $acessoFaleConosco = $_POST['adm_fale_conosco_radio'];
                $acessoProduto = $_POST['adm_produto_radio'];
                $acessoUsuario = $_POST['adm_usuario_radio'];

                $sqlQueryInsert = "
                    insert into tblNivelAcesso ( nomeNivel, acessoConteudo, acessoFaleConosco,
                                                 acessoProduto, acessoUsuarios )
                        values ( '".$nomeNivel."', '".$acessoConteudo."', '".$acessoFaleConosco."',
                         '".$acessoProduto."', '".$acessoUsuario."' );
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