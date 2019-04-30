<?php
include 'rsc/imports/php/functions/functions.php';

//if we got something through $_POST

if (isset($_POST['logSearch'])) {
    // here you would normally include some database connection
    include('dbcon.php');
// never trust what user wrote! We must ALWAYS sanitize user input
$searchword = mysqli_real_escape_string($con,$_POST['logSearch']);
$searchword = htmlentities($searchword);

// build your search query to the database
$sql = "SELECT * FROM event WHERE Name LIKE '%" . $searchword . "%' ORDER BY Date DESC";
// get results
$row = select_list($sql);
if(count($row)) {

    $crew_fetch = "SELECT * FROM crew_type";
    $crew_res = mysqli_query($con, $crew_fetch);
    $crew_event_row = mysqli_fetch_array($crew_res);
    $crew_row = select_list($crew_fetch);



    $output = '<div id="accordionEvent">
';

    foreach($row as $r) {


        $event_id           = $r['ID'];
        $event_name         = $r['Name'];
        $event_date         = $r['Date'];
        $crew_event_id      = $crew_event_row['ID'];


        $vol_fetch = 'SELECT * FROM event_volunteer WHERE event_ID = '.$event_id.' AND crew_type_ID = '.$crew_event_id.';';
        $vol_res = mysqli_query($con, $vol_fetch);
        $vol_row = mysqli_fetch_array($vol_res);



        $output     .= '
           <div class=" bg-light border-dark">

           <div class="card">
                <div class="card-header text-center d-flex justify-content-between">
                <div class="d-flex justify-content-left">
                    <h3>
                         ' . $event_name . '
                    </h3>
                </div>
                <div class="d-flex justify-content-left">

                    <h4>
                         ' .DATE("j F Y" ,strtotime($event_date)) . '
                    </h4>
                    <div class="ml-3">
                         <a class="btn btn-primary btn-small border-dark" type="button" data-toggle="collapse" href="#collapseEvent'.$event_id.'" aria-expanded="true"><i class="fa fa-angle-down"></i></a>
                    </div>
                    </div>
                </div>
                </div>                 
                
                                                                  
';


        $output .= '<div id="collapseEvent'.$event_id.'" class="collapse" data-parent="#accordionEvent" style="">
                    <div id="accordionCrew">';

        foreach ($crew_row as $cr){

        $crew_id        = $cr['ID'];
        $crew_name      = $cr{'type'};


            $log_fetch = 'SELECT logs FROM logs WHERE crew_type_ID = '.$crew_id.' AND event_ID = '.$event_id.';';
            $log_res = mysqli_query($con, $log_fetch);
            $log_row = mysqli_fetch_array($log_res);
            $log_event = $log_row['logs'];


        $output.='

                         <a class=" d-flex justify-content-left list-group-item list-group-item-action flex-column align-items-start" data-toggle="collapse" href="#collapseCrew'.$crew_id.$event_id.'" aria-expanded="true">
                           <div class="d-flex w-100 justify-content-center">
                           <h3>'.$crew_name.'</h3>                                              
                           </div>
                            
                         </a>

                <div id="collapseCrew'.$crew_id.$event_id.'" class="collapse" data-parent="#accordionCrew" style="">
                
                    <div>
                    <p> testies testies '. $log_event.'</p>
                    </div>
                    <div class="table-responsive">
                         <br><table class="table">
                        <thead>
                            <tr>
                            <td><b>First name</b></td>
                            <td><b>Last name</b></td>
                            <td><b>Manager</b></td>
                            </tr>
                        </thead></table>
                    </div>           
                             </div>           


                        
                        ';
        }
        $output .= '</div></div></div>';

    }
    $output .= '</div>';

    echo $output;
} else {
    echo '<h2 class="text-danger m-3">No events found</h2>';
}
}
