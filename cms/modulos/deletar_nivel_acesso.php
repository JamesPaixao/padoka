<?php
    if (isset($_GET['modo'])){
        if ($_GET['modo'] == 'excluir'){
            require_once('conexao_bd.php');

            $conexao = conexaoMysql();

            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sqlQueryDelete = "delete from tblUsuario where tblUsuario.idNivelAcesso = " . $id;

                echo($sqlQueryDelete);
                if(mysqli_query($conexao, $sqlQueryDelete)){
                    $sqlQueryDelete = "delete from tblNivelAcesso where tblNivelAcesso.idNivelAcesso = " .$id;
                    if(mysqli_query($conexao, $sqlQueryDelete)){
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