<?php
  //echo '<li><span class="getValue">'.$_POST['hashtag'].'</span></li>';
include '../init.php';

if(isset($_POST['hashtag']))
{
  $hashtag = $getFromU->checkInput($_POST['hashtag']);

  if(substr($hashtag,0,1) === '#')
  {
    $trend = str_replace('#', '', $hashtag);
    $trends = $getFromT->getTrendByHash($trend);

    foreach ($trends as $hashtag)
    {
      echo '<li><a href="#"><span class="getValue">'.$hashtag->hashtag.'</span></a></li>';
    }
  }
}
 ?>
