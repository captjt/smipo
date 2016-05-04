<?php
        
    if(empty($_SESSION)): // if the session not yet started 
        session_start();
    endif;

?>

<!DOCTYPE html>
<html lang="en">

<head>
	
	<style style="text/css">
		.ticker {
		 height: 50px;	
		 overflow: hidden;
		 position: relative;
		 background-color: black;
		 white-space: nowrap;
		}
		.ticker h3 {
		 position: absolute;
		 width: 100%;
		 height: 100%;
		 margin: 0;
		 line-height: 50px;
		 text-align: center;
		 /* Starting position */
		 -moz-transform:translateX(100%);
		 -webkit-transform:translateX(100%);	
		 transform:translateX(100%);
		 /* Apply animation to this element */	
		 -moz-animation: ticker 35s linear infinite;
		 -webkit-animation: ticker 35s linear infinite;
		 animation: ticker 35s linear infinite;
		}
		/* Move it (define the animation) */
		@-moz-keyframes ticker {
		 0%   { -moz-transform: translateX(100%); }
		 100% { -moz-transform: translateX(-750%); }
		}
		@-webkit-keyframes ticker {
		 0%   { -webkit-transform: translateX(100%); }
		 100% { -webkit-transform: translateX(-750%); }
		}
		@keyframes ticker {
		 0%   { 
		 -moz-transform: translateX(100%); /* Firefox bug fix */
		 -webkit-transform: translateX(100%); /* Firefox bug fix */
		 transform: translateX(100%); 		
		 }
		 100% { 
		 -moz-transform: translateX(-750%); /* Firefox bug fix */
		 -webkit-transform: translateX(-750%); /* Firefox bug fix */
		 transform: translateX(-750%); 
		 }
		}
	</style>




    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMIPO</title>

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
                <div class="col-lg-12 text-center">
                    <div id="carousel-smipo" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#carousel-smipo" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-smipo" data-slide-to="1"></li>
                            <li data-target="#carousel-smipo" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-responsive img-full" src="https://developer.ibm.com/apimanagement/wp-content/uploads/sites/23/2015/03/financial-services.png" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="img/investment-portfolio.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive img-full" src="http://www.ryerson.ca/science/programs/undergraduate/financialmathematics/jcr:content/center/columns/col1/image.img.jpg/1388420426693.jpg" alt="">
                            </div>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-smipo" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-smipo" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    <h2 class="brand-before">
                        <small>Welcome to</small>
                    </h2>
                    <h1 class="brand-name">Student Managed Investment Portfolio Organization (SMIPO)</h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>at
                            <strong>Radford University</strong>
                        </small>
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                    
                    </h2>
                    <hr>
                    <img class="img-responsive img-border img-left" src="img/smipo_group_1.jpg" width="320px" height="240px" alt="">
                    <hr class="visible-xs">
                    <p>
                        Welcome to the Student Managed Investment Portfolio Organization (SMIPO) website! Our goal is to allow students at Radford University an opportunity to gain practical experience in the management and decision-making processes of a corporate structured organization by participating in hands-on management of the funds of Radford University Foundation’s endowment to the Student Managed Investment Portfolio Organization.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Our Education</strong>
                    </h2>
                    <hr>
                    <p>
                        <img class="img-responsive img-border img-left" src="img/smipo_NYC.jpg" width="320px" height="240px" alt="">

                        <table class="table-condensed">
                            <tr>
                                <td>
                                    To enhance the career opportunities available to students by supplying them with a unique academic and business experience.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To provide students with the occasion for hands-on experience in business decision-making.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To acquire a solid foundation in the concepts of portfolio management and securities analysis.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To gain an appreciation of the consequences of economic, social, and political events on the financial markets.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To give students the opportunity to utilize the basic tools of accounting in an organizational setting.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To give students experience in financial reporting in an investment management setting.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To provide students with the experience of developing marketing strategies for various aspects of an organization.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To offer the opportunity to engage in recruiting and other human resource activities.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    To develop an appreciation for the complexity of interactions required in an organizational setting.
                                </td>
                            </tr>
                        </table>
                    </p>
                </div>
            </div>
        </div>
		
		<div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
						<a href="https://php.radford.edu/~smipo/boards.php?id=6&page=0">Learn More About Joining SMIPO</a>
                    </h2>
				</div>
            </div>
        </div>
	
		<div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Industry Updates</strong>
                    </h2>
                    <hr>								
					<div class="ticker">
					<h3>
					<?php
					/*Determine color and arrow of stock change */
					function setStockChange($change) {
						if ($change > 0.0) {
							return "<span style='color:green'>&uarr; $change &nbsp;&nbsp;&nbsp;&nbsp;</span>";
						}
						else {
							return "<span style='color:red'>&darr; $change &nbsp;&nbsp;&nbsp;&nbsp;</span>";
						}
					}
					
					
						$queryURL = "http://finance.yahoo.com/webservice/v1/symbols/BKCC,BCO,WTR,VR,NRZ,WBS,EMLP,CTB,SIMO,HPT,AFSI,LM,GT,CPK,SMP,OMI,OHI,MATW,IQNT,PRI,AIT,POR,GLT,HRS,KBWP,FRAF,FDP,CLH,ALE,UVV,AEE,PSCT,CCE,CACI,RMD,TSO,TAP,SCG,VAW,EMN,SSS,IYT,RCD,DGX,RMR/quote?format=json&view=detail";
						$session = curl_init($queryURL);
						curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
						$json = curl_exec($session);
						$phpObj =  json_decode($json);
						for ($i = 0; $i < 35; $i++) {
							$stock = $phpObj->{'list'}->{'resources'}[$i]->{'resource'}->{'fields'};
							echo "<span style='color:white'>" . $stock->{'symbol'} . "</span>";
							echo setStockChange($stock->{'change'});
						}
						curl_close($session);
					?>
						</h3>
					</div>
					
					<hr>
                    <p>
                        <ul class="list-group">
                            <?php
								$url = "https://feeds.finance.yahoo.com/rss/2.0/headline?s=aapl,bac,cvs,cat,rmax,wmt,t,cmc,so,mmp&region=US&lang=en-US";
								$rssOutput = getResults($url);
								$results = $rssOutput->channel;
								$count = 0;
								while( $count < count($results->item)){
								$title = $results->item[$count]->title;
								$link = $results->item[$count]->link;
								echo("<li class='list-group-item'><a href='" . $link. "'>" . $title . "</a></li>");
								$count++;	
								}
											
								function getResults($url){
									$rssOutput = simplexml_load_string(file_get_contents($url));
									return $rssOutput;
								}
							?>
                        </table>
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

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
    </script>

</body>
</html>