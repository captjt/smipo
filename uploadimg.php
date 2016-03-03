<?php 

	require('connect.php'); 
      
    if(empty($_SESSION)) // if the session not yet started 
        session_start();

    $username = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
    $status = $_SESSION['status'];
	$logged_in = $_SESSION['logged_in'];

	if($logged_in):

		$target_dir = "img/";
		$target_file = $target_dir . basename($_FILES["imgfile"]["name"]);
		$name = basename($_FILES["imgfile"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["imgfile"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["imgfile"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["imgfile"]["name"]). " has been uploaded.";
		        $queryMember = 
						"UPDATE `members` SET `img_source` = '$name'
		                WHERE `username` = '$username'";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

	else:
		header("Location:login.php");
	endif;
 ?>