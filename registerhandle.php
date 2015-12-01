<?php 
require('connect.php');

$errorMsg = '';

#checking if the username field is not NULL
#if it is NULL return error message 'username is required'
if(isset($_POST['username'])){

	#setting username variable to the input from the 'username' field in the form
	$username = $_POST['username'];

	#query to fetch if the username is already used - returns username if it is already created
	$query = mysql_query("SELECT username FROM members WHERE username='".$username."'");

	#run if statement to see if the query returned a username that was already created
	#if the username is already created return an error message telling us it exists
	if (mysql_num_rows($query) != 0){
		$errorMsg .= '<span style="color:#ff0000">Username already exists</span><br />';
	}

	#setting variables to get selected fields from the form
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$useremail = $_POST['email'];
	$userpass = $_POST['password'];
	$validpass = $_POST['ver_password'];

	#checking for html special characters
	$firstname = htmlspecialchars($firstname);
	$lastname = htmlspecialchars($lastname);
	$username = htmlspecialchars($username);

	#checking for slashes
	$firstname = stripslashes($firstname);
	$lastname = stripslashes($lastname);
	$username = stripslashes($username);

	#checking our fields are not null
	if(!$firstname){
		$errorMsg .= '<span style="color:#ff0000">Your first name is required</span><br />';
	}
	if(!$lastname){
		$errorMsg .= '<span style="color:#ff0000">Your last name is required</span><br />';
	}
	if(!$username){
		$errorMsg .= '<span style="color:#ff0000">Your username is required</span><br />';
	}
	if(!$useremail){
		$errorMsg .= '<span style="color:#ff0000">Your email is required</span><br />';
	}
	if(!$userpass){
		$errorMsg .= '<span style="color:#ff0000">Your password is required</span><br />';
	}
	#checking if the password field are equal so we don't have a mismatch
	if($userpass !== $validpass){
		$errorMsg .= '<span style="color:#ff0000">Your passwords do not match</span><br />';
	}

	#making our data viable to enter into the database
	$firstname = mysql_real_escape_string($firstname);
	$lastname = mysql_real_escape_string($lastname);
	$username = mysql_real_escape_string($username);
	$useremail = mysql_real_escape_string($useremail);
	$userpass = mysql_real_escape_string($userpass);

}
else{
	$errorMsg .= '<span style="color:#ff0000">Your username is required</span><br />';
}

#if we have no errors run the sql query to insert data into the database
if(empty($errorMsg)){
	mysql_query("INSERT INTO `members`(`firstname`, `lastname`, `username`, `email`, `password`) 
		VALUES ('$firstname', '$lastname', '$username', '$useremail', '$userpass')"); 
	mysql_close($connect);
}

ini_set('display_errors', True); 
error_reporting(E_ALL | E_STRICT);
?> 

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMIPO</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/smipo.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

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


	<div class="container">
    	<div class="row">
            <div class="box">
                <div class="col-lg-12">
                	<hr>
	                    <h2 class="intro-text text-center">User Profile Information
	                        <strong></strong>
	                    </h2>
                    </hr>
                    <p>
                    	<center>
                    		<table class="table-condensed">
                    			<tr>
                    				<td>First Name :</td>
                    				<td><?php echo ($firstname); ?></td>
                    			</tr> 
                    			<tr>
                    				<td>Last Name :</td>
                    				<td><?php echo ($lastname); ?></td>
                    			</tr> 
                    			<tr>
                    				<td>Username :</td>
                    				<td><?php echo ($username); ?></td>
                    			</tr>
                    			<tr>
                    				<td>Email :</td>
                    				<td><?php echo ($useremail); ?></td>
                    			</tr>
                    			<tr>
                    				<td>
                    					<p id="error">
                    						<?php 
                    						echo "$errorMsg";
                    						?>
                    					</p>
                    				</td>
                    			</tr>
                    			<tr>
                    				<td>
                    					<a href="register.php">Back to registration</a>	
                    				</td>
                    			</tr>
                    		</table>
                    	</center>
                    </p>
				</div>
			</div>
		</div>
	</div>

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