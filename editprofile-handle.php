<?php

require('connect.php'); 
  
if(empty($_SESSION)) // if the session not yet started 
    session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'on');

$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$status = $_SESSION['status'];
$logged_in = $_SESSION['logged_in'];
$member_id = $_SESSION['user_id'];
$_SESSION['editProfileStatus'] = "";

$errorMsg = '';

if($logged_in):
  echo "$status";
  if($status>0):
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $grad_year = $_POST['grad_year'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $firstname = htmlspecialchars($firstname);
    $lastname = htmlspecialchars($lastname);
    $position = htmlspecialchars($position);
    $grad_year = htmlspecialchars($grad_year);
    $phone = htmlspecialchars($phone);
    $email = htmlspecialchars($email);
    
    $firstname = stripslashes($firstname);
    $lastname = stripslashes($lastname);
    $department = stripslashes($department);
    $position = stripslashes($position);
    $grad_year = stripslashes($grad_year);
    $phone = stripslashes($phone);
    $email = stripslashes($email);

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false):
      $email = $email;
    else:
      $errorMsg .= '<span style="color:#ff0000">Your email is not valid</span><br />';
    endif;


    #checks for null strings
    if(!$firstname):
      $errorMsg .= '<span style="color:#ff0000">Your first name is required</span><br />';
    endif;
    if(!$lastname):
      $errorMsg .= '<span style="color:#ff0000">Your last name is required</span><br />';
    endif;
    if(!$department):
      $errorMsg .= '<span style="color:#ff0000">Your department is required</span><br />';
    endif;
    if(!$position):
      $errorMsg .= '<span style="color:#ff0000">Your position is required</span><br />';
    endif;
    if(!$grad_year):
      $errorMsg .= '<span style="color:#ff0000">Your graduation year is required</span><br />';
    endif;
    if(!$email):
      $errorMsg .= '<span style="color:#ff0000">Your email is required</span><br />';
    endif;


    $firstname = mysql_real_escape_string($firstname);
    $lastname = mysql_real_escape_string($lastname);
    $position = mysql_real_escape_string($position);
    $grad_year = mysql_real_escape_string($grad_year);
    $phone = mysql_real_escape_string($phone);
    $email = mysql_real_escape_string($email);
    
    if($errorMsg==""):
      #query to update the members table for the profile - that is a member account
      $queryMember = "UPDATE `members` SET `firstname` = '$firstname', `lastname` = '$lastname',
                `email` = '$email', `phone` = $phone, `graduation_year` = $grad_year
                WHERE `username` = '$username'";
      $query = mysql_query($queryMember);

      $queryCheckPosition = "Select * from department_assignment where `member_id` = '$member_id'";
      $queryCheckPosition = mysql_query($queryCheckPosition);

      #this is seeing if the member is already assigned a position
      #if they have not been assigned yet - this will insert a new record in the department_assignment table
      if(mysql_num_rows($queryCheckPosition)==1):
        $queryMember = "UPDATE `department_assignment` SET `department_id` = '$department', 
                `position` = '$position'
                WHERE `member_id` = '$member_id'";
        $queryMember = mysql_query($queryMember);
        $_SESSION['editProfileStatus'] = '<span style="color:#0000ff">Successful Update</span><br />';
        header("Location:profile.php");
      else:
        $queryMember = "INSERT INTO `department_assignment` (`member_id`, `department_id`, `position`) VALUES ($member_id, $department, '$position')";
        $queryMember = mysql_query($queryMember);
        $_SESSION['editProfileStatus'] = '<span style="color:#0000ff">Successful Update</span><br />';
        header("Location:profile.php");
      endif; 
    else:
      $_SESSION['editProfileStatus'] = $errorMsg;
      header("Location:editprofile.php");
    endif; 

  elseif($status==0):
    echo "I got here status 2";
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $grad_year = $_POST['grad_year'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $firstname = htmlspecialchars($firstname);
    $lastname = htmlspecialchars($lastname);
    $grad_year = htmlspecialchars($grad_year);
    $phone = htmlspecialchars($phone);
    $email = htmlspecialchars($email);

    $firstname = stripslashes($firstname);
    $lastname = stripslashes($lastname);
    $grad_year = stripslashes($grad_year);
    $phone = stripslashes($phone);
    $email = stripslashes($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false):
      $email = $email;
    else:
      $errorMsg .= '<span style="color:#ff0000">Your email is not valid</span><br />';
    endif;


    #checks for null strings
    if(!$firstname):
      $errorMsg .= '<span style="color:#ff0000">Your first name is required</span><br />';
    endif;
    if(!$lastname):
      $errorMsg .= '<span style="color:#ff0000">Your last name is required</span><br />';
    endif;
    if(!$department):
      $errorMsg .= '<span style="color:#ff0000">Your department is required</span><br />';
    endif;
    if(!$position):
      $errorMsg .= '<span style="color:#ff0000">Your position is required</span><br />';
    endif;
    if(!$grad_year):
      $errorMsg .= '<span style="color:#ff0000">Your graduation year is required</span><br />';
    endif;
    if(!$email):
      $errorMsg .= '<span style="color:#ff0000">Your email is required</span><br />';
    endif;

    $firstname = mysql_real_escape_string($firstname);
    $lastname = mysql_real_escape_string($lastname);
    $grad_year = mysql_real_escape_string($grad_year);
    $phone = mysql_real_escape_string($phone);
    $email = mysql_real_escape_string($email);

    if($errorMsg==""):
      #query to update the members table for the profile - that is a member account
      $queryMember = "UPDATE `members` SET `firstname` = '$firstname', `lastname` = '$lastname',
                `email` = '$email', `phone` = $phone, `graduation_year` = $grad_year
                WHERE `username` = '$username'";
      $query = mysql_query($queryMember);
      $_SESSION['editProfileStatus'] = '<span style="color:#0000ff">Successful Update</span><br />';
      header("Location:profile.php");
    else:
      $_SESSION['editProfileStatus'] = $errorMsg;
      header("Location:[editprofile].php");
    endif; 
  else:
    echo "I got here";
  endif;

else:
  header("Location:login.php");
endif;

?>