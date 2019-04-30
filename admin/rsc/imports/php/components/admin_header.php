

<!-- Navigation -->
<div class="">
    <header class="topnav bg-dark">
        <div class="container">
            <div class="row">
                <!-- social icon-->
                <div class="col-sm-12">
                    <ul class="topbuttons">
                        <li><a class="hover-effect" href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
                        <li><a class="hover-effect" href="../rsc/scripts/logout_script.php"><i class="fa fa-sign-out fa-lg"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark gradient-background pb-0">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img class="" src="../rsc/img/kroa-logo-text.png" alt=""></a>


            <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item ">
                        <a class="nav-link bg-dark py-2 px-3 rounded-top" id="home_nav" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link bg-dark py-2 px-3" id="event_nav" href="event_grid.php">Event</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link bg-dark py-2 px-3" id="people_nav" href="people.php">Volunteers</a>
                    </li>
<?php
$cur_user = $_SESSION['login_type'];
$root = 1; $dag_leder = 2; $vol_cord = 3; $event_man = 4; $manager = 5; $volunteer = 6;
    if ($cur_user <= $dag_leder || $cur_user == $manager) {
        echo '      
                    <li class="nav-item">
                        <a class="nav-link bg-dark py-2 px-3" id="man_nav" href="manager.php">Manage</a>
                    </li>
                    ';
    }
$id = $_SESSION['login_id'];
$tempQuery =  "SELECT * FROM manager WHERE " . $id . " = vol_ID AND crew_type_ID = 1;";
$tempRes = mysqli_query($con,$tempQuery);
$tempRow = mysqli_fetch_array($tempRes);
$bar_manager = $tempRow{'crew_type_ID'};

    if ($cur_user <= $dag_leder || $bar_manager == 1) {
         echo '
                    <li class="nav-item">
                        <a class="nav-link bg-dark py-2 px-3 rounded-bottom" id="unit_nav" href="unitlist.php">Unitlist</a>
                    </li>
                    ';
    }
?>
                </ul>
            </div>

        </div>
    </nav>
</div>