<!DOCTYPE html>
<html lang="en">
<!-- SMIPO Thread Selection
	@author James

 -->
<?php
require("connect.php");
$board_id = $_GET['board'];
$thread_id = $_GET['thread'];
$sql = 'SELECT * FROM Topics WHERE topic_id = ' . $thread_id;
$result = $db->query($sql);
$row = $result->fetchRow();
$topic_sub = $row['topic_subject'];
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forums - SMIPO</title>

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
						<?php echo "<p>You are viewing the " . $row['topic_subject'] . " thread.</p><br />";?>
                    </h2>
                    <hr>
                </div>
                <div class="row">
				<!-- main content area -->
						<div id="replies" >
							<?php
							
								/* Get threads */
								$sql2 = 'SELECT * FROM Replies WHERE thread_id = ' . $thread_id . ' ORDER BY reply_id ASC';
								$result2 = $db->query($sql2);
								/* set up table headers */
								echo "<table class='thread_table'>";
								echo "<tr>";
								echo "<th class='thread_header'> <strong> Poster </strong> </th>";
								echo "<th class='thread_header'> <strong> Date </strong> </th>";
								echo "<th class='thread_header'> <strong> Content </strong> </th>";
								echo "</tr>";
								/* end table headers */
								/* pull replies from database and display */
								while($replies = $result2->fetchRow()) {
									echo "<tr class='thread_row'>";
									echo "<td class='thread_data'>" . displayMember($replies['reply_by']) . "</td>";
									echo "<td class='thread_data'>" . $replies['reply_date'] . "</td>";
									echo "<td class='thread_data'>" . $replies['reply_content'] . "</td>";
									echo "</tr class='thread_data'>";
								}
								echo "</table>";
								
								function displayMember($member_id) {
									require("connect.php");
									$member_sql = 'SELECT * FROM members WHERE member_id = ' . $member_id;
									$member_result = $db->query($member_sql);
									$member = $member_result->fetchRow();
									return $member['username'];
								}
								
								echo "<form action='newPost.php?thread=$thread_id&req=new&topic=$topic_sub' method='POST'>";
								echo "<input type='submit' value='Reply'>";
								echo "</form>";
								
							?>
							<div class="clearfix"></div>
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
