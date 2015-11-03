<?php
session_start();
require_once("../conexao/conexao.php");
include("../admin/funcoes/funcoes.php");
// ======== SELECIONA TODOS OS REGISTROS DE PONTOS DE INTERESSE DO BANCO VIABIKE_DB =============
$pdo = conectar();
$buscaPonto = $pdo -> prepare("SELECT * FROM ponto_interesse");
//Executando a QUERY
$buscaPonto -> execute();
// ========= FIM DA SELEÇÃO ==============================================

$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me logo" style="width:100%;"></a>
                </div>
                <div id="nav">
                    <img src="imagens/menu-icon.png" alt="Menu" style="width: 100px;">
                </div>
            </div>
            <div id="menu">
                <ul>
					<?php if(userLogado()){
						echo "
						<li><a href='user_painel.php'>".$_SESSION['nome']."</a></li>";
					} ?>
						<li><a href="equipe.php">EQUIPE</a></li>
						<li><a href="sobre.php">SOBRE</a></li>
						<li><a href="index.php">HOME</a></li>
					<?php if(userLogado()){
						echo "
						<li><a href='user_logout.php'>SAIR</a></li>";
					}
					?>
				</ul>
            </div>

			<?php if(!userLogado()){ ?>
				
				<div id="entrar">
					<p><center><a href="user_formulario.php">Cadastre-se / Entrar</a></center></p>
				</div>
			<?php } ?>
			<?php if(userLogado()){?>
				<div id="pop">
					<a href="#" onclick="document.getElementById('pop').style.display='none';"><img src="imagens/close.png" alt="fechar" class="fechar"></i></a>
					<br />
						<i class="fa fa-check-circle"></i>  Logado com sucesso
				</div>
			<?php } ?>
				</ul>
            <div id="containermap">
                <div id="mapa">
                </div>

                <!--
                <div id="filtros">
                    <img src="imagens/filtroicon.png" alt="Filtros" style="width: 100px;">
                </div>
                -->
            </div>

            <script>

            //Variavel do mapa
            var map;
            var infowindow = new google.maps.InfoWindow();
            var pontos = [
            <?php
            foreach ($linha as $linhas):
            	echo '['.$linhas->id_ponto.', '.$linhas->latitude.', '.$linhas->longitude.', "'.$linhas->categoria.'", "'.$linhas->nome.'"],';
            endforeach;
              ?>];

            //Função que inicia o mapa
            function initMap() {
              map = new google.maps.Map(document.getElementById('mapa'), {
              	center: {lat: -23.6255903, lng: -45.4241453},
              	zoom: 15,
              	mapTypeId: google.maps.MapTypeId.ROADMAP
              });
              loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);

              for (var i = 0; i < pontos.length; i++) {
              	var ponto = pontos[i];
              	var myLatLng = new google.maps.LatLng(ponto[1], ponto[2]);
              	var iconPonto = '';
              	if (ponto[3] == "PG") {
            		iconPonto = '../imagens/posto1.png';
            	}else if (ponto[3] == "BC") {
            		iconPonto = '../imagens/bike1.png';
            	}
              	marker = new google.maps.Marker({
              		position: myLatLng,
              		map:map,
              		title:ponto[4].toString(),
              		icon:iconPonto
              	});
              	var id = ponto[0].toString();
              	google.maps.event.addListener(marker, "click", infoCallback(infowindow, marker, id));
              };

            }

            function getContentPonto(id){
               $.ajax({
                   type: "GET",
                   url: "/viabike/get_info_ponto.php?id="+id,
                   dataType: "json",
                   success: function(data){
                      $('#marker'+id).html(
                      '<h1>'+data.nome+'</h1>'+
                      '<h3>Localização e contato:</h3>'+
                      '<p>'+data.bairro+', '+data.rua+', '+data.num+'</p>'+
                      '<p>Tel: '+data.telefone+'</p><br>'+
                      '<h3>Funcionamento:</h3>'+
                      '<p>Das '+data.hr_inicio+' até as '+data.hr_fecha+'</p>'
                    );
                      $('#marker'+id).css('background','none');
                   }
               });
            }

            //FUNÇÃO QUE EXIBE JANELA DE INFORMAÇÕES DO PONTO
            function infoCallback (infowindow, marker, id) {
            	return function() {
            		infowindow.setContent('<div class="infoWindow" id="marker'+id+'" style="width:auto; height:auto; background: url(imagens/loading.gif) no-repeat center center;"></div>');
            		infowindow.open(map, marker);
            		getContentPonto(id);
            	}
            }

            // FUNÇÃO QUE CARREGA KML
            function loadKmlLayer(src, map){
            	var kmlLayer = new google.maps.KmlLayer(src, {
            		suppressInfoWindows: true,
            		preserveViewport: true,
            		map: map
            	});
            }

            //EVENTO QUE CHAMA FUNÇÃO initMap() QUANDO A JANELA FOR CARREGADA.
            google.maps.event.addDomListener(window, 'load', initMap);
            </script>
        </div>
    </body>
</html>
