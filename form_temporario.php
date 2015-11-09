<?php include("template/header.php");?>
<link rel="stylesheet" type="text/css" href="admin/css/style.css">
	<script src="funcoes/funcoes.js"></script>

	<center>
		<h1>Cadastrar sinalização</h1><br>
		<form action="sinal_confirmaCad.php" class="form_adm" name="form_adm" method="POST">
			<div id="mapaadm"></div>
			<div id='form1'>
				<input type="hidden" name="id_ponto" class="form">
				Titulo:   <input type="text" name="Titulo" class="form" maxlength="45" minlength="3" required><br>
				Categoria:<select name="categoria" >
				<option value="OB" selected>Obras</option>
				<option value="IT">Interditado</option>
				<option value="AC">Acidentado</option>
				<option value="OT">Outros</option>
				</select><br>
				<textarea placeholder="Descrição"class="input"name="descricao"></textarea><br>
			</div>
			<div id='form2'>
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
