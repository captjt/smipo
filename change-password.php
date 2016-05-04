
<!DOCTYPE html>
<html lang="en">
<?php
require("connect.php");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Change Password</title>

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

    <?php require_once("navigation.php"); ?>

    <div class="container">

        <div class="row">
            <div class="box">

                <div class="col-md-12">
                    <?php 
						require('connect.php'); 
						ini_set('display_errors', 1);
						ini_set('display_startup_errors', 1);
						error_reporting(E_ALL);   

						if(empty($_SESSION)) // if the session not yet started 
							session_start();

						$username = $_SESSION['user'];
						$user_id = $_SESSION['user_id'];
						$status = $_SESSION['status'];
						$logged_in = $_SESSION['logged_in'];
						$pass1 = $_POST['pass1'];
						$pass2 = $_POST['pass2'];
						if($logged_in) {
							if ($pass1 !== $pass2 ) {
								echo "<p style='color:red;'>The passwords did not match </p>";
							}
							else if ($pass1 === $pass2 && $pass1 !== "" && $pass1 != null) {
								$updateSQL = "UPDATE members SET password='$pass1' WHERE username='$username'";
								$db->query($updateSQL);
								echo "Success!";
							}
							else {
								echo "Something went wrong";
							}
							
							echo "<br><br><br><br><a href='profile.php'>Return to Your Profile </a><br><br><br><br>";
						}
						else {
							echo "You shouldn't be here...";
						}
 ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>		

    </div>
    <!-- /.container -->

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