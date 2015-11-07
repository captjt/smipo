<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register - SMIPO</title>

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
                        <a href="register.php">Register</a>
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
                    <h2 class="intro-text text-center">Enter your information
                        <strong></strong>
                    </h2>
                    </hr>
                    <p>
                    	<form name="register" id="register" action="registerhandle.php" method="post">
                    		<center>
                    			<table class="table">
                    				<tr>
                    					<td>First Name:</td>
                    					<td><input type="text" width="30" name="firstname" id="firstname" onblur="validateUsername();" /></td>
                    					<td id="firstname-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Last Name:</td>
                    					<td><input type="text" width="30" name="lastname" id="lastname" onblur="validateUsername();" /></td>
                    					<td id="lastname-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Desired Username</td>
                    					<td><input type="text" width="30" name="username" id="username" onblur="validateUsername();" /></td>
                    					<td id="username-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Email</td>
                    					<td><input type="text" width="30" name="email" id="email" /></td>
                    					<td id="email-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Password</td>
                    					<td><input type="password" width="30" name="password" id="password" onblur="validatePassword();" /></td>
                    					<td id="password-err"></td>
                    				</tr>
                    				<tr>
                    					<td>Verify Password</td>
                    					<td><input type="password" width="30" name="ver_password" id="ver_password" onblur="validateVer_Password();" /></td>
                    					<td id="ver_password-err"></td>
                    				</tr>
                    			</table>
                    			<br />
                    			<button name="register" type="submit" formmethod="post">Register</button>
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