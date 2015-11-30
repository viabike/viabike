<?php
require_once("funcoes/funcoes.php");
if(!adminLogado()){
  header("location: index.php");
}
