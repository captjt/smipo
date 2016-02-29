<!DOCTYPE html>
<html lang="en">
<!-- SMIPO Board Selection
	@author James

 -->
<?php
require("connect.php");
$board_id = $_GET['id'];
$sql = 'SELECT * FROM Categories WHERE cat_id = ' . $board_id;
$result = $db->query($sql);
$row = $result->fetchRow();
/* get the page */
$page = $_GET['page'];
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
						<?php echo "<p>You are viewing the " . $row['cat_name'] . " board</p><br />";?>
                    </h2>
                    <hr>
                </div>
                <div class="row">
				<!-- main content area -->
						<div id="boards" >
							<?php
								/* Get threads */
								//"SELECT * FROM `Topics` WHERE board_id = '$board_id' ORDER BY 'topic_id' ASC LIMIT '$startingThread', 25";
								$sql2 = 'SELECT * FROM Topics WHERE board_id = ' . $board_id . ' ORDER BY topic_id LIMIT 20 OFFSET ' . $page * 20;
								$result2 = $db->query($sql2);
								/* set up table headers */
								echo "<table class='thread_table'>";
								echo "<tr>";
								echo "<th class='thread_header'> <strong> Date </strong> </th>";
								echo "<th class='thread_header'> <strong> Topic </strong> </th>";
								echo "<th class='thread_header'> <strong> Original Poster </strong> </th>";
								echo "</tr>";
								/* end table headers */
								
								/* pull threads from database and display */
								while($threads = $result2->fetchRow()) {
									echo "<tr class='thread_row'>";
									echo "<td class='thread_data'>" . $threads['topic_date'] . "</td>";
									echo "<td class='thread_data'>" . "<a href='thread.php?board=" . $board_id . "&thread=" . $threads['topic_id'] . "'>" . $threads['topic_subject'] . "</a></td>";
									echo "<td class='thread_data'>" . $threads['topic_by'] . "</td>";
									echo "</tr class='thread_data'>";
								}
								echo "</table>";
								/* Split results into pages */
								$page_count_sql = 'SELECT COUNT(topic_id) as total FROM Topics WHERE board_id = ' . $board_id;
								$page_count = $db->query($page_count_sql);
								$page_result = $page_count->fetchRow();
								$total = $page_result['total'];
								/* round up */
								echo "<p> this is a test $total </p>";
								//echo $page_count;
								$total = ceil($total / 20);
								/* for loop to create page links */
								for ($x = 0; $x < $total; $x ++) {
									echo "<a href=boards.php?id=$board_id&page=$x>$x|</a>";
								}
								/* end split results */
								
								echo "<form action='newThread.php?board=" . $board_id . "&req=new' method='POST'>";
								echo "<input type='submit' value='New Topic'>";
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
                    <p>Copyright &copy; Radford SMIPO 2015 Testing</p>
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
