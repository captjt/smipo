<!DOCTYPE html>
<html lang="en">
<!-- SMIPO Sticky
	@author James

 -->
<?php
require("connect.php");

if(empty($_SESSION)) // if the session not yet started
    session_start();
	

$board_id = $_GET['board'];
$thread_id = $_GET['thread'];
$sql = "SELECT * FROM Topics WHERE topic_id=$thread_id";
$result = $db->query($sql);
$row = $result->fetchRow();
$sticky = $row['sticky'];
$status = $_SESSION['status'];
$_SESSION['toggle'] = false;

echo $status;
if ($status < 2) {
	//shouldnt be here...
	echo "<script> alert('You shouldn't be here...'); </script>";
}
else {
	if ($sticky > 0) {
		$sql2 = "UPDATE Topics SET sticky=0 WHERE topic_id=$thread_id";
		$db->query($sql2);
	}
	else {
		$sql2 = "UPDATE Topics SET sticky=1 WHERE topic_id=$thread_id";
		$db->query($sql2);
	}
}
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sticky Admin Page</title>

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
                          Sticky
                      </h2>
                      </hr>
                      <p>
                        <center>
                            <table class="table-condensed">
                                <tr>
                                    <td>
                                      <?php
                                            echo "<center>";
                                            echo "<a href='boards.php?id=$board_id&page=0'> Return to the Discussions. </a>";
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
