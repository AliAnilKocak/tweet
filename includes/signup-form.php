<?php
  if(isset($_POST['signup']))
  {
    $screenName = $_POST['screenName'];
    $password   = $_POST['password'];
    $email      = $_POST['email'];
    $error      = '';


      if(empty($screenName) or empty($password) or empty($email))
      {
        $error = 'All fields are required';
      }
      else
      {
        $email      = $getFromU->checkInput($email);
        $screenName = $getFromU->checkInput($screenName);
        $password   = $getFromU->checkInput($password);

        if(!filter_var($email))
        {
          $error = 'Invalid email formaty';
        }
        else if(strlen($screenName)>20)
        {
          $error = 'Name must be betweet in 6-20 charachters';
        }
        else if(strlen($password) < 5)
        {
          $error = 'Password is too short';
        }
        else
        {
          if($getFromU->checkEmail($email) === true)
          {
            $error = 'Email is already in use';
          }
          else
          {
            $user_id = $getFromU->create('users', array('email' => $email, 'password' => md5($password), 'screenName' => $screenName, 'profileImage' => 'assets/images/defaultProfileImage.png', 'profileCover' => 'assets/images/defaultCoverImage.png'));
            $_SESSION['user_id'] = $user_id;
            header('Location: includes/signup.php?step=1');
          }
        }
      }
}

 ?>


 <form method="post">
<div class="signup-div">
	<h3>Sign up </h3>
	<ul>
		<li>
		    <input type="text" name="screenName" placeholder="Full Name"/>
		</li>
		<li>
		    <input type="email" name="email" placeholder="Email"/>
		</li>
		<li>
			<input type="password" name="password" placeholder="Password"/>
		</li>
		<li>
			<input type="submit" name="signup" Value="Signup for Twitter">
		</li>
	</ul>
	<?php if(isset($error))

    echo ' <li class="error-li">
  	  <div class="span-fp-error">'.$error.'</div>
  	 </li>';

  ?>


</div>
</form>
