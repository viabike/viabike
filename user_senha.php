<?php
include("template/header.php");

echo '<h1 style="float: left; text-align: left">Alterar senha</h1>
<a href="user_painel.php"><button class="button" style="float: right;">Editar perfil</button></a></h1><br>';

?>

<form action="user_altera_senha.php" method="POST">
  Nova senha: <input class="input" type="password" name="nova_senha"><br>
  Confirma sua senha: <input class="input" type="password" name="conf_senha"><br>
  <input class="button" type="submit" value="Alterar" style="float: right">
</form>

<?php
include("template/footer.php");
?>