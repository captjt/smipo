<?php

require('connect.php'); 
  
if(empty($_SESSION)) // if the session not yet started 
    session_start();

$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$status = $_SESSION['status'];
$logged_in = $_SESSION['logged_in'];
$member_id = $_SESSION['user_id'];

$errorMsg = '';

if($logged_in):
  if($status>0):
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $grad_year = $_POST['grad_year'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $queryMember = "UPDATE `members` SET `firstname` = '$firstname', `lastname` = '$lastname',
              `email` = '$email', `phone` = $phone, `graduation_year` = $grad_year
              WHERE `username` = '$username'";
    $query = mysql_query($queryMember);

    $queryCheckPosition = "Select * from department_assignment where `member_id` = '$member_id'";
    $queryCheckPosition = mysql_query($queryCheckPosition);
    if(mysql_num_rows($queryCheckPosition)==1):
      $queryMember = "UPDATE `department_assignment` SET `department_id` = '$department', 
              `position` = '$position'
              WHERE `member_id` = '$member_id'";
      $queryMember = mysql_query($queryMember);
    else:
      $queryMember = "INSERT INTO `department_assignment` (`member_id`, `department_id`, `position`) VALUES ($member_id, $department, '$position')";
      $queryMember = mysql_query($queryMember);
    endif;

  elseif($status==0):
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $grad_year = $_POST['grad_year'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

  else:

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