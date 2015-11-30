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
		<link rel="stylesheet" href="/ui/css/black-tie/jquery-ui-1.10.4.custom.min.css" id="theme">
		<script src="/ui/js/jquery-ui.min.js"></script>
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

<?php if (!userLogado()) { ?>
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
