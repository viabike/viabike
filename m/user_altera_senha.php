<?php
require_once("template/header.php");
require_once("../conexao/conexao.php");
require_once("verificaSessao.php");

$conexao = conectar();
$email   = $_SESSION['email'];

$consulta = $conexao->query("SELECT senha FROM usuario where email = '".$email."'");
while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
    $senhab = $linha->senha;
}

$atual_senha = sha1(strtolower($_POST['atual_senha']));
$nova_senha = sha1(strtolower($_POST['nova_senha']));
$conf_senha = sha1(strtolower($_POST['conf_senha']));

if ($senhab == $atual_senha) {

  if($nova_senha == $conf_senha) {

    $user_senha = $conexao -> prepare("UPDATE usuario set senha = :nova_senha WHERE email = :email");
      $user_senha -> bindValue(":nova_senha" ,  $nova_senha);
      $user_senha -> bindValue(":email"      ,  $email);

    // executando a QUERY
    $user_senha -> execute();

    header("location: user_logout.php");
  }else {
    echo "faiô";
  }
}else{
  echo "Senha atual errada";
}
?>
