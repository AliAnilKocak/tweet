<?php

  class Tweet extends User {
    protected $pdo;

    function __contruct($pdo)
    {
      $this->pdo = $pdo;
    }
  }

 ?>
