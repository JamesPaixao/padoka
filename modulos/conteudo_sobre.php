<div id="div_conteudo_paginas">
    <div id="div_secao_de_conteudo">
        <div id="div_sobre_conteudo">
            <?php
                require_once("conexao_bd.php");

                $conexao = conexaoMysql();

                $sqlQuerySelect = "select * from tblConteudo where destino = 's' and visibilidade = 1;";

                $select = mysqli_query($conexao, $sqlQuerySelect);

                while($rsSelect = mysqli_fetch_assoc($select)){
                    if($rsSelect['titulo'] != null){
                        echo("
                            <h3 class='sobre_titulos'>
                                ".$rsSelect['titulo']."
                            </h3>
                        ");
                    }
                    if($rsSelect['imagem'] != null){
                        echo("
                            <div class='sobre_imagens'>
                                <img src='cms/arquivos/".$rsSelect['imagem']."' alt='".$rsSelect['imagem']."'>
                            </div>
                        ");
                    }
                    echo("
                        <p class='sobre_textos'>
                            ".$rsSelect['texto']."
                        </p>            
                    ");
                }
            ?>
        </div>
    </div>
</div>