<!DOCTYPE html>

<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
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
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="sobre.php">SOBRE</a></li>
                    <li><a href="equipe.php">EQUIPE</a></li>
                </ul>
            </div>

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
                function initMap() {
                    map = new google.maps.Map(document.getElementById('mapa'), {
                        center: {lat: -23.6255903, lng: -45.4241453},
                        zoom: 16,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    loadKmlLayer('http://viabike.me/mapa/mapa-das-ciclovias-v2.kml', map);
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
        </div>
    </body>
</html>
