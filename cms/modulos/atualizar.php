<?php
    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'atualizar'){
            if(isset($_POST['submit_cms'])){
                require_once('conexao_bd.php');
                $conexao = conexaoMysql();

                if($_GET['origem'] == 'adm_conteudo'){

                    $id = $_GET['id'];
                    $imagemAntiga = $_GET['imagemAntiga'];
                    $titulo = $_POST['titulo_input'];
                    $texto = $_POST['texto_area'];
                    $destino = $_POST['destino_select'];
                    session_start();
                    $imagem = $_SESSION['imagem_nome'];
                    
                    if($imagem != $imagemAntiga){
                        $sqlQueryAtualizar = "
                            update tblConteudo set
                                titulo = '".$titulo."',
                                imagem = '".$imagem."',
                                texto = '".$texto."',
                                destino = '".$destino."'
                            where idConteudo = ".$id;

                            unlink('../arquivos/'.$imagemAntiga);
                    }
                    else{
                        $sqlQueryAtualizar = "
                        update tblConteudo set
                            titulo = '".$titulo."',
                            texto = '".$texto."',
                            destino = '".$destino."'
                        where idConteudo = ".$id;
                    }

                    echo($sqlQueryAtualizar);

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
                    $imagemAntiga = $_GET['imagemAntiga'];
                    $nome = $_POST['nome_input'];
                    $texto = $_POST['texto_area'];
                    $endereco = $_POST['endereco_input'];

                    session_start();
                    $imagem = $_SESSION['imagem_nome'];
                    
                    if($imagem != $imagemAntiga){
                        $sqlQueryAtualizar = "
                            update tblLoja set
                                nomeLoja = '".$nome."',
                                fotoLoja = '".$imagem."',
                                textoLoja = '".$texto."',
                                enderecoLoja = '".$endereco."'
                            where idLoja = ".$id;

                            unlink('../arquivos/'.$imagemAntiga);
                    }
                    else{
                        $sqlQueryAtualizar = "
                            update tblLoja set
                                nomeLoja = '".$nome."',
                                textoLoja = '".$texto."',
                                enderecoLoja = '".$endereco."'
                            where idLoja = ".$id;
                    }

                    if(mysqli_query($conexao, $sqlQueryAtualizar)){
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
                elseif($_GET['origem'] == 'pagina_usuarios'){
                    $id = $_GET['id'];

                    $nome = $_POST['nome_input_usuario'];
                    $login = $_POST['login_input'];
                    $senha = $_POST['senha_input'];
                    $idNivelAcesso = $_POST['nivel_acesso_select'];

                    $sqlQueryAtualizarUsuario = "
                        update tblUsuario set
                            nome = '".$nome."',
                            login = '".$login."',
                            senha = '".$senha."',
                            idNivelAcesso = '".$idNivelAcesso."'

                        where idUsuario = ".$id;

                    if(mysqli_query($conexao, $sqlQueryAtualizarUsuario)){
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
                elseif($_GET['origem'] == 'pagina_niveis_acesso'){
                    $id = $_GET['id'];

                    $nomeNivel = $_POST['nome_nivel_input'];
                    $acessoConteudo = $_POST['adm_conteudo_radio'];
                    $acessoFaleConosco = $_POST['adm_fale_conosco_radio'];
                    $acessoProduto = $_POST['adm_produto_radio'];
                    $acessoUsuario = $_POST['adm_usuario_radio'];

                    $sqlQueryAtualizarNivelAcesso = "
                        update tblNivelAcesso set
                            nomeNivel = '".$nomeNivel."',
                            acessoConteudo = '".$acessoConteudo."',
                            acessoFaleConosco = '".$acessoFaleConosco."',
                            acessoProduto = '".$acessoProduto."',
                            acessoUsuarios = '".$acessoUsuario."'

                        where idNivelAcesso = ".$id;

                    if(mysqli_query($conexao, $sqlQueryAtualizarNivelAcesso)){
                        echo("Foi ".$sqlQueryAtualizarNivelAcesso);
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
                    echo("Pagina de origem não encontrada!");
                }
            }
        }
    }
?>