<?php
require_once("template/header.php");
require_once("verificaSessao.php");

echo '<h1 style="float: left; text-align: left">Alterar Senha</h1>
<a href="user_painel.php"><button class="button" style="float: right;">Editar Perfil</button></a></h1><br>';
?>

<form action="user_altera_senha.php" method="POST">
    Nova senha: <input class="input" type="password" name="nova_senha"><br>
    Confirma sua senha: <input class="input" type="password" name="conf_senha"><br>
    <input class="button" type="submit" value="Alterar" style="float: right">
</form>

<?php
require_once("template/footer.php");
