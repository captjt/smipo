<!DOCTYPE html>
<html lang="en">
<!-- SMIPO Create new thread
	@author James

 -->
<?php
require("connect.php");
$board_id = $_GET['board'];
$req = $_GET['req'];
$sql = 'SELECT * FROM Categories WHERE cat_id = ' . $board_id;
$result = $db->query($sql);
$row = $result->fetchRow();
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>New Thread - SMIPO</title>

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
						<?php echo "<p>Posting to the " . $row['cat_name'] . " board</p><br />";?>
                    </h2>
                    <hr>
                </div>
					<div class="row">
					<!-- main content area -->
						<div id="boards">
							<center>
							<?php
								if($req == 'new') {
									// request now equal to post
									echo "<form method='POST' action='newThread.php?board=" . $board_id . "&req=pos'>";
									echo "Topic Name: <input type='text' name='topic'><br>Post Data<br>";
									echo "<textarea name='first_reply' cols='75' rows='10'></textarea><br><br>";
									echo "<input type='submit' value='Submit'>";
									echo "</form>";
									echo "<div class='clearfix'></div>";
									
								}
								else {
									/* Get topic info from post and user info from session variables */
									$topic_name = $_POST['topic'];
									$first_reply = $_POST['first_reply'];
									$username = $_SESSION['user'];
									$user_id = $_SESSION['user_id'];
									$logged_in = $_SESSION['logged_in'];
									$status = $_SESSION['status'];
									/* sanitize topic & first_reply */
									$topic_name = htmlspecialchars($topic_name);
									$topic_name = stripslashes($topic_name);
									$topic_name = mysql_real_escape_string($topic_name);
									//$first_reply = htmlspecialchars($first_reply);
									//$first_reply = stripslashes($first_reply);
									//$first_reply = mysql_real_escape_string($first_reply);
									/* getting board name */
									$board_sql = "SELECT * FROM Categories WHERE cat_id = $board_id";
									$board_result = $db->query($board_sql);
									$board_row = $board_result->fetchRow();
									$board_name = $board_row['cat_name'];
									/* end getting board name */
									/* user is logged in and allowed to post */
									if ($logged_in == true && $status >= 0) {
										$insert_sql = "INSERT INTO Topics (topic_subject, topic_date, topic_cat, topic_by, board_id)" .
													  " VALUES ('$topic_name', CURDATE(), '$board_name', '$username', $board_id)";
										$db->query($insert_sql);
										
										/* getting our newly created thread's ID */
										// FIX THIS QUERY 
										$id_sql = "SELECT * FROM Topics WHERE topic_by = '$username' ORDER BY topic_id DESC LIMIT 1";
										//$id_sql = "SELECT * FROM Topics WHERE topic_subject = '$topic_name' AND topic_by = '$username' ORDER BY topic_id DESC";
										$id_result = $db->query($id_sql);
										$id_row = $id_result->fetchRow();
										$thread_id = $id_row['topic_id'];
										/* end getting thread ID */
										
										/* insert first reply into Replies table */
										$insert_sql = "INSERT INTO Replies (reply_content, reply_date, reply_topic, reply_by, thread_id)" .
													  " VALUES ('$first_reply', CURDATE(), '$topic_name', $user_id, $thread_id)";
									    $db->query($insert_sql);
										/* end insert */
										header("Location: thread.php?board=$board_id&thread=$thread_id");
										/*
										INSERT INTO TOPICS (topic_subject, topic_date, topic_cat, topic_by, board_id)
										VALUES ("Hello world", CURDATE(), "Automotive", "jt0021", 1)
										*/
									}
									/* user is not allowed */
									else {
										echo "Not allowed to post";
									}
								}
							?>
							</center>
							
						</div>
						
					</div>
					
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
