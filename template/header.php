<!DOCTYPE html>
<?php session_start();
include("admin/funcoes/funcoes.php");?>
<html>
<head>
	<title>ViaBike.me</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div id="wrapper">

		<div id="header">
			<a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me" class="logo"></a>

			<div id="nav-header">
				<ul>
					<?php if(userLogado()){
            echo "
						<li><a href='user_logout.php'>SAIR</a></li>
						<li><a href='user_painel.php'>".$_SESSION['nome']."</a></li>
						<li style='color:#a7a7a7'> | </li>";
					} ?>
					<li><a href="equipe.php">EQUIPE</a></li>
					<li><a href="sobre.php">SOBRE</a></li>
					<li><a href="index.php">HOME</a></li>
				</ul>
			</div>
		</div>

		<?php if(!userLogado()){ ?>
    <div id="entrar">
			<p><center><a href="user_formulario.php">Cadastre-se / Entrar</a></center></p>
		</div>
    <?php } ?>

		<div id="container">
		<div id="content">
