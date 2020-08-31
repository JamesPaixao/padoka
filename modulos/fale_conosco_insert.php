<?php
    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'inserir'){
            require_once('conexao_bd.php');
            $conexao = conexaoMysql();

            if(isset($_POST['enviar_submit'])){
                $nome = $_POST['nome_input'];
                $telefone = $_POST['telefone_input'];
                $celular = $_POST['celular_input'];
                $email = $_POST['email_input'];
                $homePage = $_POST['home_page_input'];
                $facebook = $_POST['face_input'];
                $profissao = $_POST['profissao_input'];
                $intuito = $_POST['intuito_mensagem_input'];
                $mensagem = $_POST['mensagem_input'];
                $genero = $_POST['sexo_input'];

                $queryInsertOpiniao = "insert into tblFaleConosco (
                    nome, telefone, celular, email, homePage,
                    linkFacebook, profissao, intuito, mensagem, genero
                )
                values (
                    '".$nome."', '".$telefone."', '".$celular."', '".$email."',
                    '".$homePage."', '".$facebook."', '".$profissao."', '".$intuito."',
                    '".$mensagem."', '".$genero."'
                );";

                if(mysqli_query($conexao, $queryInsertOpiniao)){
                    echo("
                        <script>
                            alert('Registro inserido com sucesso');
                            // location.href = '../paginas/home.php';
                            window.history.back();
                        </script>
                    ");
                }
                else {
                    echo("
                        <script>
                            alert('Erro ao executar o script!);
                            // Permite volar a pagina anterior sem perder
                            //os dados digitados no formulário
                            window.history.back();
                        </script>
                    ");
                }
                
                echo($queryInsertOpiniao);
            }
        }
    }
?>