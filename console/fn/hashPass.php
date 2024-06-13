<?php

$senha = $_GET["psw"];
//$senha = "Maça";

 $passHash = password_hash($senha, PASSWORD_DEFAULT);
 //$passHash = "$2y$10$1TN4W/ujGuqKKdKgWbBqaeYzV42LH.fm3rx29EWY3qBVLKUOAfMM2";

echo " Senha original:".$senha."</BR></BR>";

echo " senha: ".$passHash."</BR></BR>";

if(password_verify($senha, $passHash))
  {
    echo "1";
  }
  else
  {
    echo "0";
  }

?>