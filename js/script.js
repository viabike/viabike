$(document).ready(function() {
	// script para fechar mensagem de erro quando clicar no X
	// página user_formulario.php
	$("#upClose").click(function() {
		$("#upMsg").hide();
	});

	$("#ufNClose").click(function() {
		$("#ufNMsg").hide();
	});

	$("#ufEClose").click(function() {
		$("#ufEMsg").hide();
	});

	$("#ufSClose").click(function() {
		$("#ufSMsg").hide();
	});

	$("#ufEIClose").click(function() {
		$("#ufEIMsg").hide();
	});

	$("#emailIndisponivelC").click(function() {
		$("#emailIndisponivel").hide();
	});

	$("#senhasDiferentesC").click(function() {
		$("#senhasDiferentes").hide();
	});

	$("#senhasIguaisC").click(function() {
		$("#senhasIguais").hide();
	});

});
