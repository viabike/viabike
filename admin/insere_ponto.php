<?php include("template/header.php");?>
	<script src="funcoes/formatar.js"></script>
	<CENTER>
	<h1>Cadastar pontos de interesse</h1><br>
		<form action="confirma_ponto.php" class="form_adm" method="POST">
			<div id="mapaadm"></div>
			<div id='form1'>
			<input type="hidden" name="id_ponto" class="form">
			Nome:<input type="text" name="nome" class="form"><br>
			Bairro:<input type="text" name="bairro" class="form"><br>
			Rua:<input type="text" name="rua" class="form"><br>
			Número:<input type="text" name="num" class="form"><br>
			CEP:<input type="text" name="cep" class="form" maxlength="9" OnKeyPress="formatar('#####-###', this)"><br>
			Telefone:<input type="text" name="telefone" class="form" maxlength="12" OnKeyPress="formatar('##-####-####', this)"><br>
			Hora de Funcionamento:<input type="time" name="hr_inicio" class="form"><br>
			Até:<input type="time" name="hr_fecha" class="form"><br>
			</div>
			<div id='form2'>
				Categoria:<select name="categoria" class="form select" id="tipo" onchange="ChamarLink();"><br>
							<option value="BC">Bicicletaria</option>
							<option value="PG">Posto de Gasolina</option>
						  </select><br>
				Latitude:<input type="text" name="latitude" class="form" id="lat" value="-23.6255903"><br>
				Longitude:<input type="text" name="longitude" class="form" id="lng" value="-45.4241453"><br>
				<input type="submit" value="Cadastrar" class="button">
			</div>
		</form>
	</CENTER>
	<script>
		var iconBicicletaria = '../imagens/viabike_ico.png';
		var iconPosto = 'http://maps.google.com/mapfiles/kml/pal2/icon21.png';//exemplo até colocar o original.
		var marker = '';
		var map = '';
		var mlat = document.getElementById("lat").value;
		var mlgn = document.getElementById("lng").value;
		function initMap() {
		   map = new google.maps.Map(document.getElementById('mapaadm'), {
			zoom: 15,
			center: {lat: -23.6255903, lng: -45.4241453}
		  });

			addMarker(iconBicicletaria);

			google.maps.event.addListener(marker, "dragend", function(event){
			 document.getElementById("lat").value = event.latLng.lat();
			 document.getElementById("lng").value = event.latLng.lng();
			});

		}

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

		google.maps.event.addDomListener(window, 'load', initMap);
	</script>

<?php include("template/footer.php");?>
