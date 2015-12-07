<?php
ob_start();
session_start();
require_once("admin/funcoes/funcoes.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ViaBike.me</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
        <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="admin/funcoes/funcoes.js"></script>
        <script src="js/script.js"></script>
    		<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css" id="theme">
    		<script src="js/jquery-ui.min.js"></script>
		<script>
		//Tooltip config
		$(function() {
		  $( document ).tooltip({
			position: {
			  my: "center bottom-15",
			  at: "center top",
			  using: function( position, feedback ) {
				$( this ).css( position );
				$( "<div>" )
				  .addClass( "arrow" )
				  .addClass( feedback.vertical )
				  .addClass( feedback.horizontal )
				  .appendTo( this );
			  }
			},
			 items: "[tooltip]",
			 content: function() {
					  return $(this).attr("tooltip");}
		  });
		});
		$('#text-report_ifr').tooltip( "option", "disabled", true );
		$('#text-report_ifr *[title]').tooltip('disable');
		$('#text-report_ifr').tooltip('disable');
		</script>
				<style>
		  .ui-tooltip, .arrow:after {
			background: black;
			border: none;
		  }
		  .ui-tooltip {
			padding: 3px 10px;
			color: white;
			border-radius: 2px;
			font-size: 10px;
		  }
		  .arrow {
			width: 70px;
			height: 16px;
			overflow: hidden;
			position: absolute;
			left: 50%;
			margin-left: -35px;
			bottom: -16px;
		  }
		  .arrow.top {
			top: -16px;
			bottom: auto;
		  }
		  .arrow.left {
			left: 20%;
		  }
		  .arrow:after {
			content: "";
			position: absolute;
			left: 20px;
			top: -20px;
			width: 25px;
			height: 25px;
			box-shadow: 6px 5px 9px -9px black;
			-webkit-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			transform: rotate(45deg);
		  }
		  .arrow.top:after {
			bottom: -20px;
			top: auto;
		  }
	</style>
    </head>
    <body>
        <div id="wrapper">

            <div id="header">
                <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me" class="logo"></a>
                <div id="nav-header">
                    <ul>
                        <?php
                        if (userLogado()) {
                            require_once("conexao/conexao.php");
                            $conexao = conectar(); //Conexao com o banco de dados viabike_db
                            $user_buscador = $conexao->prepare("SELECT * FROM usuario WHERE email = '" . $_SESSION['email'] . "'"); //pegando todos os usuarios cadastrados
                            $user_buscador->execute(); //executando a query de uma maneira segura
                            $user = $user_buscador->fetchAll(PDO::FETCH_OBJ);
                            ?>

                            <?php
                            foreach ($user as $usuario):
                                echo "
						<li><a href='user_logout.php'>SAIR</a></li>
						<li><a href='user_painel.php'>" . $_SESSION['nome'] . "</a></li>
						<li><a href='user_painel.php'><img src='imagens/users/" . $usuario->foto . "' width='30px' height='30px'></a></li>
						<li style='color:#a7a7a7'> | </li>";
                            endforeach;
                        }
                        ?>

<?php if (!userLogado() && !isset($page)) {?>

                <li><a href="user_formulario.php"><button class="entrar">Entrar </button></a></li>
<?php } ?>
                        <li><a href="equipe.php">EQUIPE</a></li>
                        <li><a href="sobre.php">SOBRE</a></li>
                        <li><a href="index.php">HOME</a></li>
                    </ul>
                </div>
            </div>

            <div id="container">
                <div id="content">
