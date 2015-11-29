<?php
require_once("template/header.php");
?>
<link rel="stylesheet" type="text/css" href="admin/css/style.css">

<script>
    $(document).ready(function() {
        $("#campoemail").css("border", "1px solid #bdc3c7");
        $("#campoSenha").css("border", "1px solid #bdc3c7");
        $("#campoConfSenha").css("border", "1px solid #bdc3c7");

        $("#campoConfSenha").keyup(function() {
            var senha = $("#campoSenha").val();
            var confSenha = $(this).val();

            if (confSenha === senha) {
                $("#campoConfSenha").css("border", "1px solid #40bd68");
            }
            else {
                $("#campoConfSenha").css("border", "1px solid #f00");
            }
        });


        $("#campoemail").keyup(function() {
            var email = $(this).val();
            $.ajax({
                type: "POST",
                url: "user_formulario_verifica.php",
                data: "email=" + email,
                success: function(resultado) {
                    var retorno = resultado;
                    getMessage(retorno);
                },
                error: function() {
                    alert("Erro ao verificar os detalhes do usuario!");
                }
            });
        });
    });

    function getMessage(type) {
        if (type == 1) {
            $("#campoemail").css("border", "1px solid #f00");
        }
        else {
            $("#campoemail").css("border", "1px solid #40bd68");
        }
    }
</script>

<div id='form_user'>
    <form action="user_confirmaCad.php" class="form_user1" method="POST" style="border-right: 1px solid #bdc3c7;">
        <h1>Cadastre-se</h1><br>
        Nome Completo:<input type="text" name="nome" class="form" placeholder="Ex: Exemplo de Nome" required><br>
        E-mail:<input type="email" name="email" id="campoemail" class="form" placeholder="Ex: ex@exemplo.com" required><br>
        Senha:<input type="password" name="senha" id="campoSenha" class="form" required><br>
        Confirme sua senha:<input type="password" name="senha_confirma" id="campoConfSenha" class="form" required><br>
        <input type="submit" value="Cadastrar" class="button">
    </form>

    <form action="confirma_login.php" class="form_user2" method="POST">
        <h1>Entrar</h1><br>
        E-mail:<input type="email" name="email" class="form" placeholder="Ex: ex@exemplo.com" required><br>
        Senha:<input type="password" name="senha" class="form" required><br>
        <input type="submit" value="Entrar" class="button">
    </form>
</div>
<?php
require_once("template/footer.php");
