<?php
require_once("template/header.php");

if (isset($_POST['cad-submit'])) {
    include_once("user_cad_verifica_dados.php"); 
}
?>

<script type="text/javascript">
<?php require_once("js/user_cad_verifica_dados.js"); ?>
</script>

<form action="<?php $_SERVER['PHP_SELF']; ?>" class="form_user1" method="POST">
	<center><h1>Cadastre-se</h1></center>
    <br><br>
	
    <label for="nome" style="font-size: 2em">Nome Completo:</label>
    <input type="text" name="nome" class="form" id="campoNome" placeholder="Ex: Exemplo de Nome" required><br>
    <?php if (isset($_POST['cad-submit'])) {echo $nomeErro;} ?>
    
    <br><label for="email" style="font-size: 2em">E-mail:</label>
    <input type="email" name="email" class="form" id="campoemail" placeholder="Ex: ex@exemplo.com" required><br>
    <span id="emailIndisponivel" style="color: #f00; font-size: 1.8em;">Este email já foi utilizado.</span>
    <?php if (isset($_POST['cad-submit'])) {echo $emailExistenteErro;} ?>
    <?php if (isset($_POST['cad-submit'])) {echo $emailNValidoErro;} ?>
    
    <br><label for="senha" style="font-size: 2em">Senha:</label>
    <input type="password" name="senha" class="form" id="campoSenha" required><br>
	<?php if (isset($_POST['cad-submit'])) {echo $senhaErro;} ?>
    
    <br><label for="senha_confirma" style="font-size: 2em">Confirme sua senha:</label>
    <input type="password" name="senha_confirma" class="form" id="campoConfSenha"  required><br>
    <?php if (isset($_POST['cad-submit'])) {echo $senhaDifErro;} ?>
    
    <br><br><a href="user_login.php" style="float: left; font-size:2em; line-height:65px; color:#535455;">Entrar</button></a>
	
    <br><br><input type="submit" name="cad-submit" value="Cadastrar" class="button" style="float:right">
</form>

<?php
require_once("template/footer.php");
