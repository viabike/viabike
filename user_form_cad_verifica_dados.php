<?php
require_once("conexao/conexao.php");

$conexao = conectar();

$nome = addslashes(trim($_POST["nome"]));
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);// Remove todos os caracteres ilegais do email
$senha = strtolower($_POST['senha']);
$senhaC = sha1(strtolower($_POST['senha']));
$senhaConf = sha1(strtolower($_POST['senha_confirma']));

$user_verif = $conexao->prepare("SELECT * FROM usuario WHERE email = :email");
$user_verif->bindValue(":email", $email);
$user_verif->execute();

$Bemail = "";
$nomeErro= "";
$emailErro = "";
$senhaErro = "";
$senhaDifErro = "";
$emailExistenteErro = "";
$emailNValidoErro = "";
$numErros = 0;

while ($linha = $user_verif->fetch(PDO::FETCH_ASSOC)) {
    $Bemail = $linha['email'];
}

if ((empty($nome) || (strlen($nome) < 3)) || (strlen($nome) > 45)) {
    $nomeErro = '<div class="alert alert-danger alert-dismissable" role="alert" id="ufNMsg">Nome deve conter entre 3 e 45 caracteres. <br>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="ufNClose"><span aria-hidden="true">&times;</span></button></div>';
    $numErros++;
}

if ($Bemail == $email) {
    $emailExistenteErro = '<div class="alert alert-danger alert-dismissable" role="alert" id="ufEMsg">Este email já foi utilizado. <br>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="ufEClose"><span aria-hidden="true">&times;</span></button></div>';
    $numErros++;
}

if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    $emailNValidoErro =  '<div class="alert alert-danger alert-dismissable" role="alert" id="ufEIMsg">Email inválido. <br>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="ufSEIClose"><span aria-hidden="true">&times;</span></button></div>';
    $numErros++;
}

if (empty($senha) || (strlen($senha) < 6)) {
    $senhaErro = '<div class="alert alert-danger alert-dismissable" role="alert" id="ufSMsg">A senha deve conter no mínimo 6 caracteres. <br>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="ufSClose"><span aria-hidden="true">&times;</span></button></div>';
    $numErros++;
}
if ($senhaC != $senhaConf) {
    $senhaDifErro = '<div class="alert alert-danger alert-dismissable" role="alert" id="ufSMsg">As senhas não conferem. <br>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="ufSClose"><span aria-hidden="true">&times;</span></button></div>';
    $numErros++;
}

if ($numErros == 0) {
	require_once("user_confirmaCad.php");
}

?>
