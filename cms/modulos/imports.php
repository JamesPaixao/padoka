<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" href="css/style.css">
<link rel="shortcut icon" href="./imagens/cms.png">
<script src="./js/jquery.js"></script>
<script src="./js/jquery.form.js"></script>

<?php session_start(); ?>

<script>
    // Devemos, sempre, iniciar o JQuery por essa function
    $(document).ready(function(){
        // Function que será acionada com o click do botáo visualizar
        $('.visualizar').click(function(){
            // Chama a div modal pelo efeito fadeIn
            $('#modal').fadeIn(1000);
        });

        $('.fechar').click(function(){
            $('#modal').fadeOut(500);
        });

        $('#inputImagem').live('change', function(){
            $('#formImagem').ajaxForm({
                target: '#image_view' 
            }).submit();
        });
    });

    function mudarVisibilidade(id, visibilidadeAntiga, origem, url){
        window.location=`modulos/update_visibilidade.php?id=${id}&visibilidadeAntiga=${visibilidadeAntiga}&origem=${origem}&url=${url}`;
    }

    // Function para abrir um arquivo dentro da modal
    function visualizar_fale_conosco(idContato){
        $.ajax({
            type: "POST",
            url: "modulos/visualizar_fale_conosco.php",
            data: {
                modo: "visualizar",
                id: idContato 
            },
            success: function(dados){
                $('#modal_content').html(dados);
            }
        });
    }
    
    function visualizarUsuario(idUsuario){
        $.ajax({
            type: "POST",
            url: "modulos/visualizar_usuario.php",
            data: {
                modo: "visualizar",
                id: idUsuario 
            },
            success: function(dados){
                $('#modal_content').html(dados);
            }
        });
    }

    function visualizarNivelAcesso(idNivelAcesso){
        $.ajax({
            type: "POST",
            url: "modulos/visualizar_nivel_acesso.php",
            data: {
                modo: "visualizar",
                id: idNivelAcesso 
            },
            success: function(dados){
                $('#modal_content').html(dados);
            }
        });
    }

    function visualizarConteudo(idConteudo){
        $.ajax({
            type: "POST",
            url: "modulos/visualizar_conteudo.php",
            data: {
                modo: "visualizar",
                id: idConteudo
            },
            success: function(dados){
                $('#modal_content').html(dados);
            }
        });
    }

    function visualizar_loja(idLoja){
        $.ajax({
            type: "POST",
            url: "modulos/visualizar_lojas.php",
            data: {
                modo: "visualizar",
                id: idLoja
            },
            success: function(dados){
                $('#modal_content').html(dados);
            }
        });
    }
</script>