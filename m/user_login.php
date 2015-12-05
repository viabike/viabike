<?php
require_once("template/header.php");
?>
<style>
    .mensagem {
        font-size: 1.9em;
        color: #f00;
    }
</style>
<?php
if (isset($_POST['login-submit'])) {
    include_once("user_log_verifica_dados.php");
}
?>

<center>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form_user2" method="POST">
        <center><h1>Entrar</h1></center><br>
        <label for="email-login" style="font-size: 2em">E-mail:</label>
        <input type="text" name="email-login" class="form" placeholder="ex: john@smith.com" required><br>

        <label for="senha-login" style="font-size: 2em">Senha:</label>
        <input type="password" name="senha-login" class="form" required><br>
        <?php if (isset($_POST['login-submit'])) {
            echo $mensagem;
        } ?>

        <a href="user_cadastro.php" style="float: left; font-size:2em; line-height:65px; color:#535455;">Cadastre-se</button></a>
        <input type="submit" name="login-submit" value="Entrar" class="button" style="float:right">
    </form>
</center>
<?php
require_once("template/footer.php");
?>
