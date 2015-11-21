<?php
ob_start();
session_start();
require_once("../conexao/conexao.php");
require_once("funcoes/funcoes.php");

//  SELECIONA TODOS OS REGISTROS DE PONTOS DE INTERESSE DO BANCO VIABIKE_DB
$pdo = conectar();
$buscaPonto = $pdo->prepare("SELECT * FROM ponto_interesse");
//Executando a QUERY
$buscaPonto->execute();
// FIM DA SELEÇÃO

$linha = $buscaPonto->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="logo">
                    <a href="index.php"><img src="imagens/viabike2.png" alt="ViaBike.me logo" style="width:100px;"></a>
                </div>
                <div id="nav">
                    <i class="fa fa-bars fa-5x icon-menu" style="font-size: 1em; color: #fff;"></i>
                </div>
            </div>

            <div id="menu">
                <ul>
                    <?php
                    if (userLogado()) {
                        echo "<li> <a href='user_painel.php'>" . $_SESSION['nome'] . "</a> <a href='user_logout.php'><i class='fa fa-sign-out'></i> </a> </li>";
                    }
                    ?>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="sobre.php">SOBRE</a></li>
                    <li><a href="equipe.php">EQUIPE</a></li>
                </ul>
            </div>

            <div id="containermap">
                <div id="mapa">
                </div>

                <?php
                if (userLogado()) {
                    $email = $_SESSION['email'];
                    $fotouser = $pdo->prepare("SELECT foto FROM usuario WHERE email = '" . $email . "'");
                    $fotouser->execute();
                    $fotolinha = $fotouser->fetchAll(PDO::FETCH_ASSOC);
                }
                ?>

                <div id="user" style="background-image: url('imagens/users/<?= $fotolinha[0]['foto'] ?>'); background-size: 100%;">
                </div>

                <?php
                if (userLogado()) {
                    echo "
                    <div id='botao-direito'>
                        <a href='sinal_form_cadastro.php'><button class='button_direito' style='background-color: #f00;'>SINALIZAR</button></a>
                    </div>
                    ";
                }
                else {
                    echo "
                    <div id='botao-direito'>
                        <a href='user_login.php'><button class='button_direito'>ENTRAR</button></a>
                    </div>
                    ";
                }
                ?>

                <div id="filtros">
                    <i class="fa fa-sliders" style="font-size: 1.65em; color: #232323;"></i>
                </div>

                <div id="filtros-menu">
                    <form id="filtro-ponto" style="margin-left:10%; margin-top:20%">
                        <h1 style="font-size:1.5em">Pontos de Interesse</h1><br>
                        <input type="radio" name="filtro-ponto" value="BC" class="filtro-input"> Bicicletarias<br>
                        <input type="radio" name="filtro-ponto" value="PG" class="filtro-input"> Postos de Gasolina<br>
                        <input type="radio" name="filtro-ponto" value="TODOS" class="filtro-input"> Todos<br>
                        <input type="radio" name="filtro-ponto" value="" class="filtro-input"> Nenhum
                    </form>

                    <form id="filtro-sinal" style="margin-left:10%; margin-top:20%">
                        <h1 style="font-size:1.5em">Sinalizações</h1><br>
                        <input type="radio" name="filtro-sinal" value="OB" class="filtro-input"> Obras<br>
                        <input type="radio" name="filtro-sinal" value="AC" class="filtro-input"> Acidentado<br>
                        <input type="radio" name="filtro-sinal" value="OT" class="filtro-input"> Outros<br>
                        <input type="radio" name="filtro-sinal" value="TODOS" class="filtro-input"> Todos<br>
                        <input type="radio" name="filtro-sinal" value="" class="filtro-input"> Nenhum
                    </form>
                    
                    <div id="filtro-botoes" style="float:right;">
                        <i class="fa fa-times" id="filtro-conf"></i>
                        <i class="fa fa-check" id="filtro-cancel"></i>                    
                    </div>
                </div>
            </div>

            <script>

                //Variavel do mapa
                var map;
                var infowindow = new google.maps.InfoWindow();
                var pontos = [
<?php
foreach ($linha as $linhas):
    echo '[' . $linhas->id_ponto . ', ' . $linhas->latitude . ', ' . $linhas->longitude . ', "' . $linhas->categoria . '", "' . $linhas->nome . '"],';
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
                        } else if (ponto[3] == "BC") {
                            iconPonto = '../imagens/bike1.png';
                        }
                        marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            title: ponto[4].toString(),
                            icon: iconPonto
                        });
                        var id = ponto[0].toString();
                        google.maps.event.addListener(marker, "click", infoCallback(infowindow, marker, id));
                    }
                    ;

                }

                function getContentPonto(id) {
                    $.ajax({
                        type: "GET",
                        url: "/viabike/get_info_ponto.php?id=" + id,
                        dataType: "json",
                        success: function (data) {
                            $('#marker' + id).html(
                                    '<h1 style="font-size: 15px">' + data.nome + '</h1>' +
                                    '<h3 style="font-size: 15px">Localização e contato:</h3>' +
                                    '<p style="font-size: 15px">' + data.bairro + ', ' + data.rua + ', ' + data.num + '</p>' +
                                    '<p style="font-size: 15px">(' + data.telefone.substr(0, 2) + ') ' + data.telefone.substr(3, 9) + '</p><br>' +
                                    '<h3 style="font-size: 15px">Funcionamento:</h3>' +
                                    '<p style="font-size: 15px">Das ' + data.hr_inicio.substr(0, 5) + ' até as ' + data.hr_fecha.substr(0, 5) + '</p>'
                                    );
                            $('#marker' + id).css('background', 'none');
                        }
                    });
                }

                //FUNÇÃO QUE EXIBE JANELA DE INFORMAÇÕES DO PONTO
                function infoCallback(infowindow, marker, id) {
                    return function () {
                        infowindow.setContent('<div class="infoWindow" id="marker' + id + '" style="width:auto; height:auto; background: url(imagens/loading.gif) no-repeat center center;"></div>');
                        infowindow.open(map, marker);
                        getContentPonto(id);
                    }
                }

                // FUNÇÃO QUE CARREGA KML
                function loadKmlLayer(src, map) {
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
