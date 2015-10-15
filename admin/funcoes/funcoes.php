<?php
function adminLogado(){
  if(isset($_SESSION['username'])){
    return true;
  }else{
    return false;
  }
}
?>
