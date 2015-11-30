<?php require_once("template/header.php");?>

	<center>
	<div id="formWindow">
		<form action="sinal_form_cadastro_part2.php" class="formSinal" name="formSinal" method="POST">
			<center>
				<h1>Cadastrar sinalização</h1><br>
			</center>

			<div class="form_user2">
				<span style="font-size:2em;">Titulo:</span><input type="text" name="titulo" style="width:calc(90% - 2px);" class="form" maxlength="45" minlength="3" required><br>
				<span style="font-size:2em;">Categoria:</span>
				<select name="categoria" class="form" style="width:100%">
				<option value="OB" selected>Obras</option>
				<option value="IT">Interditado</option>
				<option value="AC">Acidentado</option>
				<option value="OT">Outros</option>
				</select><br>
				<span style="font-size:2em;">Descrição:</span><textarea style="padding:5px; width:calc(100% - 12px);" class="form" name="descricao"></textarea><br>
                <input type="submit" value="Prosseguir" style="float:right;" class="button botaoSubmitSinal">
			</div>
		</form>
	</div>
	<center>
<?php require_once("template/footer.php");?>
