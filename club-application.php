<?php

require('connect.php');

  if(empty($_SESSION)) // if the session not yet started
      session_start();

  $username = $_SESSION['user'];
  $user_id = $_SESSION['user_id'];
  $status = $_SESSION['status'];
  $logged_in = $_SESSION['logged_in'];
  $_SESSION['toggle'] = false;

  if($logged_in):
      #querying the users information to populate the application profile page

      if($status>0):
        #this is going to be not needed they are already a member

      elseif($status==0):
          $query = "Select * from members
                      where username = '$username' AND member_id = '$user_id'";
      else:
          #not a valid user
          break;
      endif;

    $query = mysql_query($query);

    #checking for valid rows from $query
		if (mysql_num_rows($query) === 0){
			#this should not happen if they are logged in
			#this query will have some sort of data entered into it
			#set error message
			$errorMsg = '<span style="color:#ff0000">There are no members accounts with that information</span><br />';
			$_SESSION['searchError'] = $errorMsg;
		}

		#checking if the result is NULL
		if (!$query){
		  echo 'Could not run query: ' . mysql_error();
		  exit;
		}

		#checking each returned value from the query - with '$username'
		if (mysql_num_rows($query))
		{
			#while loop to get the data from database for public member
			while($row = mysql_fetch_array($query))
			{
				$member_id = $row['member_id'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];

				if($row['phone']==""):
					$phone="Default";
				else:
					$phone = $row['phone'];
				endif;

				$grad_year = $row['graduation_year'];
				$_SESSION['searchError'] = "";


				break;
			}
		}
		else
		{
		  #set error message
		  $errorMsg = '<span style="color:#ff0000">There are no members accounts with that information</span><br />';
		  $_SESSION['searchError'] = $errorMsg;
		}
    else:
      header("Location:login.php");
    endif;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Club Application - SMIPO</title>

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
                    <h2 class="intro-text text-center">Enter Your Information
                        <strong></strong>
                    </h2>
                    </hr>
                    <p>
                    	<form name="register" id="register" action="registerhandle.php" method="post">
                    		<center>
                    			<table class="table-condensed">
                    				<tr>
                    					<td>First Name:</td>
                    					<td><input type="text" width="30" name="firstname" id="firstname" onblur="validateFirst();" required/></td>
                    					<td id="firstname-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Last Name:</td>
                    					<td><input type="text" width="30" name="lastname" id="lastname" onblur="validateLast();" required/></td>
                    					<td id="lastname-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Desired Username</td>
                    					<td><input type="text" width="30" name="username" id="username" onblur="validateUsername();" required/></td>
                    					<td id="username-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Email</td>
                    					<td><input type="text" width="30" name="email" id="email" onblur="validateEmail();" required/></td>
                    					<td id="email-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Password</td>
                    					<td><input type="password" width="30" name="password" id="password" onblur="validatePasswords();" required/></td>
                    					<td id="password-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Verify Password</td>
                    					<td><input type="password" width="30" name="ver_password" id="ver_password" onblur="validateVer_Password();" required/></td>
                    					<td id="ver_password-err"></td>
                    				</tr>
                    			</table>
                    			<br />
                    			<button name="register" type="submit" onclick="validateAll()" formmethod="post">Register</button>
                    		</center>
                    	</form>
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
<?php  ?>
