<?php
require_once("conexao/conexao.php");

$conexao = conectar();

$user = $_POST['email-login'];
$senha = sha1(strtolower($_POST['senha-login']));

$user_verif = $conexao->prepare("SELECT count(*) AS cont FROM usuario WHERE email = :email AND senha = :senha");
$user_verif->bindValue(":email", $user, PDO::PARAM_STR);
$user_verif->bindValue(":senha", $senha, PDO::PARAM_STR);
$user_verif->execute();

while ($linha = $user_verif->fetch(PDO::FETCH_ASSOC)) {
    $result = $linha['cont'];
}

$mensagem = "";
$numErros = 0;

if ($result == 0) {
    $mensagem = "Usuário ou senha incorreto! <br>";
    $numErros++;
}

if ($numErros == 0) {
    include_once("confirma_login.php");
}

?>