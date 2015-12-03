<!DOCTYPE html>
<html lang="en">
<?php
require("connect.php");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>About - SMIPO</title>

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

    <div class="brand">Radford SMIPO</div>
    <div class="address-bar">Radford's Division of SMIPO | <a href="https://www.radford.edu/content/radfordcore/home.html"> Radford University </a> | Radford, Virginia
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">SMIPO</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="">Forum</a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                    	About <strong>SMIPO</strong>
                    </h2>
                    <hr>
            		<p class="text-center">
            			<a href="../smipo/misc/October-2015.pdf">Montly Newsletter</a>
            		</p>
            		<hr>
            	</div>	
                <div class="col-md-6">
                    <img class="img-responsive img-border img-center" src="../smipo/img/smipo-logo.jpg" alt="">
                </div>
                <div class="col-md-6">
                    <p>
                        Our goal is to allow students at Radford University an opportunity to gain practical experience in the management and decision-making processes of a corporate structured organization by participating in hands-on management of the funds of Radford University Foundation’s endowment to the Student Management Investment Portfolio Organization.
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>		
		
        <div class="row">
            <div class="box">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="text-center">
							<button type="button" class="btn btn-primary" id="executive_button" onClick="toggleExec()">Excecutive Board</button>
							<button type="button" class="btn btn-primary" id="faculty_button" onClick="toggleFaculty()">Faculty Advisors</button>
							<button type="button" class="btn btn-primary" id="investment_button" onClick="toggleInvestments()">Investments Division</button>
							<button type="button" class="btn btn-primary" id="operations_button" onClick="toggleOperations()">Operations Division</button>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                    	Our <strong>Team</strong>
                    </h2>
                    <hr>
                </div>
				<!-- script toggles for button press. Php only activates in GET/POST requests to server so we must use JS.
					 There is probably a better way to do this, to much repeated code.
				-->
				<script>
					  var toggleExec = function() {
						  var mydiv = document.getElementById('execSQL'); // if clicked others shouldn't show up either.
						  var facdiv = document.getElementById('facSQL');
						  var invdiv = document.getElementById('invSQL');
						  var oprdiv = document.getElementById('oprSQL');
						  if (mydiv.style.display === 'block' || mydiv.style.display === '')
							mydiv.style.display = 'none';
						  else
							mydiv.style.display = 'block';
							facdiv.style.display = 'none';
							invdiv.style.display = 'none';
							oprdiv.style.display = 'none';
					  }
					  var toggleFaculty = function() {
						  var mydiv = document.getElementById('facSQL'); // if clicked others shouldn't show up either.
						  var execdiv = document.getElementById('execSQL');
						  var invdiv = document.getElementById('invSQL');
						  var oprdiv = document.getElementById('oprSQL');
						  if (mydiv.style.display === 'block' || mydiv.style.display === '')
							mydiv.style.display = 'none';
						  else
							mydiv.style.display = 'block';
							execdiv.style.display = 'none';
							invdiv.style.display = 'none';
							oprdiv.style.display = 'none';
					  }
					  var toggleInvestments = function() {
						  var mydiv = document.getElementById('invSQL'); // if clicked others shouldn't show up either.
						  var facdiv = document.getElementById('facSQL');
						  var execdiv = document.getElementById('execSQL');
						  var oprdiv = document.getElementById('oprSQL');
						  if (mydiv.style.display === 'block' || mydiv.style.display === '')
							mydiv.style.display = 'none';
						  else
							mydiv.style.display = 'block';
							execdiv.style.display = 'none';
							facdiv.style.display = 'none';
							oprdiv.style.display = 'none';
					  }
					  var toggleOperations = function() {
						  var mydiv = document.getElementById('oprSQL'); // if clicked others shouldn't show up either.
						  var execdiv = document.getElementById('execSQL');
						  var invdiv = document.getElementById('invSQL');
						  var facdiv = document.getElementById('facSQL');
						  if (mydiv.style.display === 'block' || mydiv.style.display === '')
							mydiv.style.display = 'none';
						  else
							mydiv.style.display = 'block';
							execdiv.style.display = 'none';
							invdiv.style.display = 'none';
							facdiv.style.display = 'none';
					  }
				</script>
				<div class="row">
						<?php 
							//display
							function displayLoop($preparedSQL) {
								require("connect.php");
								$counter = 0;
								$result = $db->query($preparedSQL);
								while ($row = $result->fetchRow()) {
									// 3 users per line.
									if ($counter >= 3) {
										$counter = 0;
										echo "<div class='clearfix'></div>";
									}
									echo "<div class='col-sm-4 text-center'>";
									echo "<center>";
									if ($row[img_source] == null) {
										echo "<img class='img-responsive' src='img/corporate.jpg' alt='' width='125' height='125'>";
									}
									else {
										echo "<img class='img-responsive' src=" . 'img/' . $row[img_source] . " alt='img/corporate.jpg' width='125' height='125'>";
									}
									echo "<h3>" . $row['firstname'] . ' ' . $row['lastname'] . "<br /> <small>" . $row['position'] . "</small></h3></center></div>";
									$counter = $counter + 1;
								}
							}
						?>
						<!-- Various divs based on division -->
						<div id="execSQL" style="display:none">
							<?php
								$sql = 'SELECT * FROM members INNER JOIN department_assignment ON members.member_id = department_assignment.member_id WHERE department_id = 1';
								displayLoop($sql);
							?>
							<div class="clearfix"></div>
						</div>
						<div id="facSQL" style="display:none">
							<?php
								$sql = 'SELECT * FROM members INNER JOIN department_assignment ON members.member_id = department_assignment.member_id WHERE department_id = 2';
								displayLoop($sql);
							?>
							<div class="clearfix"></div>
						</div>
						<div id="invSQL" style="display:none">
							<?php
								$sql = 'SELECT * FROM members INNER JOIN department_assignment ON members.member_id = department_assignment.member_id WHERE department_id = 3';
								displayLoop($sql);
							?>
							<div class="clearfix"></div>
						</div>
						<div id="oprSQL" style="display:none">
							<?php
								$sql = 'SELECT * FROM members INNER JOIN department_assignment ON members.member_id = department_assignment.member_id WHERE department_id = 4';
								displayLoop($sql);
							?>
							<div class="clearfix"></div>
						</div>
						<!-- end divisional divs -->
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
