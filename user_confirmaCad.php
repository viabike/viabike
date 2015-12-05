<?php

$user_conf = $conexao->prepare("INSERT INTO usuario (nome, email, senha, tipo_usuario, usuario_ativo) VALUES (:nome, :email, :senha, :tipo_usuario, :usuario_ativo)");
$user_conf->bindValue(":nome", $nome, PDO::PARAM_STR);
$user_conf->bindValue(":email", $email, PDO::PARAM_STR);
$user_conf->bindValue(":senha", $senhaC, PDO::PARAM_STR);
$user_conf->bindValue(":tipo_usuario", 'u', PDO::PARAM_STR);
$user_conf->bindValue(":usuario_ativo", true, PDO::PARAM_BOOL);
$user_conf->execute();

$_SESSION['email'] = $email;
$_SESSION['nome'] = strtoupper($nome);
$_SESSION['tipo'] = 'user';

setcookie('email', $email, time() + 3600);
header("location: user_painel.php?nc=true");

?>
