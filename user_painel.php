<?php
include("conexao/conexao.php");
include("template/header.php");
?>

<script>
// Verifica campo de confrmação de senha e exibe mensagem de erro caso esteja errada

// Envia para o arquivo PHP as informações para ele verificar se a senha está correta ou não
$(document).ready(function () {
	$('#passNotOk').hide();
	$("#botaoOk").hide();
	
	$("#senha").change(function(){
			$.ajax({
			type: "POST",
			url: "user_painel_verifica.php",
			data: "id_usuario=<?php echo $usuario->id_usuario ?>&senha=" + $("#senha").val(),
			success: function(resultado){
				var retorno = resultado;
				getMessage(retorno);
			},
			error: function(){
				alert("Erro ao verificar os detalhes do usuario!");
			}
		 });
  });
});

//exibe mensagem caso esteja errado
function getMessage(type) {
	if (type  == 1) {
		$("#senha").css("border", "1px solid #bdc3c7");
		$('#passNotOk').hide();
		$("#botaoNotOK").hide();
		$("#botaoOk").show();
	}
	else {
		$("#senha").css("border", "1px solid #f00");
		$("#senha").val("");
		$("#passNotOk").show();
		$("#botaoNotOK").show();
		$("#botaoOk").hide();
	}
}
 </script>

<?php
echo '<h1 style="float: left; text-align: left">Editar Perfil</h1>
<a href="user_senha.php"><button class="button" style="float: right;">Alterar senha</button></a></h1><br>';

$conexao = conectar();//Conexao com o banco de dados viabike_db

$user_buscador = $conexao -> prepare("SELECT * FROM usuario WHERE email = '".$_COOKIE['email']."'");//pegando todos os usuarios cadastrados

$user_buscador -> execute();//executando a query de uma maneira segura

$user = $user_buscador->fetchAll(PDO::FETCH_OBJ);?>

<?php foreach ($user as $usuario):
?>
			<form action="user_altera.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id_usuario" value="<?=$usuario->id_usuario?>">
				Nome:<input type="text" name="nome" class="input" value="<?=$usuario->nome?>" placeholder="Ex: Exemplo de Nome" required><br>
				E-mail:<input type="email" name="email" class="input" value="<?=$usuario->email?>" placeholder="Ex: ex@exemplo.com" required><br>
				<img src="imagens/users/<?=$usuario->foto?>" width="400px">
				Foto:<input type="file" name="foto" class="input"><br>
				<input type="hidden" name="foto_velha" value="<?=$usuario->foto?>">
				
				<hr style="border:1px; padding:2px; margin-bottom:10px; border-radius:5px; background-color:rgba(204,204,204, 0.25);">
				<p id="passNotOk">
					<font color="red"><b>Senha incorreta! Tente novamente.</b></font>
				</p>
				
				Confirme sua senha:<input type="password" name="senha" id="senha" class="input" required><br>
				
				<a href="user_desativar.php?id_usuario=<?=$usuario->id_usuario?>" style="float: left;font-size:14px; line-height:65px; color:#535455;">Desativar conta</button></a>
				
				<input type="button" value="Alterar" class="button" style="float: right; background-color: #c0c0c0; cursor: auto;" id="botaoNotOK">
				<input type="submit" value="Alterar" class="button" style="float: right" id="botaoOk">
			</form>
			
			
<?php endforeach;
include("template/footer.php");
?>
