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

        if($status>0):
        	$query = "Select *
    				    from 
    				    (
    					    Select members.member_id, firstname, lastname, username, email, phone, graduation_year, status, img_source, department_assignment.department_id, position, name 
    					    from `members`
    					    inner join `department_assignment`
    					    on members.member_id = department_assignment.member_id
    					    inner join `department`
    					    on department_assignment.department_id = department.department_id 
    					) as alias
    				    where username = '$username' AND member_id = '$user_id'";
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
                $img_source = $row['img_source'];
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

      if ($status == 0):
        $status_meaning = "Public";
      elseif ($status == 1):
        $status_meaning = "Member";
      elseif ($status == 2):
        $status_meaning = "Administrator";
      else:
        $status_meaning = "Never happen";
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

        <div class="container">
          <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo "$firstname $lastname"; ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3 col-lg-3 " align="center"> 
                                    <?php
                                    if ($row['img_source'] == null):
                                        echo "<img class='img-circle img-responsive' src='img/smipo-logo.jpg' alt='' width='125' height='125'>";
                                    else:
                                        echo "<img class='img-circle img-responsive' src=" . 'img/' . $row['img_source'] . " alt='img/smipo-logo.jpg' width='125' height='125'>";
                                    endif;
                                    ?>
                                </div>

            <?php 

                if($status>0):
                    echo '
                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Department</td>
                                            <td>'
                                                . $department . 
                                            '</td>
                                        </tr>
                                        <tr>
                                            <td>Position</td>
                                            <td>' 
                                                . $position .                                        
                                            '</td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td>'
                                                . $username .
                                            '</td>
                                        </tr>
                                        <tr>
                                            <td>Account Type</td>
                                            <td>'
                                                . $status_meaning .
                                            '</td>
                                        </tr>
                                        <tr>
                                            <td>Graduation Year</td>
                                            <td>' 
                                                . $grad_year .
                                            '</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>' 
                                                . $phone .
                                            '</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>
                                                <a href=' . $email . '>' . $email . '</a>
                                            </td>
                                        </tr>   
                                    </tbody>
                                </table>
                            </div>';
                else:
                    echo '
                        <div class=" col-md-9 col-lg-9 "> 
                          <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Username</td>
                                        <td>'
                                            . $username .
                                        '</td>
                                    </tr>
                                    <tr>
                                        <td>Account Type</td>
                                        <td>'
                                            . $status_meaning .
                                        '</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>    
                                            <a href=' . $email . '>' . $email . '</a>
                                        </td>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>';
                endif;
             ?>
</div>
</div>
<div class="panel-footer">
    <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
    <span class="pull-right">
        <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
        <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
    </span>
</div>

</div>
</div>
</div>
</div>

</center>

</body>
</html>