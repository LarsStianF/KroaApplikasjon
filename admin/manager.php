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
include 'rsc/imports/modals/new_log_modal.php';

?>
    <script src="../rsc/imports/js/managerjs.js"></script>

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
                    <input type="submit" value="Search" class="filter-button search_button btn btn-dark filter-button" data-filter="Search-log" />

                </div>
                    </div>
                </form>


        </div>

        <div class="row filter Search-log">
            <div class="col themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Log archive</h6>

                    <div id="searchresults" >
                        <div id="results">

                        </div>
                    </div>
                </div>
            </div>
        </div>


         <?php
            if ($_SESSION['login_type'] >= 5 || $_SESSION['login_type'] == 1) {


                // get user id
                $user_id = $_SESSION['login_id'];

                $sql = "SELECT ID, Name, Event_text, Date, Time_Start, Time_End, Event_sec, Event_bar, Event_crew, Event_tech, event_volunteer.vol_ID, event_volunteer.crew_type_ID, event_volunteer.manager
                                FROM event
                                INNER JOIN event_volunteer
                                ON event.ID = event_volunteer.event_ID 
                                AND event_volunteer.vol_ID = $user_id 
                                AND event_volunteer.manager = 1
                                AND Date >= CURDATE();";

                $output = '<section class="container filter Manager my-3 bg-white rounded shadow-sm">
                                    <h6 class="border-bottom border-gray pb-2 pt-2 mb-0">Your managing these events</h6>
                                            <div class="row pt-3 px-3 pb-0">';


                if ($result = mysqli_query($con, $sql)) {

                    if (mysqli_num_rows($result) > 0) {
                        $rows = mysqli_num_rows($result);
                        $counter = 1;

                        while ($row = mysqli_fetch_array($result)) {
                            // Gets date
                            $id = $row['ID'];
                            $crew_id = $row['crew_type_ID'];
                            $d = new DateTime($row['Date']);
                            $date = $d->format('F jS o');

                            // Gets time
                            $sTime = new DateTime($row['Time_Start']);
                            $eTime = new DateTime($row['Time_End']);
                            $startTime = $sTime->format('H:i');
                            $endTime = $eTime->format('H:i');

                            // get event volunteers
                            $volunteers = get_event_volunteers($id);
                            $bar = $volunteers[0];
                            $security = $volunteers[1];
                            $crew = $volunteers[2];
                            $technical = $volunteers[3];

                            $output .= '
                                    
                                    
                                        <div class="col d-flex flex-column">
                                            
                                            <div class="d-inline-flex">  
                                                ' . get_confirmed_role($user_id, $id) . ' 
                                                <strong class="d-block h2">
                                                    ' . $row['Name'] . '
                                                </strong>
                                            </div>
                                            <div class="mt-2 ml-4 pl-1">
                                                <strong class="d-block">
                                                    Date: ' . $date . '
                                                </strong>
                                                <strong>
                                                    Time: ' . $startTime . ' - ' . $endTime . '
                                                </strong>
                                            </div>
                                            <div>
                                                <strong class="d-block mt-2 ml-4 pl-1">
                                                    ' . $bar . '/' . $row['Event_bar'] . ' Bar, ' . $security . '/' . $row['Event_sec'] . ' Security, ' . $crew . '/' . $row['Event_crew'] . ' Crew, ' . $technical . '/' . $row['Event_tech'] . ' Teknisk
                                                </strong>
                                            </div>
                                            <div class="justified mt-3 ml-4 pl-1">
                                                <strong>
                                                    ' . $row['Event_text'] . ' 
                                                </strong>
                                            
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="col">
                                            ' . populate_want_volunteers($id, $crew_id) . '
                                        </div>
                                        
                                   </div>
                                    <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary btn-small border-dark mb-2" type="button" data-toggle="collapse"  href="#collapse' . $id . '"><i class="fa fa-angle-down"></i></a>
                                    </div>
                                    
                                    
                                    
                                    
                                   
                                   <div id="collapse' . $id . '" class="collapse" data-parent="#accordion-manage">
                                        ' . populate_volunteers($id, $crew_id) . '
                                    </div>
                                </div>
                                   ';

                            if ($counter < $rows) {

                                $output .= '<hr>
                                                <div class="row pt-3 px-3 pb-0">';
                            } else {

                            }
                            $counter++;

                        }

                        // Free result set
                        mysqli_free_result($result);
                    }
                }
                $output .= "</section>";
                echo $output;
            }


         ?>



        <!--
 ############################                ############################
 ############################    Bar Button  ############################
 ############################                ############################
 -->
        <div class="row filter Bar-log">
            <div class="col">
                <a href="#newLogModal" class="btn btn-primary btn-lg mt-2 newlog" data-toggle="modal">Create new Bar log</a>

                <?php


                // Attempt select query execution
                $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 1";
                if($result = mysqli_query($con, $sql)){
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
                            echo        '</div>';
                            echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                            echo            $date;
                            echo            '<br>';
                            echo            ' Time: ';
                            echo            $startTime;
                            echo            ' - ';
                            echo            $endTime;
                            echo        '</strong>';
                            echo        '<div class="media pt-3">';
                            echo            '<div class="m-2">';

                            echo            '<h5>'.$row['logs'].'</h5>';
                            echo            '</div>';
                            echo        '</div>';
                            echo    '</div>';
                            echo    '<div class="col-md-12 ">';
                            echo        '<strong class="d-block text-gray-dark h4 mb-0 mt-3">Frivillige</strong>';
                            echo        populate_volunteers($id, $row['crew_type_ID']);
                            echo    '</div>';
                            echo '</div>';
                        }
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "No records matching your query were found.";
                    }
                }


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
                <button class="btn btn-primary btn-lg mt-2">Create new Security log</button>


                <?php


                // Attempt select query execution
                $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 2";
                if($result = mysqli_query($con, $sql)){
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
                            echo        '</div>';
                            echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                            echo            $date;
                            echo            '<br>';
                            echo            ' Time: ';
                            echo            $startTime;
                            echo            ' - ';
                            echo            $endTime;
                            echo        '</strong>';
                            echo        '<div class="media pt-3">';
                            echo            '<div class="m-2">';

                            echo            '<h5>'.$row['logs'].'</h5>';
                            echo            '</div>';
                            echo        '</div>';
                            echo    '</div>';
                            echo    '<div class="col-md-12 ">';
                            echo        '<strong class="d-block text-gray-dark h4 mb-0 mt-3">Frivillige</strong>';
                            echo        populate_volunteers($id, $row['crew_type_ID']);
                            echo    '</div>';
                            echo '</div>';
                        }
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "No logs were found.";
                    }
                }


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
                <button class="btn btn-primary btn-lg mt-2">Create new Crew log</button>

                <?php


                // Attempt select query execution
                $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 3";
                if($result = mysqli_query($con, $sql)){
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
                            echo        '</div>';
                            echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                            echo            $date;
                            echo            '<br>';
                            echo            ' Time: ';
                            echo            $startTime;
                            echo            ' - ';
                            echo            $endTime;
                            echo        '</strong>';
                            echo        '<div class="media pt-3">';
                            echo            '<div class="m-2">';
                            echo            '<h5>'.$row['logs'].'</h5>';
                            echo            '</div>';
                            echo        '</div>';
                            echo    '</div>';
                            echo    '<div class="col-md-12 ">';
                            echo        '<strong class="d-block text-gray-dark h4 mb-0 mt-3">Frivillige</strong>';
                            echo        populate_volunteers($id, $row['crew_type_ID']);
                            echo    '</div>';
                            echo '</div>';
                        }
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "No logs were found.";
                    }
                }


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
                <button class="btn btn-primary btn-lg mt-2">Create new Technical log</button>

                <?php


                // Attempt select query execution
                $sql = "SELECT * FROM logs, event WHERE logs.event_ID = event.ID AND crew_type_ID = 4";
                if($result = mysqli_query($con, $sql)){
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
                            echo        '</div>';
                            echo        '<strong class="d-block text-gray dark border-bottom">Date: ';
                            echo            $date;
                            echo            '<br>';
                            echo            ' Time: ';
                            echo            $startTime;
                            echo            ' - ';
                            echo            $endTime;
                            echo        '</strong>';
                            echo        '<div class="media pt-3">';
                            echo            '<div class="m-2">';

                            echo            '<h5>'.$row['logs'].'</h5>';
                            echo            '</div>';
                            echo        '</div>';
                            echo    '</div>';
                            echo    '<div class="col-md-12 ">';
                            echo        '<strong class="d-block text-gray-dark h4 mb-0 mt-3">Frivillige</strong>';
                            echo        populate_volunteers($id, $row['crew_type_ID']);
                            echo    '</div>';
                            echo '</div>';
                        }
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "No logs were found.";
                    }
                }


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