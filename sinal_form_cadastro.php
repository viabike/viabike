<?php
require_once("template/header.php");
require_once("verificaSessao.php");
?>
<form action="sinal_confirmaCad.php" class="formSinal" name="formSinal" method="POST">
    <center>
        <h1>Cadastrar Sinalização</h1><br>
    </center>

    <div id='formSinalEsquerda'>
        Titulo:   <input type="text" name="titulo" class="formSinalInput" maxlength="45" minlength="3" required><br>
        Categoria:<select name="categoria" id="categoria_sinal" class="formSinalInput selectSinal">
            <option value="OB" selected>Obras</option>
            <option value="IT">Interditado</option>
            <option value="AC">Acidentado</option>
            <option value="OT">Outros</option>
        </select><br>
        <textarea placeholder="Descrição..." class="formSinalInput" name="descricao"></textarea><br>
    </div>
    <div id='formSinalDireita'>
        <div id="mapaSinal"></div>
        <input  type="hidden" name="latitude" class="formSinalInput latLng" id="lat" value="-23.6255903">
        <input  type="hidden" name="longitude" class="formSinalInput latLng lng" id="lng" value="-45.4241453">
        <input type="submit" value="Cadastrar" class="button sinalizacao botaoSubmitSinal" onclick="return validar();">
    </div>
</form>
<script>
    var iconOb = 'imagens/sinal_obras.png';//exemplo até colocar o original.
    var iconIt = 'imagens/sinal_interditado.png';//exemplo até colocar o original.
    var iconAc = 'imagens/sinal_acidentado.png';//exemplo até colocar o original.
    var iconOt = 'imagens/sinal_outros.png';//exemplo até colocar o original.    var marker = '';
    var marker = '';
    var map = '';
    var mlat = document.getElementById("lat").value;
    var mlgn = document.getElementById("lng").value;
	
		function initMap() {
		   map = new google.maps.Map(document.getElementById('mapaSinal'), {
			zoom: 15,
			center: {lat: -23.6255903, lng: -45.4241453}
		  });

			addMarker(iconOb);

			google.maps.event.addListener(marker, "dragend", function(event){
			 document.getElementById("lat").value = event.latLng.lat();
			 document.getElementById("lng").value = event.latLng.lng();
			});

		loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);
		}
		

		$("#categoria_sinal").change(function() {
			var categoria_sinal = document.getElementById("categoria_sinal").value;
			if(categoria_sinal == 'OB'){
				marker.setMap(null);
				addMarker(iconOb);
			}
			if(categoria_sinal == 'IT'){
				marker.setMap(null);
				addMarker(iconIt);
			}
			if(categoria_sinal == 'AC'){
				marker.setMap(null);
				addMarker(iconAc);
			}
			if(categoria_sinal == 'OT'){
				marker.setMap(null);
				addMarker(iconOt);
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
		
		function loadKmlLayer(src, map) {
                var kmlLayer = new google.maps.KmlLayer(src, {
                    suppressInfoWindows: true,
                    preserveViewport: true,
                    map: map
                });
            }

		google.maps.event.addDomListener(window, 'load', initMap);
	</script>
<?php require_once("template/footer.php");?>
