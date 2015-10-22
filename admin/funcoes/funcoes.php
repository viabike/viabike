<?php
function adminLogado(){
  if(isset($_SESSION['email'])){
    return true;
  }else{
    return false;
  }
}
?>
