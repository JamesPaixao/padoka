<?php
    require_once('conexao_bd.php');
    $conexao = conexaoMysql();

    if(isset($_POST['submit_cms'])){
        if($_GET['modo']){
            if($_GET['modo'] == 'inserir'){
                $nome = $_POST['nome_input_usuario'];
                $login = $_POST['login_input'];
                $senha = $_POST['senha_input'];
                $idNivelAcesso = $_POST['nivel_acesso_select'];

                $sqlQueryInsert = "
                    insert into tblUsuario ( nome, login, senha, idNivelAcesso )
                        values ( '".$nome."', '".$login."', '".$senha."', '".$idNivelAcesso."' );
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