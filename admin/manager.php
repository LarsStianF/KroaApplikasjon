<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../index.php")
    ;exit();

}elseif ($_SESSION['login_type'] > 5 ) {
    header("Location:index.php");;
    exit();
}
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'rsc/imports/php/functions/functions.php';
?>
    <script src="../rsc/imports/js/managerjs.js"></script>

    <script type="text/javascript">

        $(function() {

            $(".search_button").click(function() {
                // getting the value that user typed
                var searchString    = $("#logSearch").val();
                // forming the queryString
                var data            = 'logSearch='+ searchString;

                // if searchString is not empty
                if(searchString) {
                    // ajax call
                    $.ajax({
                        type: "POST",
                        url: "fetch_log_search_data.php",
                        data: data,
                        beforeSend: function(html) { // this happens before actual call
                            $("#results").html('');
                            $("#searchresults").show();
                            $(".word").html(searchString);
                        },
                        success: function(html){ // this happens after we get results
                            $("#results").show();
                            $("#results").append(html);
                        }
                    });
                }
                return false;
            });
        });
    </script>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->



    <main role="main" class="container">

        <div class="bg-light p-3 m-0 card" >
            <h1 class="display-3 text-center"> Manage </h1>


            <div class="btn-group-toggle form-inline" data-toggle="buttons">
                <?php
                if ($_SESSION['login_type'] >= 5 || $_SESSION['login_type'] == 1) {
                    echo'
                <label class="btn btn-dark btn-lg filter-button m-1" data-filter="Manager">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> Manager
            </label>
                ';
                }
                ?>

                <label class="btn btn-dark btn-lg filter-button m-1" data-filter="Bar-log">
                    <input type="radio" name="options" id="option3" autocomplete="off"> Bar log
                </label>
                <label class="btn btn-dark btn-lg filter-button m-1" data-filter="Security-log">
                    <input type="radio" name="options" id="option4" autocomplete="off"> Security log
                </label>
                <label class="btn btn-dark btn-lg filter-button m-1" data-filter="Crew-log">
                    <input type="radio" name="options" id="option5" autocomplete="off"> Crew log
                </label>
                <label class="btn btn-dark btn-lg filter-button m-1" data-filter="Tech-log">
                    <input type="radio" name="options" id="option6" autocomplete="off"> Tech log
                </label>
            </div>

                <form method="post" action="fetch_log_search_data.php" class="form-inline m-1">
                    <div class="input-group input-group-lg w-100">
                    <input type="text" id="logSearch" name="logSearch" class="form-control" placeholder="Search for logs(read only)">
                <div class="input-group-append">
                    <input type="submit" value="Search" class="search_button btn btn-dark" />

                </div>
                    </div>
                </form>


        </div>

        <div class="row">
            <div class="col themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Log archive</h6>

                    <div id="searchresults" >
                        <div id="results" class="update">

                        </div>
                    </div>
                </div>
            </div>
        </div>


         <?php
            if ($_SESSION['login_type'] >= 5 || $_SESSION['login_type'] == 1) {
             echo '
                
            
            
        <!--
        ############################                ############################
        ############################ Manager Button ############################
        ############################                ############################
        -->

        <div class="row filter Manager">
            <div class="col-md-6 themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Upcoming events</h6>
                    ';

            /* Attempt MySQL server connection. Assuming you are running MySQL
            server with default setting (user 'root' with no password) */
            $link = mysqli_connect("localhost", "root", "", "group11");

            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Attempt select query execution
            $sql = "SELECT * FROM event LIMIT 4";
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
                        echo    '<strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>';
                        echo    '<strong class="d-block text-gray dark"> Managers: 1/1 Bar, 0/0 Teknisk, 1/1 Crew, 1/1 Security</strong>';
                        echo    '<span class="text-gray dark h6">Additional Notes: </span>' , $row['Event_text'];
                        echo    '<button type="button" class="btn btn-primary btn-sm btn-outline-success" style="float: right;">Sign up</button>';
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
                </div></div>
                    <div class="col-md-6 themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                            <h6 class="border-bottom border-gray pb-2 mb-0">You`re managing these events</h6>

                            <?php
                            /* Attempt MySQL server connection. Assuming you are running MySQL
                            server with default setting (user 'root' with no password) */
                            $link = mysqli_connect("localhost", "root", "", "group11");

                            // Check connection
                            if($link === false){
                                die("ERROR: Could not connect. " . mysqli_connect_error());
                            }

                            // Attempt select query execution
                            $sql = "SELECT * FROM event WHERE ID > 4 LIMIT 4";
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
                                        echo    '<strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>';
                                        echo    '<strong class="d-block text-gray dark"> Managers: 1/1 Bar, 0/0 Teknisk, 1/1 Crew, 1/1 Security</strong>';
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
                        </div></div>
        </div>
        <?php
            }
        ?>

        <!--
        ############################                ############################
        ############################    Bar Button  ############################
        ############################                ############################
        -->
        <div class="row filter Bar-log">
            <div class="col">

            <?php
            /* Attempt MySQL server connection. Assuming you are running MySQL
            server with default setting (user 'root' with no password) */
            $link = mysqli_connect("localhost", "root", "", "group11");

            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Attempt select query execution
            $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 1";
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


                        echo '<div class="col-md-12 themed-grid-col each-item my-3 p-3 bg-white rounded shadow-sm">';
                        echo    '<div class="col-md-8">';
                        echo        '<div class="d-flex w-100 justify-content-between">';
                        echo            '<strong class="d-block text-gray-dark h4">';
                        echo            $row['Name'];
                        echo            '</strong>';
                        echo            '<button class="btn btn-success" type="submit">Edit</button>';
                        echo        '</div>';
                        echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                        echo            $date;
                        echo            '<br>';
                        echo            ' Time: ';
                        echo            $startTime;
                        echo            ' - ';
                        echo            $endTime;
                        echo        '</strong>';
                        echo        '<div class="media text-muted pt-3">';
                        echo            '<form class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                        echo            '<span class="text-gray dark h6">Bar logs: </span>';
                        echo            $row['logs'];
                        echo            '</form>';
                        echo        '</div>';
                        echo    '</div>';
                        echo    '<div class="col-md-4 justify-content-between">';
                        echo        '<strong class="d-block text-gray-dark h4 border-bottom">Frivillige</strong>';
                        echo        '<button class="btn btn-success" type="submit">Add</button>';
                        echo    '</div>';
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
            </div>
        </div>
        <!--
        ############################                ############################
        ############################ Security Button ############################
        ############################                ############################
        -->
        <div class="row filter Security-log">
            <div class="col">

            <?php
            /* Attempt MySQL server connection. Assuming you are running MySQL
            server with default setting (user 'root' with no password) */
            $link = mysqli_connect("localhost", "root", "", "group11");

            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Attempt select query execution
            $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 2";
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


                        echo '<div class="col-md-12 themed-grid-col each-item my-3 p-3 bg-white rounded shadow-sm">';
                        echo    '<div class="col-md-8">';
                        echo        '<div class="d-flex w-100 justify-content-between">';
                        echo            '<strong class="d-block text-gray-dark h4">';
                        echo            $row['Name'];
                        echo            '</strong>';
                        echo            '<button class="btn btn-success" type="submit">Edit</button>';
                        echo        '</div>';
                        echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                        echo            $date;
                        echo            '<br>';
                        echo            ' Time: ';
                        echo            $startTime;
                        echo            ' - ';
                        echo            $endTime;
                        echo        '</strong>';
                        echo        '<div class="media text-muted pt-3">';
                        echo            '<form class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                        echo            '<span class="text-gray dark h6">Security logs: </span>';
                        echo            $row['logs'];
                        echo            '</form>';
                        echo        '</div>';
                        echo    '</div>';
                        echo    '<div class="col-md-4 justify-content-between">';
                        echo        '<strong class="d-block text-gray-dark h4 border-bottom">Frivillige</strong>';
                        echo        '<button class="btn btn-success" type="submit">Add</button>';
                        echo    '</div>';
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
        </div>
        </div>
        <!--
        ############################                ############################
        ############################ Crew Button    ############################
        ############################                ############################
        -->
        <div class="row filter Crew-log">
            <div class="col">
            <?php
            /* Attempt MySQL server connection. Assuming you are running MySQL
            server with default setting (user 'root' with no password) */
            $link = mysqli_connect("localhost", "root", "", "group11");

            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Attempt select query execution
            $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 3";
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


                        echo '<div class="col-md-12 themed-grid-col each-item my-3 p-3 bg-white rounded shadow-sm">';
                        echo    '<div class="col-md-8">';
                        echo        '<div class="d-flex w-100 justify-content-between">';
                        echo            '<strong class="d-block text-gray-dark h4">';
                        echo            $row['Name'];
                        echo            '</strong>';
                        echo            '<button class="btn btn-success" type="submit">Edit</button>';
                        echo        '</div>';
                        echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                        echo            $date;
                        echo            '<br>';
                        echo            ' Time: ';
                        echo            $startTime;
                        echo            ' - ';
                        echo            $endTime;
                        echo        '</strong>';
                        echo        '<div class="media text-muted pt-3">';
                        echo            '<form class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                        echo            '<span class="text-gray dark h6">Crew logs: </span>';
                        echo            $row['logs'];
                        echo            '</form>';
                        echo        '</div>';
                        echo    '</div>';
                        echo    '<div class="col-md-4 justify-content-between">';
                        echo        '<strong class="d-block text-gray-dark h4 border-bottom">Frivillige</strong>';
                        echo        '<button class="btn btn-success" type="submit">Add</button>';
                        echo    '</div>';
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
        </div>
        </div>
        <!--
        ############################                ############################
        ############################ Tech Button    ############################
        ############################                ############################
        -->
        <div class="row filter Tech-log">
            <div class="col">
            <?php
            /* Attempt MySQL server connection. Assuming you are running MySQL
            server with default setting (user 'root' with no password) */
            $link = mysqli_connect("localhost", "root", "", "group11");

            // Check connection
            if($link === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }

            // Attempt select query execution
            $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 4";
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


                        echo '<div class="col-md-12 themed-grid-col each-item my-3 p-3 bg-white rounded shadow-sm">';
                        echo    '<div class="col-md-8">';
                        echo        '<div class="d-flex w-100 justify-content-between">';
                        echo            '<strong class="d-block text-gray-dark h4">';
                        echo            $row['Name'];
                        echo            '</strong>';
                        echo            '<button class="btn btn-success" type="submit">Edit</button>';
                        echo        '</div>';
                        echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                        echo            $date;
                        echo            '<br>';
                        echo            ' Time: ';
                        echo            $startTime;
                        echo            ' - ';
                        echo            $endTime;
                        echo        '</strong>';
                        echo        '<div class="media text-muted pt-3">';
                        echo            '<form class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                        echo            '<span class="text-gray dark h6">Tech logs: </span>';
                        echo            $row['logs'];
                        echo            '</form>';
                        echo        '</div>';
                        echo    '</div>';
                        echo    '<div class="col-md-4 justify-content-between">';
                        echo        '<strong class="d-block text-gray-dark h4 border-bottom">Frivillige</strong>';
                        echo        '<button class="btn btn-success" type="submit">+</button>';
                        echo    '</div>';
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

        </div>
        </div>


    </main>






    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
    ##################################################################################
    -->

<?php include '../rsc/imports/php/components/footer.php'; ?>