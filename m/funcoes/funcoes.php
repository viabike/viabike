<?php
function userLogado()
{
  if(isset($_SESSION['email']) and $_SESSION['tipo'] == 'user')
	return true;
  else
	return false;
}
?>
