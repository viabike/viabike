<?php
require_once("template/header.php");
require_once("../conexao/conexao.php");
require_once("verificaSessao.php");

echo '<center><h1>Alterar senha</h1></center>';

?>

<form action="user_altera_senha.php" method="POST">
  <span style="font-size: 2em">Nova senha: </span><input class="form" type="password" name="nova_senha"><br>
  <span style="font-size: 2em">Confirma sua senha: </span><input class="form" type="password" name="conf_senha"><br>
  <input class="button" type="submit" value="Alterar" style="float: right">
</form>

<?php
require_once("template/footer.php");
?>
