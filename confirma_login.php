<?php

session_start();
include("conexao/conexao.php");

// dados vindos da página index
$user = $_POST['email'];
$senha = sha1(strtolower($_POST['senha']));

$conexao = conectar();

//cria as vários com dados do banco
$idb;
$nomeb;
$userb;
$senhab;
$tipob;

//pega os dados do banco
$consulta = $conexao->query("SELECT id_usuario, nome, email, senha, tipo_usuario FROM usuario WHERE email = '" . $user . "'");
while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
    // dados vindos do banco, por isso o "b"
    $idb = $linha->id_usuario;
    $nomeb = $linha->nome;
    $userb = $linha->email;
    $senhab = $linha->senha;
    $tipob = $linha->tipo_usuario;
}

if ($user == $userb AND $senha == $senhab AND $tipob == "u") {// verifica se usuário, senha estão corretos e se ele é administrador
    if (count($consulta) > 0) {
        $_SESSION['email'] = $user;
        $_SESSION['nome'] = strtoupper($nomeb);
        $_SESSION['tipo'] = 'user';

        setcookie('email', $user, time() + 3600);

        $user_up = $conexao->prepare("UPDATE usuario SET usuario_ativo = true WHERE id_usuario = $idb");
        $user_up->execute();

        header("location:index.php");
    }
    else {
        header("location:index.php");
    }
}
else {
    header("location:erro_login.php");
}
