<?php 

    # connect to the database
    require('connect.php'); 
      
    if(empty($_SESSION)) // if the session not yet started 
        session_start();
        
?>

<html>
    <div class="brand">Radford SMIPO</div>
    <div class="address-bar">Radford's Division of SMIPO | <a href="https://www.radford.edu/content/radfordcore/home.html"> Radford University </a> | Radford, Virginia
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">SMIPO</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="forum.php">Forum</a>
                    </li>
                    <?php 
                        if($_SESSION['logged_in']):
                            echo '
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hello<span class="caret"></span></a>
                                 ';
                            echo '<ul class="dropdown-menu">';
                            echo '<li><a href="profile.php">Profile</a></li>';

                            if($_SESSION['logged_in']&&$_SESSION['status']==2):
                                echo "<li>";
                                echo '<a href="admin.php">Admin</a>';
                                echo "</li";
                            else:
                                #do nothing
                            endif;

                            echo '<li><a href="logout.php">Logout</a></li>';
                            echo '</ul';
                            echo '</li>';
                        else:
                            echo '<li>';
                            echo '<a href="login.php">Login</a>';
                            echo '</li>';
                        endif;
                    ?>
                    </li>
                    <?php 
                        /*
                        if($_SESSION['logged_in']&&$_SESSION['status']==2):
                            echo "<li>";
                            echo '<a href="admin.php">Admin</a>';
                            echo "</li";
                        else:
                            #do nothing
                        endif;
                        */
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</html>