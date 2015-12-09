<?php
require_once("funcoes/funcoes.php");
if(!userLogado()){
  header("location:index.php");
}
