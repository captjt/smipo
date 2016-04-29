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
$page = $_GET['page'];

if(empty($_SESSION)) // if the session not yet started 
    session_start();

$status = $_SESSION['status'];
$user = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
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
					<?php echo "<a href = 'boards.php?id=".$_GET['board']."&page=0'>Back to board</a>"?>
					<hr>
                    <h2 class="intro-text text-center"> 
						<?php echo "<p>You are viewing the " . $row['topic_subject'] . " thread.</p><br />";?>
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
						<div id="replies" >
							<?php

								function deleteReplyButton($reply_by, $user_id, $replyID) {
									/*Status must be compared to string becuase it is stored in SESSION as string*/
									if (($_SESSION['user_id'] === $reply_by) || ($_SESSION['status'] === "2")) {
										return "<form action='delete-reply.php?reply_by=$reply_by&reply_id=$replyID' method='post'> <button type='submit' class='btn btn-primary' value='submit'> Delete Reply</button> </form>"; 
									}
									else {
										return "";
									}
								}
								function deleteThreadButton($user_id, $thread_id, $status, $db){
									$query = "SELECT * FROM `Topics` WHERE topic_id= ". $thread_id;
									$threadResult = $db->query($query);
									$thread = $threadResult->fetchRow();
									$username = thread['topic_by'];
									$user_info_query = "SELECT * FROM members WHERE username = '$username'";
									$user_info_result = $db->query($user_info_query);
									$user_info = $user_info_result->fetchRow();
									/*Status must be compared to string becuase it is stored in SESSION as string*/
									if(($user_id === $user_info['member_id']) || ($_SESSION['status'] === "2")){
										return "<form action='delete-reply.php?thread_id=" . $thread_id . "&board='" . $_GET['board'] . "'' method='post'> <button type='submit' class='btn btn-primary' value='submit'> Delete Post</button> </form>"; 
									}else{
										return "";
									}
								}
							
								/* Get threads */
								$sql2 = 'SELECT * FROM Replies WHERE thread_id = ' . $thread_id . ' ORDER BY reply_id ASC LIMIT 10 OFFSET ' . $page * 10;
								$result2 = $db->query($sql2);
								/* set up table headers */
								echo "<table class='table forum table-striped'>";
								echo "<thead><tr>";
								echo "<th class='cell-stat-2x hidden-xs hidden-sm'> Content </strong> </th>";
								echo "<th></th>";
								//echo "<th></th>";
								echo "<th class='cell-stat text-center hidden-xs hidden-sm'>  Date </strong> </th>";
								echo "<th class='cell-stat text-center hidden-xs hidden-sm'> Poster </strong> </th>";
								echo "</tr></thead><tbody>";
								/* end table headers */
								/* pull replies from database and display */
								$repliesShown = 0;
								while($replies = $result2->fetchRow()) {
									echo "<tr>";
									echo "<td class=''>" . $replies['reply_content'] . "</td>";
									echo "<td class=''>" . deleteReplyButton($replies['reply_by'], $user_id, $replies['reply_id'], $status) . "</td>"; 
									if($repliesShown === 0){
										echo "<td class=''>" . deleteThreadButton($user_id, $replies['thread_id'], $status, $db) . "</td>";
									}else{
										echo "<td class=''></td>";
									}
									echo "<td class='text-center hidden-xs hidden-sm'>" . $replies['reply_date'] . "</td>";
									echo "<td class='text-center'>" . "<img src='img/" . displayMemberPicture($replies['reply_by']) . "' height='100' width='100'>" .
									     "<br>" . displayMember($replies['reply_by']) . "</td>";
									echo "</tr>";
									$repliesShown++;
								}
								echo "</tbody></table>";
								
								/* Split results into pages */
								$page_count_sql = 'SELECT COUNT(reply_id) as total FROM Replies WHERE thread_id = ' . $thread_id;
								$page_count = $db->query($page_count_sql);
								$page_result = $page_count->fetchRow();
								$total = $page_result['total'];
								/* round up */
								$total = ceil($total / 10);
								/* for loop to create page links */
								echo "<div class='col-sm-4'></div>";
								echo "<div class='col-sm-4'>";
								for ($x = 0; $x < $total; $x ++) {
									echo "<a href=thread.php?board=$board_id&thread=$thread_id&page=$x>$x|</a>";
								}
								echo "</div>";
								echo "<div class='col-sm-4'></div>";
								/* end split results */
								
								function displayMember($member_id) {
									require("connect.php");
									$member_sql = 'SELECT * FROM members WHERE member_id = ' . $member_id;
									$member_result = $db->query($member_sql);
									$member = $member_result->fetchRow();
									return $member['username'];
								}
								function displayMemberPicture($member_id) {
									require("connect.php");
									$pic_sql = "SELECT * FROM members WHERE member_id = $member_id";
									$pic_result = $db->query($pic_sql);
									$pic = $pic_result->fetchRow();
									$picture = $pic['img_source'];
									if ($picture == null) {
										return "smipo-logo.jpg";
									}
									else {
										return $picture;
									}
								}
								echo "<br><br>";
								echo "<center>";
								echo "<form action='newPost.php?thread=$thread_id&req=new&topic=$topic_sub' method='POST'>";
								echo "<input type='submit' class='btn btn-primary' value='Reply'>";
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
