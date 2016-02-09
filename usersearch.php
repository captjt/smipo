<?php

require('connect.php');

session_start();

$errorMsg = '';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$username = htmlspecialchars($username);

$username = mysql_real_escape_string($username);

#query to search database with the admin's input for username
/*$query = mysql_query("SELECT members.member_id, firstname, lastname, username, status, department_id, position 
  FROM `members` 
  INNER JOIN `department_assignment`
  ON members.member_id = department_assignment.member_id
  WHERE `username` = '$username'");
*/

$query2 = "Select *
            from (
              Select members.member_id, firstname, lastname, username, status, department_assignment.department_id, position, name 
              from `members`
              inner join `department_assignment`
              on members.member_id = department_assignment.member_id
              inner join `department`
              on department_assignment.department_id = department.department_id ) as alias
            where firstname = '$firstname' and lastname = '$lastname'";

$query = mysql_query($query2);

#checking for valid rows from $query
if (mysql_num_rows($query) === 0){
  $errorMsg .= '<span style="color:#ff0000">There are no members accounts</span><br />';
}

#checking if the result is NULL
if (!$query){
  echo 'Could not run query: ' . mysql_error();
  exit;
}
#checking each returned value from the query - with '$username'
if (mysql_num_rows($query)){
  while($row = mysql_fetch_array($query)) { 
    $member_id = $row['member_id'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $status = $row['status'];
    $department_id = $row['department_id'];
    $position = $row['position'];
    $department = $row['name'];
    break;
  }
}
else{
  #set error message
  $errorMsg .= '<span style="color:#ff0000">Invalid Username</span>';
}


#function to be used later
#NOTE query doesn't fetch correctly
function getDepartment($dept_id)
{
  #query to run and fetch the department name for the user's account
  $dept_query = mysql_query("SELECT name from `department` where `department_id` = '$dept_id'");

  #checking if the result is NULL
  if (!$query){
    echo 'Could not run query: ' . mysql_error();
    exit;
  }
  #checking each returned value from the query - with '$username'
  if (mysql_num_rows($query)){
    while($row = mysql_fetch_array($query)) { 
      $result = $row['name'];
      break;
    }
  }
  echo "$result";
  #return result from query
  return $result;
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
        <div class="brand">Radford SMIPO</div>
        <div class="address-bar">Radford's Division of SMIPO | <a href="https://www.radford.edu/content/radfordcore/home.html"> Radford University </a> | Radford, Virginia</div>

        <!-- Navigation -->
        <nav class="navbar navbar-default" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
              <a class="navbar-brand" href="index.html">SMIPO</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li>
                  <a href="index.html">Home</a>
                </li>
                <li>
                  <a href="about.php">About</a>
                </li>
                <li>
                  <a href="">Forum</a>
                </li>
                <li>
                  <a href="login.php">Login</a>
                </li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
          </div>
          <!-- /.container -->
        </nav>

        <center>
          <div class="container">
            <div class="row">
              <div class="box">
                <div class="col-lg-12">
                  <hr>
                  <h2 class="intro-text text-center">Change the status and department position for 
                    <strong><?php echo "$firstname $lastname"; ?></strong>
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
                <form name="update_user" id="update_user" action="update_user" method="post">
                  <center>
                    <table class="table-condensed">
                      <tr>
                        <td>First Name:</td>
                        <td class="bordered"><?php echo "$firstname"; ?></td>
                        <td id="firstname-err"></td>
                      </tr>
                      <tr>
                        <td>Last Name:</td>
                        <td class="bordered"><?php echo "$lastname"; ?></td>
                        <td id="lastname-err"></td>
                      </tr>
                      <tr>
                        <td>Update Status</td>
                        <td><input type="text" width="30" name="status" id="status" placeholder="<?php echo "$status"; ?>" required/>
                        </td>
                        <td id="status-err"></td>
                      </tr>
                      <tr>
                        <td>Update Department</td>
                        <td><input type="text" width="30" name="department" id="department" placeholder="<?php echo "$department"; ?>" required/></td>
                        <td id="department-err"></td>
                      </tr>
                      <tr>
                        <td>Update Position</td>
                        <td><input type="text" width="30" name="position" id="position" placeholder="<?php echo "$position"; ?>" required/></td>
                        <td id="position-err"></td>
                      </tr>
                      </table>
                      <button name="edit" type="submit" onclick="validateAll()" formmethod="post">Update</button>
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