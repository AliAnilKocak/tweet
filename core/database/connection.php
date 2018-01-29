<?php

  $dsn = 'mysql:host=localhost; dbname=tweety';
  $user = 'root';
  $pass = 'rootroot';

  try{
    $pdo = new PDO($dsn,$user,$pass);
  }
  catch(PDOException $e){
    echo 'Connection error!'.$e->getMessage();
  }
?>
