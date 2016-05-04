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

$searchUsername = $_POST['username'];
$errorMsg = $searchUsername;
// $firstname = $_POST['firstname'];
// $lastname = $_POST['lastname'];

#query to search database with the admin's input for username
/*$query = mysql_query("SELECT members.member_id, firstname, lastname, username, status, department_id, position 
  FROM `members` 
  INNER JOIN `department_assignment`
  ON members.member_id = department_assignment.member_id
  WHERE `username` = '$username'");
*/

// $query1 = "Select *
//             from (
//               Select members.member_id, firstname, lastname, username, status, department_assignment.department_id, position, name 
//               from `members`
//               inner join `department_assignment`
//               on members.member_id = department_assignment.member_id
//               inner join `department`
//               on department_assignment.department_id = department.department_id ) as alias
//             where username = '$searchUsername'";

$query = "Select *
            from members  
            where username = '$searchUsername'";

$query = mysql_query($query);

#checking for valid rows from $query
if (mysql_num_rows($query) === 0){
  $errorMsg .= '<span style="color:#ff0000">There are no members accounts with that information</span><br />';
  $_SESSION['searchError'] = $errorMsg;
  header("Location:admin.php");
}

#checking if the result is NULL
if (!$query){
  echo 'Could not run query: ' . mysql_error();
  exit;
}
#checking each returned value from the query - with '$username'
if (mysql_num_rows($query)==1){
  while($row = mysql_fetch_array($query)) { 
    $member_id = $row['member_id'];
    $sel_username = $row['username'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $status = $row['status'];
    // $department_id = $row['department_id'];
    // $position = $row['position'];
    // $department = $row['name'];

    $_SESSION['selectedUsername'] = $searchUsername;
    $_SESSION['searchError'] = "";
    break;
  }

  if ($status == 0):
    $status_meaning = "Public";
  elseif ($status == 1):
    $status_meaning = "Member";
  elseif ($status == 2):
    $status_meaning = "Administrator";
  else:
    $status_meaning = "Never happen";
  endif;


}
else{
  #set error message
  $errorMsg = '<span style="color:#ff0000">There are no members accounts with that information</span><br />';
  $_SESSION['searchError'] = $errorMsg;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - SMIPO</title>

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

        <center>
          <div class="container">
            <div class="row">
              <div class="box">
                <div class="col-lg-12">
                  <hr>
                  <h2 class="intro-text text-center">Change the permission status for 
                    <strong><?php echo "$searchUsername"; ?></strong>
                  </h2>
                </hr>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr class="visible-xs">
                      <h2 class="intro-text text-center">
                        <strong>REMINDER</strong> When updating the user's permissions
                      </h2>

                      <ul class="list-group">
                        <li class="list-group-item">
                          <strong>Publics</strong> are only able to view the public section of the forum and have basic site functionality
                        </li>
                        <li class="list-group-item">
                          <strong>Members</strong> are able to view and use everything the site has in store for regular club memberships
                        </li>
                        <li class="list-group-item">
                          <strong>Administrators</strong> are able to view and have admin functionality
                        </li>
                      </ul>
                </div>
            </div>
          </div>
        </div>
        

        <div class="container">
          <div class="row">
            <div class="box">
              <div class="col-lg-12">
                <form name="update_user" id="update_user" action="update_user.php" method="post">
                  <center>
                    <table class="table-condensed">
                      <tr>
                        <td>Username:</td>
                        <td class="bordered"><?php echo "$searchUsername"; ?></td>
                        <td id="username-err"></td>
                      </tr>
                      <tr>
                        <td>First Name:</td>
                        <td class="bordered"><?php echo "$firstname"; ?></td>
                        <td id="firstname-err"><?php echo "$test" ?></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td class="bordered"><?php echo "$lastname"; ?></td>
                        <td id="lastname-err"><?php echo "$test_inner" ?></td>
                      </tr>
                      <tr>
                        <td>Current Status:</td>
                        <td class="bordered"><?php echo "$status_meaning"; ?></td>
                        <td id="status-err"></td>
                      </tr>
                      <tr>
                        <td>Update Status</td>
                        <td>
                          <input type="radio" name="status" id="status" value="Public"> Public<br>
                          <input type="radio" name="status" id="status" value="Member" checked> Member<br>
                          <input type="radio" name="status" id="status" value="Administrator"> Administrator
                        </td>
                        <td id="update-status-err"></td>
                      </tr>
                    </table>
                    <button name="edit" type="submit" onclick="validateAll()" formmethod="post">Update</button>
                  </center>
                </form>
                <br />
                <form name="delete_user" id="delete_user" action="admin-deleteprofile.php">
                  <center>
                    <button name="delete" type="submit" formmethod="post">Delete User</button>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </center>

        <footer>
          <div class="container">
            <div class="row">
              <div class="col-lg-12 text-center">
                <p>Copyright &copy; Radford SMIPO 2016</p>
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