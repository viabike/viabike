<?php include("template/header.php");?>

	<div id="formWindow">
		<form action="sinal_form_cadastro_part2.php" class="formSinal" name="formSinal" method="POST">
			<center>
				<h1>Cadastrar sinalização</h1><br>
			</center>

			<div id='formSinal'>
				<label style="font-size:2em;">Titulo:</label>   <input type="text" name="titulo" class="formSinalInput" maxlength="45" minlength="3" required><br>
				<label style="font-size:2em;">Categoria:</label><select name="categoria" class="formSinalInput selectSinal">
				<option value="OB" selected>Obras</option>
				<option value="IT">Interditado</option>
				<option value="AC">Acidentado</option>
				<option value="OT">Outros</option>
				</select><br>
				<textarea placeholder="Descrição aqui..."class="formSinalInput"name="descricao"></textarea><br>
                <input type="submit" value="Localização >>" style="margin-right: -20px;" class="button botaoSubmitSinal">
			</div>
		</form>		
	</div>
</div>	
<?php include("template/footer.php");?>
