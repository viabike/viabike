<?php
session_start();
require_once("funcoes/funcoes.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Viabike.me</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
        <link rel="icon" href="imagens/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="js/script.js"></script>
				<link rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css" id="theme">
		<script src="js/jquery-ui.min.js"></script>
		<script>  
		//Tooltip config    
		$(function() {
		  $( document ).tooltip({
			position: {
			  my: "center bottom-15",
			  at: "center top",
			  using: function( position, feedback ) {
				$( this ).css( position );
				$( "<div>" )
				  .addClass( "arrow" )
				  .addClass( feedback.vertical )
				  .addClass( feedback.horizontal )
				  .appendTo( this );
			  }
			},
			 items: "[tooltip]",
			 content: function() {
					  return $(this).attr("tooltip");}        
		  });
		});
		$('#text-report_ifr').tooltip( "option", "disabled", true );
		$('#text-report_ifr *[title]').tooltip('disable');
		$('#text-report_ifr').tooltip('disable');        
		</script>
				<style>
		  .ui-tooltip, .arrow:after {
			background: black;
			border: none;
		  }
		  .ui-tooltip {
			padding: 3px 10px;
			color: white;
			border-radius: 2px;
			font-size: 10px;
		  }
		  .arrow {
			width: 70px;
			height: 16px;
			overflow: hidden;
			position: absolute;
			left: 50%;
			margin-left: -35px;
			bottom: -16px;
		  }
		  .arrow.top {
			top: -16px;
			bottom: auto;
		  }
		  .arrow.left {
			left: 20%;
		  }
		  .arrow:after {
			content: "";
			position: absolute;
			left: 20px;
			top: -20px;
			width: 25px;
			height: 25px;
			box-shadow: 6px 5px 9px -9px black;
			-webkit-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			transform: rotate(45deg);
		  }
		  .arrow.top:after {
			bottom: -20px;
			top: auto;
		  }
	</style>
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
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="sobre.php">SOBRE</a></li>
                    <li><a href="equipe.php">EQUIPE</a></li>
                </ul>
            </div>

        </div>

        <div id="container">
