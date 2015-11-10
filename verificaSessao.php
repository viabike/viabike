<?php
require_once("admin/funcoes/funcoes.php");
if(!userLogado()){
  header("location:index.php");
}
