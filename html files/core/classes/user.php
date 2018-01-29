<?php

  class User {
    protected $pdo;

    function __construct($pdo)
    {
      $this->pdo = $pdo;
    }
    public function checkInput($var)
    {
      $var = htmlspecialchars($var);
      $var = trim($var);
      $var = stripcslashes($var);
      return $var;
    }
    public function login($email,$password)
    {
      $stmt = $this->pdo->prepare("SELECT user_id FROM users WHERE email = :email AND password = :password");
      $stmt->bindParam(":email",$email,PDO::PARAM_STR);
      $stmt->bindParam(":password",md5($password),PDO::PARAM_STR);
      $stmt->execute();

      $user = $stmt->fetch(PDO::FETCH_OBJ);
      $count = $stmt->rowCount();

      if($count>0)
      {
        $_SESSION['user_id'] = $user->user_id;
        header('Location: home.php');
      }
      else
      {

        return false;
      }
    }

    public function register($email,$screenName,$password)
    {
      $stmt = $this->pdo->prepare("INSERT INTO users (email,password,screenName,profileImage,profileCover) VALUES (:email,:password,:screenName,'assets/images/defaultProfileImage.png','assets/images/defaultCoverImage.png')");
      $stmt->bindParam(":email",$email,PDO::PARAM_STR);
      $stmt->bindParam(":password",md5($password),PDO::PARAM_STR);
      $stmt->bindParam(":screenName",$screenName,PDO::PARAM_STR);
      $stmt->execute();

      $user_id = $this->pdo->lastInsertId();
      $_SESSION['user_id'] = $user_id;
    }

    public function userData($user_id)
    {
      $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
      $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function logout()
    {
      $_SESSION = array();
      session_destroy();
      header('Location: ../index.php');
    }

    public function create($table, $fields = array())
    {

      $columns = implode(',', array_keys($fields));
      $values  = ':'.implode(', :', array_keys($fields));
      $sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

      //var_dump($sql);
      if($stmt = $this->pdo->prepare($sql))
      {
        foreach ($fields as $key => $data) {
          $stmt->bindValue(':'.$key, $data);
        }
        $stmt->execute();
        return $this->pdo->lastInsertId();
      }

    }


    public function update($table, $user_id, $fields = array())
    {
      $columns = '';
      $i       = 1;

      foreach ($fields as $name => $value) {
        $columns .= "{$name} = :{$name}";
        if($i < count($fields))
        {
          $columns .= ', ';
        }
        $i++;
      }
      $sql = "UPDATE {$table} SET {$columns} WHERE user_id = {$user_id}";
      if($stmt = $this->pdo->prepare($sql))
      {
        foreach ($fields as $key => $value) {
          $stmt->bindValue(':'.$key, $value);
        }
        $stmt->execute();
      }
    }

    public function checkEmail($email)
    {
      $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
      $stmt->bindParam(":email", $email, PDO::PARAM_STR);
      $stmt->execute();

      $count = $stmt->rowCount();

      if($count > 0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }





  }

 ?>
