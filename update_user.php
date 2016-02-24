<?php

require('connect.php');

  if(empty($_SESSION)) // if the session not yet started 
      session_start();

if($_SESSION['status']<2)
{
  echo '<script language="javascript">';
  echo 'alert("You do not have high enough permissions")';
  echo '</script>';
  header("Location:login.php");
}

$errorMsg = '';

$status = $_POST['status'];
$username = $_SESSION['selectedUsername'];
$_SESSION['searchError'] = "";

if($status==="Public"):
  $statusNumber = 0;
elseif($status==="Member"):
  $statusNumber = 1;
elseif($status==="Administrator"):
  $statusNumber = 2;
else:
  #should not execute
endif;

#query to update database with the admin's input for username
$query = "UPDATE `members` SET `status` = $statusNumber WHERE `username` = '$username'";
$query = mysql_query($query);


#checking if the result is NULL
if (!$query){
  $errorMsg = '<span style="color:#ff0000">Could not run update</span><br />';
  $_SESSION['searchError'] = $errorMsg;
  header("Location:admin.php");
}
else{
  $_SESSION['searchError'] = '<span style="color:#0000ff">You successfully updated the users permissions</span><br />';
  header("Location:admin.php");
}

?>