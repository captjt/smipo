<!DOCTYPE html>
<html lang="en">
<!-- SMIPO Board Selection
	@author James

 -->
<?php
if(empty($_SESSION)) // if the session not yet started
session_start();

$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$status = $_SESSION['status'];
$logged_in = $_SESSION['logged_in'];

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
				<div class="col-lg-4">
				</div>
				<div class="col-lg-4">
				</div>
				<div class="col-lg-4">
					<form method="POST" action="forum-search.php">
					<input type="text" class="form-control" id="search-field" placeholder="Search the forums..." name="query" style="float:left">
					<input type="submit" class="btn-primary" value="Submit" style="float:left">
					</form>
				</div>
			</div>
			<br>
				
                <div class="row">
				<!-- main content area -->
						<div id="boards" >
							<?php

								function dateOrSticky($th) {
									if($th['sticky'] > 0) {
										return "<strong>STICKY</strong>";
									}
									else {
										return $th['topic_date'];
									}
								}
								
								function stickyButton($th_id, $b_id) {
									if ($_SESSION['status'] > 1) {
										return "<form action='sticky.php?board=$b_id&thread=$th_id' method='post'> <button type='submit' class='btn btn-primary' value='submit'> Sticky me </button> </form>"; 
									}
									else {
										return "";
									}
								}
								
								function flaggedButton($th_id, $u_id, $b_id) {
									if ($_SESSION['status'] >= 0 & $_SESSION['logged_in']) {
										return "<form action='flag.php?user=$u_id&thread=$th_id&board=$b_id' method='post'> <button type='submit' class='btn btn-primary' value='submit'> Flag this topic </button> </form>"; 
									}
									else {
										return "";
									}
								}

								/* Get threads */
								$sql2 = 'SELECT * FROM Topics WHERE board_id = ' . $board_id . ' ORDER BY sticky DESC, topic_id DESC LIMIT 10 OFFSET ' . $page * 10;
								$result2 = $db->query($sql2);
								/* set up table headers */
								echo "<table class='table forum table-striped'>";
								echo "<thead><tr>";
								echo "<th class='cell-stat text-center hidden-xs hidden-sm'> Topic </strong> </th>";
								echo "<th class='cell-stat text-center hidden-xs hidden-sm'> Date </strong> </th>";
								echo "<th class='cell-stat-2x hidden-xs hidden-sm'> Original Poster </strong> </th>";
								echo "</tr></thead><tbody>";
								/* end table headers */
								
								/* pull threads from database and display */
								while($threads = $result2->fetchRow()) {
									echo "<tr>";
									echo "<td class='text-center'>" . "<a href='thread.php?board=" . $board_id . "&thread=" . $threads['topic_id'] . "&page=0'>"
										 . $threads['topic_subject'] . "</a> <br> " . flaggedButton($threads['topic_id'], $_SESSION['user_id'], $board_id) . "</td>";
									echo "<td class='text-center'>" . stickyButton($threads['topic_id'], $board_id) . dateOrSticky($threads) . "</td>";
									#echo "<td class='text-center'>" . $threads['topic_date'] . "</td>";
									echo "<td class='hidden-xs'>" . $threads['topic_by'] . "</td>";
									echo "</tr>";
								}
								echo "</tbody></table>";
								/* Split results into pages */
								echo "<div class='col-sm-4'></div>";
								echo "<div class='col-sm-4'>";
								$page_count_sql = 'SELECT COUNT(topic_id) as total FROM Topics WHERE board_id = ' . $board_id;
								$page_count = $db->query($page_count_sql);
								$page_result = $page_count->fetchRow();
								$total = $page_result['total'];
								/* round up */
								$total = ceil($total / 10);
								/* for loop to create page links */
								echo "<center>";
								for ($x = 0; $x < $total; $x ++) {
									echo "<a href=boards.php?id=$board_id&page=$x>$x|</a>";
								}
								echo "</center>";
								echo "</div>";
								echo "<div class='col-sm-4'></div>";
								/* end split results */
								echo "<center>";
								echo "<br><br>";
								echo "<form action='newThread.php?board=" . $board_id . "&req=new' method='POST'>";
								echo "<input type='submit' class='btn btn-primary' value='New Topic'>";
								echo "</form>";
								echo "</center>";
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
