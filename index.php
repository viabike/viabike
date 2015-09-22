<!DOCTYPE html>
<html>
<head>
	<title>ViaBike.me</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<script src="https://maps.googleapis.com/maps/api/js"></script>
</head>
<body>
	<div id="wrapper">
	
		<div id="header">
		
			<a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me" class="logo"></a>
			
			<div id="nav-header">
				<ul>
					<li><a href="equipe.php">EQUIPE</a></li>
					<li><a href="sobre.php">SOBRE</a></li>
					<li><a href="index.php">HOME</a></li>
				</ul>	
			</div>
			
		</div>
		
		<div id="mapa"></div>
		
		<script>
		function initMap() {
		  map = new google.maps.Map(document.getElementById('mapa'), {
			center: {lat: -23.6255903, lng: -45.4241453},
			zoom: 15,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  });
		  loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);
		}
		
		function loadKmlLayer(src, map){
			var kmlLayer = new google.maps.KmlLayer(src, {
				suppressInfoWindows: true,
				preserveViewport: true,
				map: map
			});
		}
		
		google.maps.event.addDomListener(window, 'load', initMap);
		</script>
		
		<div id="content">
			<div class="text-home">
				<p>Para os ciclistas de Caraguatatuba que querem economizar tempo e encontrar uma rota segura o ViaBike.me é um sistema web que mostra um mapa de ciclovias.</p>
			</div>
			
			<div class="legenda-home" style="text-align:right">
				<ul>
					<li>Ciclovia Ativa <span class="legenda-cic-ativa">&#9679;</span></li>
					<li>Ciclovia em Obras <span class="legenda-cic-obras"> &#9679;</span></li></li>
				</ul>
			</div>
		</div>

		<div id="footer">
			<center><p>Copyright &copy 2015</p></center>
		</div>
	</div>
</body>
</html>