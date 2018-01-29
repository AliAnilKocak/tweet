<?php

  include '../init.php';



  if(isset($_POST['search']) && !empty($_POST['search']))
  {
     //$search = $getFromU->checkInput($POST['search']); //bozuyo

     $result = $getFromU->search($_POST['search']);

     echo '<div class="nav-right-down-wrap">
      <ul> ';

     foreach ($result as $user) {

       echo '<li>
  		<div class="nav-right-down-inner">
			<div class="nav-right-down-left">
				<a href="'.BASE_URL.$user->username.'"><img src="'.$user->profileImage.'"></a>
			</div>
			<div class="nav-right-down-right">
				<div class="nav-right-down-right-headline">
					<a href="'.BASE_URL.$user->username.'">'.$user->screenName.'</a><span>@'.$user->username.'</span>
				</div>
				<div class="nav-right-down-right-body">

			    </div>
			</div>
		</div>
	 </li> ';
     }

     echo '</ul></div>';
  }

 ?>
