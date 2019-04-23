<?php
include 'dbcon.php';
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->





    <main role="main" class="container">


    <div class=" ">
        <div class="bg-light p-3 m-0 card" >
            <h1 class="display-3 text-center"> Your Page </h1>

        </div>
        <div class="row mb-3 ">

            <div class="col-md-8 themed-grid-col">
                <div class="">
                    <div class="d-flex align-items-center p-3 text-white-50 bg-warning rounded shadow-sm ">
                        <img class="mr-3" src="../rsc/img/userpic.jpg" alt="" width="48" height="48">
                        <div class="lh-100">
                            <h6 class="mb-0 text-white lh-100">Welcome, <?php echo $_SESSION['login_name'] ?></h6>
                            <small>Last volunteered: </small>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-6 themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Your confirmed upcoming events</h6>

                        <?php
                        $link = mysqli_connect("localhost", "root", "", "group11");

                        if($link === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM event LIMIT 3";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    // Gets date
                                    $id = $row['ID'];
                                    $d = new DateTime($row['Date']);
                                    $date = $d->format('F jS o');

                                    // Gets time
                                    $sTime = new DateTime($row['Time_Start']);
                                    $eTime = new DateTime($row['Time_End']);
                                    $startTime = $sTime->format('H:i');
                                    $endTime = $eTime->format('H:i');

                                    echo '<div class="media text-muted pt-3">';
                                    echo    '<svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#007bff" width="100%" height="100%"/><text fill="#007bff" dy=".3em" x="50%" y="50%">32x32</text></svg>';
                                    echo    '<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                                    echo    '<strong class="d-block text-gray-dark h4">';
                                    echo    $row['Name'];
                                    echo    '</strong>';
                                    echo    ' <strong class="d-block text-gray dark">Date: ';
                                    echo    $date;
                                    echo    '<br>';
                                    echo    ' Time: ';
                                    echo    $startTime;
                                    echo    ' - ';
                                    echo    $endTime;
                                    echo    '</strong>';
                                    echo    '<strong class="d-block text-gray dark">Meetup: kl 18.00</strong>';
                                    echo    '<strong class="d-block text-gray dark">You are working as: Bar</strong>';
                                    echo    '<strong class="d-block text-gray dark">Volunteers: 10/14 Security, 6/6 Bar, 4/4 Crew, 4/5 Teknisk </strong>';
                                    echo    '<span class="text-gray dark h6">Additional Notes: </span>' . $row['Event_text'];
                                    echo    '</p>';
                                    echo '</div>';
                                }
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "No records matching your query were found.";
                            }
                        } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                        <small class="d-block text-right mt-3">
                        <a href="events.php" class="d-block text-gray dark">Sign up for more events!</a>
                        </small>
                    </div></div>
                <div class="col-md-6 themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Your signed upcoming events</h6>

                        <?php
                        /* Attempt MySQL server connection. Assuming you are running MySQL
                        server with default setting (user 'root' with no password) */
                        $link = mysqli_connect("localhost", "root", "", "group11");

                        // Check connection
                        if($link === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }

                        // Attempt select query execution
                        $sql = "SELECT * FROM event WHERE ID > 3 LIMIT 3";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    // Gets date
                                    $id = $row['ID'];
                                    $d = new DateTime($row['Date']);
                                    $date = $d->format('F jS o');

                                    // Gets time
                                    $sTime = new DateTime($row['Time_Start']);
                                    $eTime = new DateTime($row['Time_End']);
                                    $startTime = $sTime->format('H:i');
                                    $endTime = $eTime->format('H:i');

                                    echo '<div class="media text-muted pt-3">';
                                    echo    '<svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#007bff" width="100%" height="100%"/><text fill="#007bff" dy=".3em" x="50%" y="50%">32x32</text></svg>';
                                    echo    '<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                                    echo    '<strong class="d-block text-gray-dark h4">';
                                    echo    $row['Name'];
                                    echo    '</strong>';
                                    echo    ' <strong class="d-block text-gray dark">Date: ';
                                    echo    $date;
                                    echo    '<br>';
                                    echo    ' Time: ';
                                    echo    $startTime;
                                    echo    ' - ';
                                    echo    $endTime;
                                    echo    '</strong>';
                                    echo    '<strong class="d-block text-gray dark">Meetup: kl 18.00</strong>';
                                    echo    '<strong class="d-block text-gray dark">You are signed as: Security</strong>';
                                    echo    '<strong class="d-block text-gray dark">Volunteers: 10/14 Security, 6/6 Bar, 4/4 Crew, 4/5 Teknisk</strong>';
                                    echo    '<span class="text-gray dark h6">Additional Notes: </span>' , $row['Event_text'];
                                    echo    '</p>';
                                    echo '</div>';
                                }
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "No records matching your query were found.";
                            }
                        } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                        <small class="d-block text-right mt-3">
                        <a href="events.php" class="d-block text-gray dark">Sign up for more events!</a>
                        </small>
                    </div></div>
                </div>
            </div>


                                    <?php
                                    /* Attempt MySQL server connection. Assuming you are running MySQL
                                    server with default setting (user 'root' with no password) */
                                    $link = mysqli_connect("localhost", "root", "", "group11");

                                    // Check connection
                                    if($link === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }

                                    // Attempt select query execution
                                    $sql = "SELECT * FROM volunteer WHERE ID = 1";
                                    if($result = mysqli_query($link, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){

                                                echo '<div class="col-md-4 themed-grid-col">';
                                                echo    '<div class="card">';
                                                echo        '<div class="card-body">';
                                                echo            '<div class="stat-widget-one">';
                                                echo                '<div class="stat-icon dib"><i class="ti-enhet text-success border-success"></i></div>';
                                                echo                '<div class="stat-content dib">';
                                                echo                    '<div class="stat-text">Spare units</div>';
                                                echo                        '<div class="stat-digit">';
                                                echo                            $_SESSION['login_unit'];
                                                echo                        '</div>';
                                                echo                    '</div>';
                                                echo                '</div>';
                                                echo            '</div>';
                                                echo        '</div>';
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo "No records matching your query were found.";
                                        }
                                    } else{
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                    }

                                    // Close connection
                                    mysqli_close($link);
                                    ?>
                                    <?php
                                    $link = mysqli_connect("localhost", "root", "", "group11");

                                    if($link === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }

                                    $sql = "SELECT COUNT(*) AS times FROM event_volunteer WHERE " . $_SESSION['login_id'] . " = vol_ID";
                                    if($result = mysqli_query($link, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){

                                                echo    '<div class="card">';
                                                echo        '<div class="card-body">';
                                                echo            '<div class="stat-widget-one">';
                                                echo                '<div class="stat-icon dib"><i class="ti-total text-success border-success"></i></div>';
                                                echo                '<div class="stat-content dib">';
                                                echo                    '<div class="stat-text">Times worked</div>';
                                                echo                    '<div class="stat-digit">';
                                                echo                    $row['times'];
                                                echo                    '</div>';
                                                echo                '</div>';
                                                echo            '</div>';
                                                echo        '</div>';
                                                echo    '</div>';
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo "No records matching your query were found.";
                                        }
                                    } else{
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                    }

                                    // Close connection
                                    mysqli_close($link);
                                    ?>
                                    <?php
                                    $link = mysqli_connect("localhost", "root", "", "group11");

                                    if($link === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }

                                    $sql = "SELECT COUNT(*) AS time FROM event_volunteer AS ev, event WHERE " . $_SESSION['login_id'] . " = vol_ID AND event.ID = ev.event_ID AND MONTH(CURDATE()) = MONTH(Date)";
                                    if($result = mysqli_query($link, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)){

                                                echo    '<div class="card">';
                                                echo        '<div class="card-body">';
                                                echo            '<div class="stat-widget-one">';
                                                echo                '<div class="stat-icon dib"><i class="ti-month text-success border-success"></i></div>';
                                                echo                '<div class="stat-content dib">';
                                                echo                    '<div class="stat-text">Times worked this month</div>';
                                                echo                    '<div class="stat-digit">';
                                                echo                        $row['time'];
                                                echo                    '</div>';
                                                echo                '</div>';
                                                echo            '</div>';
                                                echo        '</div>';
                                                echo    '</div>';
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo "No records matching your query were found.";
                                        }
                                    } else{
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                    }

                                    // Close connection
                                    mysqli_close($link);
                                    ?>
                                    <?php
                                    $link = mysqli_connect("localhost", "root", "", "group11");

                                    if($link === false){
                                        die("ERROR: Could not connect. " . mysqli_connect_error());
                                    }

                                    $sql = "SELECT COUNT(*) AS times FROM event_volunteer WHERE " . $_SESSION['login_id'] . " = vol_ID";
                                    if($result = mysqli_query($link, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                           while($row = mysqli_fetch_array($result)){
                                                echo '<div class="card">';
                                                echo '<div class="card-body">';
                                                echo '<div class="stat-widget-one">';
                                                echo '<div class="stat-icon dib"><i class="ti-jippi text-success border-success"></i></div>';
                                                echo '<div class="stat-content dib">';
                                                echo '<div class="stat-text">You have JIPPI until</div>';
                                                echo '<div class="stat-digit">31 February</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '';
                                                echo '';
                                                echo '';
                                                echo '';
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else{
                                            echo "No records matching your query were found.";
                                        }
                                    } else{
                                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                                    }

                                    // Close connection
                                    mysqli_close($link);
                                    ?>
                </div>
        </div>
    </main>

    <script src="rsc/imports/php/functions/functions.php"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
    <script src="offcanvas.js"></script></body>




<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php
include 'rsc/imports/modals/created_modal.php';
include '../rsc/imports/php/components/footer.php';
?>