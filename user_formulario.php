<?php
$page = 'cadastro';
require_once("template/header.php");
if (isset($_POST['cad-submit'])) {
    include_once("user_form_cad_verifica_dados.php");
}

if (isset($_POST['login-submit'])) {
    include_once("user_form_log_verifica_dados.php");
}

?>
<link rel="stylesheet" type="text/css" href="admin/css/style.css">

<script type="text/javascript">
<?php require_once("js/user_form_verifica.js"); ?>
</script>

<div id='form_user'>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form_user1" method="POST" style="border-right: 1px solid #bdc3c7;">
        <h1>Cadastre-se</h1><br>
        
        <label for="nome">Nome Completo:</label>
        <input type="text" name="nome" class="form" placeholder="ex: John Smith" maxlength="45" pattern="^[a-zA-Z\s]{3,}[^0-9]+$" required title="Deve conter apenas letras, entre 3 e 5 caracteres.">
        <?php if (isset($_POST['cad-submit'])) {echo $nomeErro;} ?>

        <br><label for="email">E-mail:</label>
        <input type="email" name="email" id="campoemail" class="form" placeholder="ex: john@smith.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required title="email@email.com">
        <span id="emailIndisponivel" style="color: #f00">Este email já foi utilizado.</span>  
        <?php if (isset($_POST['cad-submit'])) {echo $emailExistenteErro;} ?>
        <?php if (isset($_POST['cad-submit'])) {echo $emailNValidoErro;} ?>

        <br><label for="senha">Senha:</label>
        <input type="password" name="senha" id="campoSenha" class="form"  pattern=".{6,}" required title="A senha deve conter no mínimo 6 caracteres.">
        <?php if (isset($_POST['cad-submit'])) {echo $senhaErro;} ?>

        <br><label for="senha_confirma">Confirme sua senha:</label>
        <input type="password" name="senha_confirma" id="campoConfSenha" class="form" required>
        <span id="senhasDiferentes" style="color: #f00">As senhas não conferem!</span>
        <span id="senhasIguais" style="color: #40bd68">As senhas conferem!</span>
        <?php if (isset($_POST['cad-submit'])) {echo $senhaDifErro;} ?>

        <br><input type="submit" value="Cadastrar" class="button" style="float: right; background-color: #c0c0c0; cursor: auto;" id="botaoNotOK" tooltip="Confira se os dados estão corretos">
        <input type="submit" name="cad-submit" value="Cadastrar" class="button" style="float: right; background-color: #40bd68;" id="botaoOk">
    </form>

    <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form_user2" method="POST">
        <h1>Entrar</h1><br>
        E-mail:<input type="text" name="email-login" class="form" placeholder="ex: john@smith.com" required=""><br>
        Senha:<input type="password" name="senha-login" class="form" required>
        <?php if (isset($_POST['login-submit'])) {echo $mensagem;}?>
        <br><input type="submit" name="login-submit" value="Entrar" class="button">
    </form>
</div>
<?php
require_once("template/footer.php");