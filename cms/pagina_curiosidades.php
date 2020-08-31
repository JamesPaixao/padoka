<?php
    require_once('modulos/conexao_bd.php');
    $conexao = conexaoMysql();

    $dominio= $_SERVER['HTTP_HOST'];
    $url = "http://" . $dominio. $_SERVER['REQUEST_URI'];

    if(isset($_POST['botao_filtrar'])){
        if($_GET['modo']){
            if($_GET['modo'] == 'filtrar'){
                $filtro = $_POST['input_filter'];

                switch($filtro){
                    case "c":
                        $sqlQuerySelect = "select tblUsuario.*, tblNivelAcesso.nomeNivel
                            from tblUsuario, tblNivelAcesso
                            where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso
                            and tblNivelAcesso.acessoConteudo = 1
                            order by tblUsuario.nome";
                    break;

                    case "f":
                        $sqlQuerySelect = "select tblUsuario.*, tblNivelAcesso.nomeNivel
                            from tblUsuario, tblNivelAcesso
                            where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso
                            and tblNivelAcesso.acessoFaleConosco = 1
                            order by tblUsuario.nome";
                    break;

                    case "p":
                        $sqlQuerySelect = "select tblUsuario.*, tblNivelAcesso.nomeNivel
                            from tblUsuario, tblNivelAcesso
                            where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso
                            and tblNivelAcesso.acessoProduto = 1
                            order by tblUsuario.nome";
                    break;

                    case "u":
                        $sqlQuerySelect = "select tblUsuario.*, tblNivelAcesso.nomeNivel
                            from tblUsuario, tblNivelAcesso
                            where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso
                            and tblNivelAcesso.acessoUsuarios = 1
                            order by tblUsuario.nome";
                    break;

                    default:
                        $sqlQuerySelect = "select tblUsuario.*, tblNivelAcesso.nomeNivel
                            from tblUsuario, tblNivelAcesso
                            where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso
                            order by tblUsuario.nome";
                    break;
                }
            }
        }
    }
    else{
        $sqlQuerySelect = "select tblUsuario.*, tblNivelAcesso.nomeNivel
                            from tblUsuario, tblNivelAcesso
                            where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso
                            order by tblUsuario.nome";
    }
    $select = mysqli_query($conexao, $sqlQuerySelect);

    $action = "modulos/inserir_usuario.php?modo=inserir&url=".$url;

    $nome = null;
    $login = null;
    $senha = null;
    $idNivelAcesso = null;
    $nomeNivel = null;

    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'editar'){
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $querySelectUsuario = "
                    select tblUsuario.*,
                    tblNivelAcesso.idNivelAcesso, tblNivelAcesso.nomeNivel
                    from tblUsuario, tblNivelAcesso
                    where tblUsuario.idNivelAcesso = tblNivelAcesso.idNivelAcesso
                    and tblUsuario.idUsuario = ".$id;
                
                $selectDados = mysqli_query($conexao, $querySelectUsuario);

                if($rsInfoUsuario = mysqli_fetch_assoc($selectDados)){
                    $idUsuario = $rsInfoUsuario['idUsuario'];
                    $nome = $rsInfoUsuario['nome'];
                    $login = $rsInfoUsuario['login'];
                    $senha = $rsInfoUsuario['senha'];
                    $idNivelAcesso = $rsInfoUsuario['idNivelAcesso'];
                    $nomeNivel = $rsInfoUsuario['nomeNivel'];

                    $action = "modulos/atualizar.php?modo=atualizar&id=".$rsInfoUsuario['idUsuario']."&url=".$url."&origem=pagina_usuarios";
                }
            }
        }
    }
?>

<!DOCTYPE html>

<html lang="pt-br">
    <head>
        <title>CMS</title>

        <?php
            require_once('modulos/imports.php');
        ?>
    </head>

    <body>
        <div id="modal">
            <div id="modal_content">
            </div>
        </div>

        <div id="div_cms">
            <?php
                require_once('modulos/menu.php');
            ?>

            <div id="div_submenus_cms">
                <form action="<?=$action?>" name="form_adm_usuario_cadastrar" method="post">
                    <div class="div_cadastro">
                        <div class="titulo_do_cadastro">Cadastro Usuário</div>

                        <div class="input_cadastro">
                            Nome usuário: <input type="text" name="nome_input_usuario" value="<?=$nome?>" required>
                        </div>

                        <div class="input_cadastro">
                            Login: <input type="text" name="login_input" value="<?=$login?>" required>
                        </div>

                        <div class="input_cadastro">
                            Senha: <input type="password" name="senha_input" value="<?=$senha?>" required>
                        </div>

                        <div class="input_cadastro">
                            Nivel Acesso:
                            <select name="nivel_acesso_select">
                                <?php
                                    if(isset($_GET['modo'])){
                                        if($_GET['modo'] == 'editar'){
                                            ?>
                                                <option value="<?=$idNivelAcesso?>"><?=$nomeNivel?></option>        
                                            <?php
                                            $sqlQuerySelectNiveisAcesso = "
                                                select * from tblNivelAcesso
                                                where not (idNivelAcesso = ".$idNivelAcesso.")
                                                order by nomeNivel;
                                            ";
                                        }
                                    }
                                    else{
                                ?>
                                        <option value="">Selecione um Nivel</option>
                                <?php
                                    }
                                    $sqlQuerySelectNiveisAcesso = "
                                        select * from tblNivelAcesso
                                        order by nomeNivel;
                                    ";
                                    
                                    $selectNiveisAcesso = mysqli_query($conexao, $sqlQuerySelectNiveisAcesso);

                                    while($rsNivelAcesso = mysqli_fetch_assoc($selectNiveisAcesso)){
                                ?>
                                        <option value="<?=$rsNivelAcesso['idNivelAcesso']?>">
                                            <?=$rsNivelAcesso['nomeNivel']?>
                                        </option>
                                <?php
                                    }
                                ?>
                            </select>
                        
                        </div>
                       
                        <div class="botaoRegistrar">
                            <input type="submit" name="submit_cms" value="Registrar">
                        </div>
                    </div>
                </form>

                <form name="filtro_adm_fale_conosco" action="pagina_usuarios.php?modo=filtrar" method="post">
                    Filtro:
                    <input type="radio" name="input_filter" value="a" checked>Todos
                    <input type="radio" name="input_filter" value="c">Conteúdo
                    <input type="radio" name="input_filter" value="f">Fale Conosco
                    <input type="radio" name="input_filter" value="p">Produtos
                    <input type="radio" name="input_filter" value="u">Usuários

                    <input type="submit" value="filtrar" name="botao_filtrar">
                </form>
                
                <div class="div_comentarios">
                    <div class="user_name">Nome</div>
                    <div class="user_login">Login</div>
                    <div class="user_password">Senha</div>
                    <div class="user_level">Nivel Acesso</div>
                </div>

                <?php
                    while($rsSelect = mysqli_fetch_assoc($select)){
                        ?>
                            <div class="div_comentarios">
                                <div class="user_name"><?=$rsSelect['nome']?></div>
                                <div class="user_login"><?=$rsSelect['login']?></div>
                                <div class="user_password"><?=$rsSelect['senha']?></div>
                                <div class="user_level"><?=$rsSelect['nomeNivel']?></div>

                                <a onclick="return confirm('Deseja realmente excluir o registro?');"
                                href="./modulos/deletar.php?modo=excluir&id=<?=$rsSelect['idUsuario']?>&tabela=tblUsuario&coluna=idUsuario&url=<?=$url?>">
                                    <div class="excluir"></div>
                                </a>

                                <div class="visualizar" onclick="visualizarUsuario(<?=$rsSelect['idUsuario']?>);"></div>

                                <a href="pagina_usuarios.php?modo=editar&id=<?=$rsSelect['idUsuario']?>">
                                    <div class="editar"></div>
                                </a>
                            </div>
                        <?php
                    }   
                ?>
            </div>

            <div id="footer_cms">
                 James ⚝ Paixão
            </div>
        </div>
    </body>
</html>