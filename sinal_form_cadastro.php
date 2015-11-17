<?php include("template/header.php");?>
		<form action="sinal_confirmaCad.php" class="formSinal" name="formSinal" method="POST">
			<center>
				<h1>Cadastrar sinalização</h1><br>
			</center>

			<div id='formSinalEsquerda'>
				Titulo:   <input type="text" name="titulo" class="formSinalInput" maxlength="45" minlength="3" required><br>
				Categoria:<select name="categoria" class="formSinalInput selectSinal">
				<option value="OB" selected>Obras</option>
				<option value="IT">Interditado</option>
				<option value="AC">Acidentado</option>
				<option value="OT">Outros</option>
				</select><br>
				<textarea placeholder="Descrição..."class="formSinalInput"name="descricao"></textarea><br>
			</div>
			<div id='formSinalDireita'>
				<div id="mapaSinal"></div>
					<input  type="hidden" name="latitude" class="formSinalInput latLng" id="lat" value="-23.6255903">
					<input  type="hidden" name="longitude" class="formSinalInput latLng lng" id="lng" value="-45.4241453">
				<input type="submit" value="Cadastrar" class="button botaoSubmitSinal" onclick="return validar();">
			</div>
		</form>
	<script>
		var iconBicicletaria = 'imagens/bike1.png';
		var iconPosto = 'imagens/posto1.png';//exemplo até colocar o original.
		var marker = '';
		var map = '';
		var mlat = document.getElementById("lat").value;
		var mlgn = document.getElementById("lng").value;

		function initMap() {
		   map = new google.maps.Map(document.getElementById('mapaSinal'), {
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