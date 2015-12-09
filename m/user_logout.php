<?php
require_once("verificaSessao.php");

session_start();
session_destroy();
setcookie('email');
header("location:index.php"); die();
