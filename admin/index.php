<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'rsc/imports/modals/event_modal.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->




<main role="main" class="container">
    <div>
        <div class="bg-light p-3 m-0 card" >
            <h1 class="display-3 text-center"> Your Page </h1>
        </div>

        <div class="row mb-3">
            <div class="col-md-8 themed-grid-col">
                <div>
                    <div class="d-flex align-items-center p-3 text-white-50 bg-warning rounded shadow-sm ">
                        <img class="mr-3" src="../rsc/img/userpic.jpg" alt="" width="48" height="48">
                        <div class="lh-100">
                            <h6 class="mb-0 text-white lh-100">Welcome, <?php echo $_SESSION['login_name'] ?></h6>
                            <small>Last volunteered: </small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 themed-grid-col">
                        <div class="my-3 p-3 bg-white rounded shadow-sm">
                        <h6 class="border-bottom border-gray pb-2 mb-0">Your confirmed upcoming events</h6>

<?php
                        // get user id
                        $user_id = $_SESSION['login_id'];

                        $sql = "SELECT ID, Name, Event_text, Date, Time_Start, Time_End, Event_sec, Event_bar, Event_crew, Event_tech, event_volunteer.vol_ID, event_volunteer.crew_type_ID
                                FROM event
                                INNER JOIN event_volunteer
                                ON event.ID = event_volunteer.event_ID 
                                AND event_volunteer.vol_ID = $user_id";
                     //   echo $sql;
                        $output_confirmed = "";
                        $output_signed = "";

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

                                    // get event volunteers
                                    $volunteers = get_event_volunteers($id);
                                    $bar = $volunteers[0];
                                    $security = $volunteers[1];
                                    $crew = $volunteers[2];
                                    $technical = $volunteers[3];

                                    $output_confirmed .= '
                                    <a href="#eventModal" class="view_data click-card" id="' . $id . '" data-toggle="modal" >
                                    <div class="click-box  pt-3">
                                        '.get_confirmed_role($user_id, $id).'
                                        <p class="pb-3 mb-0 small lh-125 border-bottom border-gray">
                                            <strong class="d-block h4">'.$row['Name'].'</strong>
                                            <strong class="d-block">
                                                Date: '.$date.'
                                                <br>
                                                Time: '.$startTime.' - '.$endTime.'
                                            </strong>
                                            <strong class="d-block">
                                             
                                            </strong>
                                            <strong class="d-block">
                                            '.$volunteers[1].'/'.$row['Event_sec'].' Security, '.$volunteers[0].'/'.$row['Event_bar'].' Bar, '.$volunteers[2].'/'.$row['Event_crew'].' Crew, '.$volunteers[3].'/'.$row['Event_tech'].' Teknisk 
                                            </strong>
                                            '.$row['Event_text'].'
                                        </p>
                                        
                                  </div>
                                  </a>';
                                }
                                echo $output_confirmed;
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "No records matching your query were found.";
                            }
                        } else{
                            echo "ERROR: Could not able to execute";
                        }



                        ?>
                        <small class="d-block text-right mt-3">
                            <a href="event_grid.php" class="d-block text-gray dark">Sign up for more events!</a>
                        </small>
                    </div>
                </div>
                <div class="col-md-6 themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Your signed upcoming events</h6>

                    <?php

                    // Attempt select query execution
                    $sql = "SELECT DISTINCT ID, Name, Event_text, Date, Time_Start, Time_End, Event_sec, Event_bar, Event_crew, Event_tech
                            FROM event, want_volunteer
                            WHERE event.ID = want_volunteer.event_ID 
                            AND want_volunteer.vol_ID = $user_id";

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

                                $volunteers = get_event_volunteers($id);
                                $bar        = $volunteers[0];
                                $security   = $volunteers[1];
                                $crew       = $volunteers[2];
                                $technical  = $volunteers[3];

                                $output_signed .=  '
                                <a href="#eventModal" class="view_data click-card" id="' . $id . '" data-toggle="modal" >
                                <div class="click-box pt-3">
                                    <div>
                                        '.get_signed_roles($user_id, $id).'
                                    </div>
                                    
                                    <p class=" pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <strong class="d-block h4">
                                        '.$row['Name'].'
                                        </strong>
                                        <strong class="d-block">
                                        Date: '.$date.'
                                        <br>
                                        Time: '.$startTime.' - '.$endTime.'
                                        </strong>
                                        <strong class="d-block">
                                        You are signed as: Security
                                        </strong>
                                        <strong class="d-block">
                                        '.$bar.'/'.$row['Event_bar'].' Bar, '.$security.'/'.$row['Event_sec'].' Security, '.$crew.'/'.$row['Event_crew'].' Crew, '.$technical.'/'.$row['Event_tech'].' Teknisk
                                        </strong>
                                        '.$row['Event_text'].'
                                    </p>
                                </div>
                                </a>';
                            }
                            echo $output_signed;

                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "No records matching your query were found.";

                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
                    }


                        ?>
                                <small class="d-block text-right mt-3">
                                    <a href="event_grid.php" class="d-block text-gray dark">Sign up for more events!</a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 themed-grid-col">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-enhet text-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">
                                        Spare units
                                    </div>
                                    <div class="stat-digit">
                                        <?php echo $_SESSION['login_unit'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-total text-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Times worked</div>
                                    <div class="stat-digit">
                                        <?php echo "haha" ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib"><i class="ti-month text-success border-success"></i></div>
                                <div class="stat-content dib">
                                    <div class="stat-text">
                                        Times worked this month
                                    </div>
                                    <div class="stat-digit">
                                        <?php echo "haha" ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-jippi text-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">
                                        You have JIPPI until
                                    </div>
                                    <div class="stat-digit">
                                        <?php echo "haha" ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../rsc/imports/js/event_modal_script.js">
    </script>

    </body>




<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php
include 'rsc/imports/modals/created_modal.php';
include 'rsc/imports/modals/deleted_modal.php';
include '../rsc/imports/php/components/footer.php';
?>