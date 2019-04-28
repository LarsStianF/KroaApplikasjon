

<!-- Navigation -->
<div class="">
    <header class="topnav bg-dark">
        <div class="container">
            <div class="row">
                <!-- social icon-->
                <div class="col-sm-12">
                    <ul class="topbuttons">
                        <li><a class="hover-effect" href="index.php"><i class="fa fa-home"></i></a></li>
                        <li><a class="hover-effect" href="#"><i class="fa fa-sign-out"></i></a></li>
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
                        <a class="nav-link bg-dark py-2 px-3" id="man_nav" href="mindex.php">Manage</a>
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




<!--
<nav class="fixed-top">


      ##################################################################################
   ######################## ! OLD FANCY NAV - INCOMPLETE ! ########################
   ##################################################################################
   <script src="https://code.jquery.com/jquery-1.12.0.js"></script>
   <script src="..\rsc\imports\js\navjs.js"></script>

   <div id="customnav" class="navbar navbar-expand-sm">
       <img id="navimg" src="../rsc/img/navhome1.png">

       <a class="navbar-brand"><img src="../rsc/img/Kroalogo.png" alt="logo" style="width:40px;"></a>
       <ul class="navbar-nav">
           <li class="nav-item">
               <a class="nav-link mainnav" id="homenav" href="#">Home</a>
           <li class="nav-item ">
               <a class="nav-link mainnav" id="eventnav" href="#">Events</a>
           </li>
           <li class="nav-item ">
               <a class="nav-link mainnav" id="peoplenav" href="#">People</a>
           </li>
       </ul>
   </div>

   <div id="secondnav" class="navbar navbar-expand-sm" >

       <div class="subhide" id="homenavsub">
           <a class="nav-link" href="#">Home</a>
           <a class="nav-link" href="#">Home</a>
           <a class="nav-link" href="#">Home</a>
           <a class="nav-link" href="#">Home</a>

       </div>

       <div class="subhide" id="eventnavsub">
           <a class="nav-link" href="#">Event</a>
           <a class="nav-link" href="#">Event</a>
           <a class="nav-link" href="#">Event</a>
           <a class="nav-link" href="#">Event</a>
       </div>

       <div class="subhide" id="peoplenavsub">
           <a class="nav-link" href="#">People</a>
           <a class="nav-link" href="#">People</a>
           <a class="nav-link" href="#">People</a>
           <a class="nav-link" href="#">People</a>
       </div>
   </div>

</nav>
-->