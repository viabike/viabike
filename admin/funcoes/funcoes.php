<?php
function adminLogado(){
  if(isset($_SESSION['email']) and $_SESSION['tipo'] == 'admin'){
    return true;
  }else{
    return false;
  }
}
?>
