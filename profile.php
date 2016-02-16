<?php

require('connect.php'); 
      
    if(empty($_SESSION)) // if the session not yet started 
        session_start();

    $status = $_SESSION['status'];
    $username = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
    $logged_in = $_SESSION['logged_in'];

    if($logged_in):
        #querying the users information to populate the profile page

    	$query = "Select *
				    from 
				    (
					    Select members.member_id, firstname, lastname, username, email, phone, graduation_year, status, department_assignment.department_id, position, name 
					    from `members`
					    inner join `department_assignment`
					    on members.member_id = department_assignment.member_id
					    inner join `department`
					    on department_assignment.department_id = department.department_id 
					) as alias
				    where username = '$username' AND member_id = '$user_id'";

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
			#while loop to get the data from database
			while($row = mysql_fetch_array($query)) 
			{ 
				$member_id = $row['member_id'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$email = $row['email'];
				$phone = $row['phone'];
				$grad_year = $row['graduation_year'];
				$status = $row['status'];
				$department_id = $row['department_id'];
				$position = $row['position'];
				$department = $row['name'];
				$_SESSION['searchError'] = "";
				break;
			}

			#get the status meanings from the integers in database
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
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Profile</title>

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
    						<h2 class="intro-text text-left">Change the permission status for 
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
    					<form name="update_user" id="update_user" action="update_user" method="post">
    						<center>
    							<table class="table-condensed">
    								<tr>
    									<td>First Name:</td>
    									<td class="bordered"><?php echo "$firstname"; ?></td>
    									<td id="firstname-err"><?php echo "$oneNameInvalid" ?></td>
    								</tr>
    								<tr>
    									<td>Last Name:</td>
    									<td class="bordered"><?php echo "$lastname"; ?></td>
    									<td id="lastname-err"></td>
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
    				</div>
    			</div>
    		</div>
    	</div>
    </center>

    </body>
</html>