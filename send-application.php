<?php
// Check for empty fields
if(empty($_POST['firstname'])  		||
   empty($_POST['lastname']) 		||
   empty($_POST['email'])	||
   empty($_POST['message']) 		||
   empty($_POST['resume'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	$msg .= "No arguments Provided!";
	$sent = false;
   }

else {
   	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email_address = $_POST['email'];
	$message = $_POST['message'];
	$resume = $_POST['resume'];

	// Create the email and send the message
	$to = 'cwolf4@radford.edu';
	$email_subject = "Applicatant Contact:  $firstname $lastname";
	$email_body = "You have a new applicant\n\n"."Here are the details:\n\nName: $firstname $lastname\n\nEmail: $email_address\n\nMessage: $message\n\nResume:\n$resume";
	$headers = "From: \n";
	$headers .= "Reply-To: $email_address";
	mail($to,$email_subject,$email_body,$headers);
	$sent = true;
   }

if ($sent) {
	$msg .= "Your application was successfully submitted - please wait 1 to 2 weeks for a response!";
}
else {
	echo "Your application was not successfully submitted - please re-enter your information or try again later.";
}
?>

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
    <!-- Nothing yet for Validation -->

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
                    <h2 class="intro-text text-center">
                        Application Submission
                    </h2>
                    </hr>
                    <center>
                    <p>
                        <?php echo $msg; ?>
                    </p>
                    </center>
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
