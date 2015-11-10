<?php include("template/header.php");?>
	<script src="funcoes/funcoes.js"></script>

	<center>
	<h1>Cadastrar ponto de interesse</h1><br>
		<form action="confirma_ponto.php" class="form_adm" name="form_adm" method="POST">
			<div id="mapaadm"></div>
			<div id='form1'>
			<input type="hidden" name="id_ponto" class="form">
			Nome:                 <input type="text" name="nome" class="form" maxlength="45" minlength="3" required><br>
			Bairro:               <input type="text" name="bairro" class="form" maxlength="45" minlength="3" required><br>
			Rua:                  <input type="text" name="rua" class="form" maxlength="45" minlength="3" required><br>
			Número:               <input type="text" name="num" class="form" maxlength="4" minlength="1" required><br>
			CEP:                  <input type="text" name="cep" class="form" maxlength="9" minlength="9" OnKeyPress="formatar('#####-###', this)" placeholder="Exemplo: (99999-999)" required><br>
			Telefone:             <input type="text" name="telefone" class="form" maxlength="12" minlength="12" OnKeyPress="formatar('##-####-####', this)" placeholder="Exemplo: (99-9999-9999)" required><br>
			Hora de Funcionamento:<input type="time" name="hr_inicio" class="form" required><br>
			Até:                  <input type="time" name="hr_fecha" class="form" required><br>
			</div>
			<div id='form2'>
				Categoria:<select name="categoria" class="form select" id="tipo" onchange="ChamarLink();"><br>
							<option value="BC">Bicicletaria</option>
							<option value="PG">Posto de Gasolina</option>
						  </select><br>
				Latitude:<input type="text" name="latitude" class="form" id="lat" value="-23.6255903"><br>
				Longitude:<input type="text" name="longitude" class="form" id="lng" value="-45.4241453"><br>
				<input type="submit" value="Cadastrar" class="button" onclick="return validar();">
			</div>
		</form>
	</center>
	<script>
		var iconBicicletaria = '../imagens/bike1.png';
		var iconPosto = '../imagens/posto1.png';//exemplo até colocar o original.
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
