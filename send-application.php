<?php
// Check for empty fields
if(empty($_POST['firstname'])  		||
   empty($_POST['lastname']) 		||
   empty($_POST['major'])        ||
   empty($_POST['minor'])        ||
   empty($_POST['class-status'])        ||
   empty($_POST['student-id'])        ||
   empty($_POST['cum-gpa'])        ||
   empty($_POST['major-gpa'])        ||
   empty($_POST['email'])	||
   empty($_POST['address'])        ||
   empty($_POST['city'])        ||
   empty($_POST['cell-phone'])        ||
   empty($_POST['message']) 		||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	$msg .= "No arguments Provided!";
	$sent = false;
   }

else {
   	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
    $major = $_POST['major'];
    $minor = $_POST['minor'];
    $class_status = $_POST['class-status'];
    $student_id = $_POST['student-id'];
    $cum_gpa = $_POST['cum-gpa'];
    $major_gpa = $_POST['major-gpa'];
	$email_address = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $cell_phone = $_POST['cell-phone'];
	$message = $_POST['message'];
	$resume = uploadResume();

	// Create the email and send the message
	$to = 'jtaylor32@radford.edu';
	$email_subject = "Applicatant Contact:  $firstname $lastname";

	$email_body = "You have a new applicant\n\n".
    "Here are the details:\n\n
        Name: $firstname $lastname\n
        Major: $major\n
        Minor: $minor\n
        Class Status: $class_status\n
        Student ID: $student_id\n
        Cumulative GPA: $cum_gpa\n
        Major GPA: $major_gpa\n
        Email: $email_address\n
        Address: \n 
        $address\n
        $city\n
        Cell Phone: $cell_phone\n\n
        Previous Experience: $message\n\n
        Resume:\n$resume";
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

function uploadResume(){
    $title = $_POST;
    $target_path = "tmp/".$title;
    /* Add the original filename to our target path.
    Result is "uploads/filename.extension" */
    $target_path = $target_path . basename( $_FILES['resume']['name']);
    $file = $_FILES['resume']['tmp_name'];
    $target_path = "tmp/";
    $target_path = $target_path . basename( $_FILES['resume']['name']);
    
    if(move_uploaded_file($file, $target_path)) {
        $upload_msg = "The file ".  basename( $_FILES).
            " has been uploaded";
        return "file:///Volumes/jtaylor32/dynamic_php/smipo/" . $target_path;
    } else{
        $upload_msg = "There was an error uploading the file, please try again!";
        return "Resume was not uploaded request a new one.";
    }
    #$target_path=addslashes($target_path);
    #return $target_path;
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
