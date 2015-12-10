<?php
require_once("template/header.php");
?>
<div class="alert alert-success"><center>Localização</center></div>
			<div id="mapaSinal"></div>
			<form action="sinal_confirmaCad.php"  name="formSinal" method="POST" style="position:fixed; bottom:5%; right:5%; z-index:100;">
				<?php
					$titulo = $_POST["titulo"];
					$categoria = $_POST["categoria"];
					$descricao = $_POST["descricao"];
				?>
				<input type="hidden" name="titulo" class="formSinalInput" maxlength="45" minlength="3" required value="<?php echo $titulo; ?>"><br>
				<input type="hidden" name="categoria"  id="tipo" value="<?php echo $categoria; ?>">
				<input type="hidden" style="display:none;" name="descricao" value="<?php echo $descricao; ?>">
				<input type="hidden" name="latitude"   id="lat" value="-23.6255903">
				<input type="hidden" name="longitude"   id="lng" value="-45.4241453"><br>
				<input type="submit" value="Salvar" class="button botaoSubmitSinal" style="background-color: #e89401;" onclick="return validar();">
			</form>

	<script>
		var iconObras = 'imagens/sinal_obras.png';
		var iconInterditado = 'imagens/sinal_interditado.png';
		var iconAcidentado = 'imagens/sinal_acidentado.png';
		var iconOutros = 'imagens/sinal_outros.png';
		var marker = '';
		var map = '';
		var mlat = document.getElementById("lat").value;
		var mlgn = document.getElementById("lng").value;

		function initMap() {
		   map = new google.maps.Map(document.getElementById('mapaSinal'), {
			zoom: 15,
			center: {lat: parseFloat(mlat), lng: parseFloat(mlgn)},
			disableDefaultUI: true
		  });
			loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);

		var categoria = document.getElementById("tipo").value;
			if(categoria == 'OB'){
				addMarker(iconObras);
			}
			if(categoria == 'IT'){
				addMarker(iconInterditado);
			}
			if(categoria == 'AC'){
				addMarker(iconAcidentado);
			}
			else if(categoria == 'OT'){
				addMarker(iconOutros);
			}

			google.maps.event.addListener(marker, "dragend", function(event){
			 document.getElementById("lat").value = event.latLng.lat();
			 document.getElementById("lng").value = event.latLng.lng();
			});

			// FUNÇÃO QUE CARREGA KML
			function loadKmlLayer(src, map) {
					var kmlLayer = new google.maps.KmlLayer(src, {suppressInfoWindows: true, preserveViewport: true,
							map: map
					});
			}
		}





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
<?php require_once("template/footer.php");?>
