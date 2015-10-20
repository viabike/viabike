<?php
include("conexao/conexao.php");

$conexao = conectar();

$nome    = addslashes(trim($_POST['nome'   ]));
$apelido = addslashes(trim($_POST['apelido']));
$senha   = strtolower(sha1($_POST['senha'  ]));

$user_insert = $conexao -> prepare("INSERT INTO usuario (nome, apelido, senha) values (:nome, :apelido, :senha)");
    $user_insert -> bindValue(":nome"    , $nome    );
    $user_insert -> bindValue(":apelido" , $apelido );
    $user_insert -> bindValue(":senha"   , $senha   );
$user_insert -> execute();
?>
