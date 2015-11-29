<?php
require_once("template/header.php");

if (isset($_POST['submit'])) {
    include_once("user_form_verifica_dados.php");
}
?>
<link rel="stylesheet" type="text/css" href="admin/css/style.css">

<script>
    $(document).ready(function() {
        $("#campoemail").css("border", "1px solid #bdc3c7");
        $("#campoSenha").css("border", "1px solid #bdc3c7");
        $("#campoConfSenha").css("border", "1px solid #bdc3c7");
        $("#emailDisponivel").hide();

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
                url: "user_form_verifica_email.php",
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
            $("#emailDisponivel").show();
        }
        else {
            $("#campoemail").css("border", "1px solid #40bd68");
        }
    }
</script>

<div id='form_user'>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form_user1" method="POST" style="border-right: 1px solid #bdc3c7;">
        <h1>Cadastre-se</h1><br>
        
        <label for="nome">Nome Completo:</label>
        <input type="text" name="nome" class="form" placeholder="ex: John Smith" maxlength="45" pattern="^[a-zA-Z\s]{3,}[^0-9]+$" required title="Deve conter apenas letras, entre 3 e 5 caracteres.">
        <?php if (isset($_POST['submit'])) {echo $nomeErro;} ?>

        <br><label for="email">E-mail:</label>
        <input type="email" name="email" id="campoemail" class="form" placeholder="ex: john@smith.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required title="email@email.com">
        <span id="emailDisponivel" style="color: #f00">Este email já foi utilizado.</span>  
        <?php if (isset($_POST['submit'])) {echo $emailExistenteErro;} ?>
        <?php if (isset($_POST['submit'])) {echo $emailNValidoErro;} ?>

        <br><label for="senha">Senha:</label>
        <input type="password" name="senha" id="campoSenha" class="form"  pattern=".{6,}" required title="A senha deve conter no mínimo 6 caracteres.">
        <?php if (isset($_POST['submit'])) {echo $senhaErro;} ?>

        <br><label for="senha_confirma">Confirme sua senha:</label>
        <input type="password" name="senha_confirma" id="campoConfSenha" class="form" required><br>
        <?php if (isset($_POST['submit'])) {echo $senhaDifErro;} ?>

        <input type="submit" name="submit" value="Cadastrar" class="button">
    </form>

    <form action="confirma_login.php" class="form_user2" method="POST">
        <h1>Entrar</h1><br>
        E-mail:<input type="email" name="email" class="form" placeholder="ex: john@smith.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required title="email@email.com"><br>
        Senha:<input type="password" name="senha" class="form" required><br>
        <input type="submit" value="Entrar" class="button">
    </form>
</div>
<?php
require_once("template/footer.php");
