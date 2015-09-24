<?php
	require_once("../conexao/conexao.php");
	require_once("template/header.php");

	$id_ponto = $_GET['id_ponto'];
	$pdo = conectar();

	$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse WHERE id_ponto = $id_ponto");
	//Executando a QUERY
	$buscaPonto -> execute();
	$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);

	foreach ($linha as $linhas):
?>
<CENTER>
	<h1>Cadastar pontos de interesse</h1><br>
		<form action="update_ponto.php" method="POST" class="form_adm">
			<div id="mapaadm"></div>
			<div id="form1">
				<input type="hidden" name="id_ponto" value="<?=$linhas->id_ponto?>" class="form">
				Nome:<input type="text" name="nome" value="<?=$linhas->nome?>" class="form"><br>
				Bairro:<input type="text" name="bairro" value="<?=$linhas->bairro?>" class="form"><br>
				Rua:<input type="text" name="rua" value="<?=$linhas->rua?>" class="form"><br>
				Número:<input type="text" name="num" value="<?=$linhas->num?>" class="form"><br>
				CEP:<input type="text" name="cep" value="<?=$linhas->cep?>" class="form"><br>
				Telefone:<input type="text" name="telefone" value="<?=$linhas->telefone?>" class="form"><br>
				Horário de Funcionamento:<input type="time" name="hr_inicio" value="<?=$linhas->hr_inicio?>" class="form"><br>
				Até:<input type="time" name="hr_fecha" value="<?=$linhas->hr_fecha?>" class="form"><br>
			</div>

			<!-- PS: A categoria não está sendo alterada -->
			<div id="form2">
				Categoria:<select name="categoria" class="form select"><br>
							<option value="BC" <?=($linhas->categoria == "BC")?'selected':''?>>Bicicletaria</option>
							<option value="PG" <?=($linhas->categoria == "PG")?'selected':''?>>Posto de Gasolina</option>
						  </select><br>

				Latitude:<input type="text" name="latitude" id="lat" value="<?=$linhas->latitude?>" class="form"><br>
				Longitude:<input type="text" name="longitude" id="lng" value="<?=$linhas->longitude?>" class="form"><br>
				<input type="submit" value="Alterar" class="button">
			</div>
		</form>
	</CENTER>
	<?php
	endforeach;
	?>
	<script>
		function initMap() {
		  var map = new google.maps.Map(document.getElementById('mapaadm'), {
			zoom: 15,
			center: {lat: -23.6255903, lng: -45.4241453}
		  });

		  var marker = new google.maps.Marker({
			map: map,
			draggable: true,
			animation: google.maps.Animation.DROP,
			position: {lat: -23.6255903, lng: -45.4241453}
		  });

		  google.maps.event.addListener(marker, "dragend", function(event){
			document.getElementById("lat").value = event.latLng.lat();
			document.getElementById("lng").value = event.latLng.lng();
		  });

		}

		google.maps.event.addDomListener(window, 'load', initMap);
	</script>
	<?php include("template/footer.php");?>
