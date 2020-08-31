<?php
    require_once('conexao_bd.php');
    $conexao = conexaoMysql();

    $loginDigitado = $_POST['txtUsuario'];
    $senhaDigitada = $_POST['senha_input'];

    $sqlSelect = "select tblUsuario.*, tblNivelAcesso.*
        from tblUsuario, tblNivelAcesso
        where tblUsuario.login = '".$loginDigitado."' 
        and tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso";

    $querySelect = mysqli_query($conexao, $sqlSelect);

    if ($rsSelect = mysqli_fetch_assoc($querySelect)){
        
        if($senhaDigitada == $rsSelect['senha']){
            session_destroy();
            session_start();
            $_SESSION['nomeUsuario'] = $rsSelect['nome'];
            $_SESSION['loginUsuario'] = $rsSelect['login'];
            $_SESSION['senhaUsuario'] = $rsSelect['senha'];

            $_SESSION['acessoConteudo'] = $rsSelect['acessoConteudo'];
            $_SESSION['acessoFaleConosco'] = $rsSelect['acessoFaleConosco'];
            $_SESSION['acessoProduto'] = $rsSelect['acessoProduto'];
            $_SESSION['acessoUsuarios'] = $rsSelect['acessoUsuarios'];

            header('location:../cms/home.php');
        }
        else{
            echo("
                <script>
                    alert('Usuário ou senha incorretos!');

                    window.history.back();
                </script>
            ");    
        }
    }
    else{
        echo("
            <script>
                alert('Usuário ou senha incorretos!');

                window.history.back();
            </script>
        ");
    }
?>