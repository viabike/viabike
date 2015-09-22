<?php
include("template/header.php");
if(adminLogado()){
?>
	<CENTER>
	<h1>Cadastar pontos de interesse</h1><br>
		<form action="confirma_ponto.php" method="POST" class="form_adm">

			<div id="mapaadm"></div>
			<div id="form1">
				<input type="hidden" name="id_ponto" class="form">
				Nome:<input type="text" name="nome" class="form"><br>
				Bairro:<input type="text" name="bairro" class="form"><br>
				Rua:<input type="text" name="rua" class="form"><br>
				Número:<input type="text" name="num" class="form"><br>
				CEP:<input type="text" name="cep" class="form"><br>
				Telefone:<input type="text" name="telefone" class="form"><br>
				Hora de Funcionamento:<input type="time" name="hr_inicio" class="form"><br>
				Até:<input type="time" name="hr_fecha" class="form"><br>
			</div>

			<div id="form2">
				Categoria:<select name="categoria" class="form select"><br>
							<option value="BC">Bicicletaria</option>
							<option value="PG">Posto de Gasolina</option>
						  </select><br>
				Latitude:<input type="text" name="latitude" class="form" id="lat" value=""><br>
				Longitude:<input type="text" name="longitude" class="form" id="lng" value=""><br>
				<input type="submit" value="Cadastrar" class="button">
			</div>
		</form>
	</CENTER>

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

<?php
include("template/footer.php");
}
else{
	header("location:index.php");
} ?>
