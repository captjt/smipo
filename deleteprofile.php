<?php

require('connect.php'); 
  
if(empty($_SESSION)) // if the session not yet started 
    session_start();

$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$status = $_SESSION['status'];
$logged_in = $_SESSION['logged_in'];
$member_id = $_SESSION['user_id'];
$outputResult = '';

if($logged_in):
 
  if($status>0):
    #query to delete the members account
    $queryMember = "DELETE FROM `members` WHERE `username` = '$username'";
    $queryOutput = mysql_query($queryMember);
    if(mysql_affected_rows()>0):
      $firstQuery = true;
    else:
      $firstQuery = false;
    endif;
    
    $queryCheckPosition = "Select * from department_assignment where `member_id` = '$member_id'";
    $queryCheckPosition = mysql_query($queryCheckPosition);

    #this is seeing if the member is already assigned a position to delete from this table as well
    if(mysql_num_rows($queryCheckPosition)==1):
      if($firstQuery==true):
        $queryMember = "DELETE FROM `department_assignment` WHERE `member_id` = '$member_id'";
        $queryMember = mysql_query($queryMember);
        if(mysql_affected_rows()>0):
          $outputResult .= '<span style="color:#0000ff">Successfully Deleted Profile</span><br />';
          header("Location:logout.php");
        else:
          $outputResult .= '<span style="color:#ff0000">Error Deleting Profile 2</span><br />';
        endif;
      else:
        header("Location:logout.php");
      endif;

    endif; 
  
  elseif($status==0):
    #query to delete the members account
    $queryMember = "DELETE FROM `members` WHERE `username` = '$username'";
    $query = mysql_query($queryMember);
    if(mysql_affected_rows()>0):
      $outputResult .= '<span style="color:#0000ff">Successfully Deleted Profile</span><br />';
      header("Location:logout.php");
    else:
      $outputResult .= '<span style="color:#ff0000">Error Deleting Profile 1</span><br />';
    endif;
  else:

    echo "I got here";

  endif;

else:

  header("Location:login.php");

endif;

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Delete Profile</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/smipo.css" rel="stylesheet">

  <!-- Fonts -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

  <!-- Javascript for Validation -->
  <script src="js/validateRegister.js" type="text/javascript"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

      <?php require_once("navigation.php"); ?>

      <div class="container">
        <div class="row">
              <div class="box">
                  <div class="col-lg-12">
                      <hr>
                      <h2 class="intro-text text-center">
                          Profile Delete
                      </h2>
                      </hr>
                      <p>
                        <center>
                            <table class="table-condensed">
                                <tr>
                                    <td>
                                      <?php echo 'Hello '.$outputResult; ?>
                                    </td>
                                </tr>
                            </table>
                        </center>
                      </p>
                  </div>
              </div>
          </div>
      </div>
      <!-- /.container -->

      <footer>
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
                      <p>Copyright &copy; Radford SMIPO 2015</p>
                  </div>
              </div>
          </div>
      </footer>

      <!-- jQuery -->
      <script src="js/jquery.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.min.js"></script>

    </body>

    </html>