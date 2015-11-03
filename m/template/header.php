<?php
session_start();
require_once("../conexao/conexao.php");
include("../admin/funcoes/funcoes.php");
// ======== SELECIONA TODOS OS REGISTROS DE PONTOS DE INTERESSE DO BANCO VIABIKE_DB =============
$pdo = conectar();
$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse");
//Executando a QUERY
$buscaPonto -> execute();
// ========= FIM DA SELEÇÃO ==============================================

$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me logo" style="width:100%;"></a>
                </div>
                <div id="nav">
                    <img src="imagens/menu-icon.png" alt="Menu" style="width: 100px;">
                </div>
            </div>
            <div id="menu">
                <ul>
					<?php if(userLogado()){
						echo "
						<li><a href='user_painel.php'>".$_SESSION['nome']."</a></li>";
					} ?>
						<li><a href="equipe.php">EQUIPE</a></li>
						<li><a href="sobre.php">SOBRE</a></li>
						<li><a href="index.php">HOME</a></li>
					<?php if(userLogado()){
						echo "
						<li><a href='user_logout.php'>SAIR</a></li>";
					}
					?>
				</ul>
            </div>

			<?php if(!userLogado()){ ?>
				<div id="entrar">
					<p><center><a href="user_formulario.php">Cadastre-se / Entrar</a></center></p>
				</div>
			<?php } ?>
