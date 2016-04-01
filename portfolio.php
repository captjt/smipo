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

    <title>Portfolio</title>

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
                    	<strong>Our Top Holdings</strong>
                    </h2>
					<p class="text-center"> Our portfolio contains over $1 million in assetts that our students buy, sell and grow.
					Here are our top 10 holdings.</p>
                    <hr>
            	</div>	
                <div class="col-md-12">
                    
					<table align="center">
						<tr> <th> Symbol </th> <th> Name </th> <th> Price per stock </th> <th> Change % </th> </tr>
                        <?php
						/*Determine color and arrow of stock change */
						function setStockChange($change) {
							if ($change > 0) {
								return "<p style='color:green'>&uarr; $change</p>";
							}
							else {
								return "<p style='color:red'>&darr; $change</p>";
							}
						}
					
					
					
					
					
						$symbol_array = array('BKCC', 'BCO', 'WTR', 'VR', 'NRZ', 'WBS', 'EMLP', 'CTB', 'SIMO', 'HPT');
						for ($i = 0; $i < count($symbol_array); $i++) {
							$api_url = "http://finance.yahoo.com/webservice/v1/symbols/$symbol_array[$i]/quote?format=json&view=detail";
							$session = curl_init($api_url);
							curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
							$json = curl_exec($session);
							$phpObj =  json_decode($json);
							$stock = $phpObj->{'list'}->{'resources'}[0]->{'resource'}->{'fields'};
							echo "<tr class='holdings_row'><td class='holdings_data'><p>" . $stock->{'symbol'} . "</p></td><td class='holdings_data'><p>" . $stock->{'name'} . 
							     "</p></td><td class='holdings_data'><p>$" . $stock->{'price'} . "</p></td><td class='holdings_data'>" . setStockChange($stock->{'change'}) . '</td></tr>';
							curl_close($session);
							
							
						
						
						}
						?>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>		
		

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







