<!DOCTYPE html>
<html lang="en">
<!-- SMIPO Board Selection
	@author James

 -->
<?php
require("connect.php");

if(empty($_SESSION)) // if the session not yet started
    session_start();

$username = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$status = $_SESSION['status'];
$logged_in = $_SESSION['logged_in'];
$_SESSION['toggle'] = false;
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
                    <h2 class="intro-text text-center">SMIPO Boards
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
					<input type="submit" class="btn btn-primary" value="Submit" style="float:left">
					</form>
				</div>
			</div>
                <div class="row">
						<?php
							/* display loop
							   grabs all information from Categories table and
							   displays them accordingly.
							*/
							function displayLoop($preparedSQL) {
								require("connect.php");
								$result = $db->query($preparedSQL);
								echo "<table class='table forum table-striped'>";
								echo "<thead><tr>";
								echo "<th class='cell-stat'> <h3><strong>Public Topics</strong></h3> </th></thead>";
                                echo "<tbody>";
								while ($row = $result->fetchRow()) {
									echo "<tr class='cell-stat'>";
									echo "<td><h4>" . "<a href='boards.php?id=" . $row['cat_id'] . "&page=0'>" . $row['cat_name'] . '</a> ' . "<br>";
									echo "<small>" . $row['cat_description'] . "</small> </h4> </td>";
									echo "</tr>";
								}
								echo "</tbody></table>";
							}

              function displayLoopMember($preparedSQL) {
                require("connect.php");
                $result = $db->query($preparedSQL);
                echo "<table class='table forum table-striped'>";
                echo "<thead><tr>";
                echo "<th class='cell-stat'> <h3><strong>Member Topics</strong></h3> </th></thead>";
                echo "<tbody>";
                while ($row = $result->fetchRow()) {
                    echo "<tr class='cell-stat'>";
                    echo "<td><h4>" . "<a href='boards.php?id=" . $row['cat_id'] . "&page=0'>" . $row['cat_name'] . '</a> ' . "<br>";
                    echo "<small>" . $row['cat_description'] . "</small> </h4> </td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
              }
						?>
						<div id="boards" >
							<?php
                if($status>0):
                  $sql = 'SELECT * FROM Categories where cat_permission = "0"';
                  displayLoop($sql);
								  $sql = 'SELECT * FROM Categories where cat_permission = "1"';
                  displayLoopMember($sql);
                elseif($status==0):
                  $sql = 'SELECT * FROM Categories where cat_permission = "0"';
                  displayLoop($sql);
                endif;
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
