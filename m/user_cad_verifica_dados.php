<?php
require_once("../conexao/conexao.php");
?>
<style>
    .mensagem {
        font-size: 1.65em;
        color: #f00;
    }
</style>
<?php

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
    $nomeErro = "<span class='mensagem'>Nome deve conter entre 3 e 45 caracteres. </span><br>";
    $numErros++;
}
if ($Bemail == $email) {
    $emailExistenteErro = "<span class='mensagem'>Este email já foi utilizado. </span><br>";
    $numErros++;
}
if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){  
    $emailNValidoErro = "<span class='mensagem'>Email inválido. </span><br>";
    $numErros++;
}
if (empty($senha) || (strlen($senha) < 6)) {
    $senhaErro = "<span class='mensagem'>A senha deve conter no mínimo 6 caracteres. </span><br>";
    $numErros++;
}
if ($senhaC != $senhaConf) {
    $senhaDifErro = "<span class='mensagem'>As senhas não conferem. </span><br>";
    $numErros++;
}
if ($numErros == 0) {
	require_once("user_confirmaCad.php");
}
?>