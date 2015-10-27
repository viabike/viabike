<?php
function adminLogado(){
  if(isset($_SESSION['email']) and $_SESSION['tipo'] == 'admin'){
    return true;
  }else{
    return false;
  }
}

function userLogado(){
  if(isset($_SESSION['email']) and $_SESSION['tipo'] == 'user'){
    return true;
  }else{
    return false;
  }
}
?>
