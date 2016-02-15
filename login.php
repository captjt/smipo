<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login - SMIPO</title>

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
    						<h2 class="intro-text text-center">Enter Your User Credentials
    							<strong></strong>
    						</h2>
    					</hr>
    					<form method="post" action="loginhandle.php" >
    						<h2 class="form-signin-heading">Login</h2>
    						<label for="inputUser" class="sr-only">Username</label>
    						<input type="text" name="userid" id="userid" class="form-control" placeholder="Username" required autofocus>
    						<label for="inputPassword" class="sr-only">Password</label>
    						<input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
    						<br />
    						<button type="submit">Login</button>
    					</form>
    				</div>
                    <br />
    				<a href="register.php">Not a user?</a>
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