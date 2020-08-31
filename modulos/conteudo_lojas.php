<div id="div_conteudo_paginas">
    <div id="div_lojas">
        
        <h1>Conheça nossas Lojas</h1>

        <?php
            require_once("conexao_bd.php");

            $conexao = conexaoMysql();

            $sqlQuerySelect = "select * from tblLoja where visibilidade = 1;";

            $select = mysqli_query($conexao, $sqlQuerySelect);

            while($rsSelect = mysqli_fetch_assoc($select)){
                echo("<div class='lojas_card'>
                <div class='div_imagem_loja'>
                    <img src='cms/arquivos/".$rsSelect['fotoLoja']."' alt='".$rsSelect['fotoLoja']."'>
                </div>
                <div class='infos_loja'>
                    <h2 class='loja_nome'>".$rsSelect['nomeLoja']."</h2>

                    <h2 class='loja_endereco'>Endereço: ".$rsSelect['enderecoLoja']."</h2>

                    <p class='loja_texto'>Sobre a loja: ".$rsSelect['textoLoja']."</p>
                </div>
            </div>");
            }
        ?>

    </div>
</div>