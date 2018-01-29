<?php

  include '../core/init.php';
  $getFromU->logout();
  if($getFromU->loggedIn() === false)
  {
    header('Locatin: index.php');
  }
 ?>
