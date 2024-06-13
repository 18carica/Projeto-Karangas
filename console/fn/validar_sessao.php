<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_SESSION['nome'])) {
    $restaSessao = $_SESSION['expire'] - $_SESSION['start'];

    if ($restaSessao < 1) {
        session_destroy();

        echo "<script language='javascript' type='text/javascript'>
                window.location.href='index.php'
              </script>";
    }
} else {
    echo "<script language='javascript' type='text/javascript'>
            window.location.href='index.php'
          </script>";
    exit;
}
?>
