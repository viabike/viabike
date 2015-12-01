<?php require_once("template/header.php"); ?>

<style>
    .botao
    {
        width:auto;
        padding: 0 25px;
        height:30px;
        background: #BD4040;
        border-radius:4px;
        cursor:pointer;
        color:#fff;
    }
</style>

<body onload=iniciarContagem()>
    <script>
        // SCRIPT PARA REDIRECIONAR PARA OUTRA PÁGINA DEPOIS DE UM DETERMINADO TEMPO
        //tempo para o redirecionamento em segundos
        var cont = 5;

        function iniciarContagem()
        {
            if ((cont - 1) >= 0)
            {
                cont--;
                contagem.innerText = 'Você será redirecionado para a página inicial em ' + cont + ' segundos';
                setTimeout('iniciarContagem()', 1000);
            }
            if (cont == 0)
            {
                window.location.href = 'index.php';
            }
        }
    </script>
    <div>
        Cadastro efetuado com sucesso.
        <br><br>
        <b><div id=contagem></div></b>

        <a href="index.php"><button class="botao">Ir para página incial agora</button></a>
    </div>
    <br>


    <?php 
    require_once("template/footer.php");
    