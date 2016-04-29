<!DOCTYPE html>
<html lang="en">

<?php 
	require("connect.php");

	if(empty($_SESSION)) // if the session not yet started 
	    session_start();

	$status = $_SESSION['status'];
	$user = $_SESSION['user'];
	$user_id = $_SESSION['user_id'];

	#function to delete a specific reply from a specific thread	
	$thread_id = $_GET['thread_id'];

	$delete_thread_query = "DELETE FROM Topics WHERE topic_id = $thread_id";
	$query = $db->query($delete_thread_query);
	$delete_replies_query = "DELETE FROM Replies WHERE thread_id = $thread_id";
	$delete = $db->query($delete_replies_query);
	if (!$query && !$reply){
	  $errorMsg = '<span style="color:#ff0000">Could not run delete</span><br />';
	}
	else{
	  $errorMsg = '<span style="color:#0000ff">You successfully deleted the thread</span><br />';
	}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delete Thread</title>

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
                  <div class="col-lg-12">
                      <hr>
                      <h2 class="intro-text text-center">
                          Deleting Thread
                      </h2>
                      </hr>
                      <p>
                        <center>
                            <table class="table-condensed">
                                <tr>
                                    <td>
                                      <?php
                                            echo "<center>";
                                            echo "$errorMsg<br />";
											echo "<a href = 'boards.php?id=" . $_GET['board'] . "&page=0'>Return to board</a><br />";
                                            echo "<a href='forum.php'>Return to Forum</a>";
                                            echo "</center>";
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </center>
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