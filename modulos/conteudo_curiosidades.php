<div id="div_conteudo_paginas">
    <div id="div_secao_de_conteudo">
        <div id="div_curiosidades">
            
            <h1>Curiosidades</h1>

            <?php
                require_once("conexao_bd.php");

                $conexao = conexaoMysql();

                $sqlQuerySelect = "select * from tblConteudo where destino = 'c' and visibilidade = 1;";

                $select = mysqli_query($conexao, $sqlQuerySelect);

                while($rsSelect = mysqli_fetch_assoc($select)){
                    if($rsSelect['titulo'] != null){
                        echo("
                            <h2>
                                ".$rsSelect['titulo']."
                            </h2>
                        ");
                    }
                    if($rsSelect['imagem'] != null){
                        echo("
                            <div class='imagens_curiosidades'>
                                <img src='cms/arquivos/".$rsSelect['imagem']."' alt='".$rsSelect['imagem']."'>
                            </div>
                        ");
                    }
                    echo("
                        <p class='curiosidade_textos'>
                            <br>
                            ".$rsSelect['texto']."
                        </p>            
                    ");
                }
            ?>
        </div>
    </div>
</div>