<?php 
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$userpass = $_POST['password'];

$dbuser="jtaylor32"; 
$password="123456"; 
$database="jtaylor32"; 
$connect = mysql_connect("localhost", $dbuser, $password); 
@mysql_select_db($database) or die( "Unable to select database"); 

mysql_query("INSERT INTO `members`(`firstname`, `lastname`, `username`, `password`) 
	VALUES ('$firstname', '$lastname', '$username', '$userpass')"); 
mysql_close($connect);

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
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
				<a class="navbar-brand" href="index.html">SMIPO</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="index.html">Home</a>
					</li>
					<li>
						<a href="about.html">About</a>
					</li>
					<li>
						<a href="blog.html">Forum</a>
					</li>
					<li>
						<a href="contact.html">Register</a>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>


	<div class="container-container">
		<table table id="table_div" class="table table-striped">
			<tr>
				<td>Username:</td>
				<td><?php echo ($_POST['firstname']); ?></td>
			</tr> 
			<tr>
				<td>Password:</td>
				<td><?php echo ($_POST['lastname']); ?></td>
			</tr> 
			<tr>
				<td>Food Culture:</td>
				<td><?php echo ($_POST['username']); ?></td>
			</tr>
			<tr>
				<td>Favorite Dish:</td>
				<td><?php echo ($_POST['password']); ?></td>
			</tr>
		</table>

		<center><em>Report any concerns to jtaylor32@radford.edu</em></center>
	</body> 
	</html> 