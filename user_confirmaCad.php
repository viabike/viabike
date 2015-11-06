<?php
include_once("conexao/conexao.php");
include_once("template/header.php");

$conexao = conectar();//Funcão de conexão com o banco de dados viabike_db

$nome		= addslashes(trim($_POST["nome"]));//requisição vinda do arquivo user_formulario.php
$email	= addslashes(trim($_POST["email"]));//requisição vinda do arquivo user_formulario.php
$senha	= sha1(strtolower($_POST['senha']));//requisição vinda do arquivo user_formulario.php

$user_verif = $conexao->prepare("SELECT * FROM usuario WHERE email = :email");
$user_verif -> bindValue(":email", $email);
$user_verif -> execute();
$Bemail = "";

while ($linha = $user_verif->fetch(PDO::FETCH_ASSOC))
{
	$Bemail = $linha['email'];
}
if($Bemail == $email)
{
	echo "
		<div>
			Este email já foi utilizado anteriormente, possivelmente a conta foi desativada. <br> Faça login pra ativar novamente esta conta. <br> <a href='user_formulario.php'>Clique para ir para login.</a>
			<br><br>
			<b><div id=contagem></div></b>
			<a href='index.php'>Clique para ir para a página incial agora.</a>
		</div>
	";
}
else
{
	$user_conf = $conexao->prepare("INSERT INTO usuario (nome, email, senha, tipo_usuario, usuario_ativo) VALUES (:nome, :email, :senha, :tipo_usuario, :usuario_ativo)");
	$user_conf->bindValue(":nome", $nome, PDO::PARAM_STR);
	$user_conf->bindValue(":email", $email, PDO::PARAM_STR);
	$user_conf->bindValue(":senha", $senha, PDO::PARAM_STR);
	$user_conf->bindValue(":tipo_usuario", 'u', PDO::PARAM_STR);
	$user_conf->bindValue(":usuario_ativo", true, PDO::PARAM_BOOL);
	$user_conf->execute();
	
	// print_r($user_conf->errorInfo());
  header("location: user_sucesso_cadastro.php");
}
?>

<body onload=iniciarContagem()>
	<script>
	// SCRIPT PARA REDIRECIONAR PARA OUTRA PÁGINA DEPOIS DE UM DETERMINADO TEMPO
		//tempo para o redirecionamento em segundos
		var cont = 10;

		function iniciarContagem()
		{
		   if ((cont - 1) >= 0)
		   {
			   cont--;
			   contagem.innerText = 'Você será redirecionado para a página inicial em ' + cont + ' segundos';
			   setTimeout('iniciarContagem()',1000);
		   }
		   if (cont == 0)
		   {
				window.location.href='index.php';
		   }
		}
	</script>

<?php
include_once("template/footer.php");
?>
