<?php
	require_once("../conexao/conexao.php");
	require_once("template/header.php");
	require_once("verificaAdmin.php");
	
	$id_ponto = $_GET['id_ponto'];
	$pdo = conectar();

	$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse where id_ponto =$id_ponto");
	//Executando a QUERY
	$buscaPonto -> execute();
	$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);

	foreach ($linha as $linhas):
?>
<script src="funcoes/funcoes.js"></script>
<CENTER>
	<h1>Alterar ponto de interesse</h1><br>
		<form action="update_ponto.php" class="form_adm" name="form_adm" method="POST">

			<div id="mapaadm"></div>
		<div id="form1">
			<input type="hidden" name="id_ponto" value="<?=$linhas->id_ponto?>" class="form">
			Nome:<input type="text" name="nome" value="<?=$linhas->nome?>" class="form"  maxlength="45" minlength="3"><br>

			Bairro:<input type="text" name="bairro" value="<?=$linhas->bairro?>" class="form"  maxlength="45" minlength="3"><br>

			Rua:<input type="text" name="rua" value="<?=$linhas->rua?>" class="form"  maxlength="45" minlength="3"><br>

			Número:<input type="text" name="num" value="<?=$linhas->num?>" class="form" maxlength="4" minlength="1"><br>

			CEP:<input type="text" name="cep" value="<?=$linhas->cep?>" class="form" maxlength="9" minlength="9"><br>

			Telefone:<input type="text" name="telefone" value="<?=$linhas->telefone?>" class="form" maxlength="12" minlength="12"><br>

			Hora de Funcionamento:<input type="time" name="hr_inicio" value="<?=$linhas->hr_inicio?>" class="form"><br>

			Até:<input type="time" name="hr_fecha" value="<?=$linhas->hr_fecha?>" class="form"><br>

		</div>

			<div id="form2">
			<!-- PS: A categoria não está sendo alterada -->
				Categoria:<select name="categoria" class="form select" id="tipo"><br>
					<option value="BC" <?=($linhas->categoria == "BC")?'selected':''?>>Bicicletaria</option>
					<option value="PG" <?=($linhas->categoria == "PG")?'selected':''?>>Posto de Gasolina</option>
				</select><br>

			Latitude:<input type="text" name="latitude" id="lat" value="<?=$linhas->latitude?>" class="form"><br>

			Longitude:<input type="text" name="longitude" id="lng" value="<?=$linhas->longitude?>" class="form"><br>

			<input type="submit" value="Alterar" class="button" onclick="return validar();">

		</form>
	</CENTER>
	<?php
	endforeach;
	?>
		<script>
		var iconBicicletaria = '../imagens/ponto_bicicletaria.png';
		var iconPosto = '../imagens/ponto_posto.png';//exemplo até colocar o original.
		var marker = '';
		var map = '';

		var mlat = document.getElementById("lat").value;
		var mlgn = document.getElementById("lng").value;
		function initMap() {

		  var map = new google.maps.Map(document.getElementById('mapaadm'), {
			zoom: 15,
			center: {lat: parseFloat(mlat), lng: parseFloat(mlgn)}
		  });

			var cat = document.getElementById("tipo").value;

			if(cat == 'BC'){
				addMarker(iconBicicletaria);
			}
			else if(cat == 'PG'){
				addMarker(iconPosto);
			}
			else{
				addMarker(iconBicicletaria);
			}

			google.maps.event.addListener(marker, "dragend", function(event){
			 document.getElementById("lat").value = event.latLng.lat();
			 document.getElementById("lng").value = event.latLng.lng();
			});

		$("#tipo").change(function() {
			var categoria = document.getElementById("tipo").value;
			if(categoria == 'BC'){
				marker.setMap(null);
				addMarker(iconBicicletaria);
			}
			if(categoria == 'PG'){
				marker.setMap(null);
				addMarker(iconPosto);
			}
		});

		function addMarker(myicon){
			 var mlat = document.getElementById("lat").value;
			 var mlgn = document.getElementById("lng").value;
			   marker = new google.maps.Marker({
				  map: map,
				  draggable: true,
				  animation: google.maps.Animation.DROP,
				  icon: myicon,
				  position: {lat: parseFloat(mlat), lng: parseFloat(mlgn)}
			  });
			google.maps.event.addListener(marker, "dragend", function(event){
			 document.getElementById("lat").value = event.latLng.lat();
			 document.getElementById("lng").value = event.latLng.lng();
			});
		}

		}

		google.maps.event.addDomListener(window, 'load', initMap);
	</script>
	<?php include("template/footer.php");?>
