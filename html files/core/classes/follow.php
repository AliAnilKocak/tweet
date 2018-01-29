<?php

  class Follow extends User {
    protected $pdo;

    function __contruct($pdo)
    {
      $this->pdo = $pdo;
    }
  }

 ?>
