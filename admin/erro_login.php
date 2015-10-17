<?php include("template/header.php");?>

<style>
.botao {
	width:auto;
	padding: 0 25px;
	height:30px;
	background: #BD4040;
	border-radius:4px;
	cursor:pointer;
	color:#fff;
}
</style>	

<body onload=iniciarContagem()>
	<script>
	// SCRIPT PARA REDIRECIONAR PARA OUTRA PÁGINA DEPOIS DE UM DETERMINADO TEMPO
		//tempo para o redirecionamento em segundos
		var cont = 30;
		 
		function iniciarContagem()
		{
		   if ((cont - 1) >= 0)
		   {
			   cont--;
			   contagem.innerText = 'Você será redirecionado para a tela de login em ' + cont + ' segundos';
			   setTimeout('iniciarContagem()',1000);
		   }
		   if (cont == 0)
		   {
				window.location.href='index.php';
		   }
		}
	</script>
	<div>
		ALGO SAIU ERRADO. <br>
		Verifique se seu nome de usuário está correto; <br>
		Verifique se sua senha está correta; <br>
		Tenha certeza que está utilizando uma conta de usuário com permissões administrativas. 
		<br><br>
		<b><div id=contagem></div></b>
		
		<a href="index.php"><button class="botao">Ir para login agora</button></a>
	</div>
	<br>


<?php include("template/footer.php");?>