<?php
include 'rsc/imports/php/functions/functions.php';

if (isset($_POST['logSearch'])) {
    include('dbcon.php');

$searchword = mysqli_real_escape_string($con,$_POST['logSearch']);

// searches database for a name containing the searchword
$sql = "SELECT * FROM event WHERE Name LIKE '%" . $searchword . "%' AND Date < CURDATE() ORDER BY Date DESC";
// calls function array_list, puts search results in an array
$row = array_list($sql);
if(count($row)) {

    $crew_fetch = "SELECT * FROM crew_type";
    $crew_res = mysqli_query($con, $crew_fetch);
    $crew_event_row = mysqli_fetch_array($crew_res);
    $crew_row = array_list($crew_fetch);



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
           <div class=" bg-secondary rounded">

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
                    <div id="accordionCrew'.$event_id.'">';

        foreach ($crew_row as $cr){

        $crew_id        = $cr['ID'];
        $crew_name      = $cr{'type'};


            $log_fetch = 'SELECT logs FROM logs WHERE crew_type_ID = '.$crew_id.' AND event_ID = '.$event_id.';';
            $log_res = mysqli_query($con, $log_fetch);
            $log_row = mysqli_fetch_array($log_res);
            $log_event = $log_row['logs'];


        $output.='

                         <a class=" d-flex justify-content-left list-group-item list-group-item-action flex-column mb-2 bg-light" data-toggle="collapse" href="#collapseCrew'.$crew_id.$event_id.'" aria-expanded="true">
                         <div class="d-flex w-100 justify-content-center">
                             <h3>'.$crew_name.'</h3>                                              
                         </div>                        
                         </a>
                         <div id="collapseCrew'.$crew_id.$event_id.'" class="collapse pb-1" data-parent="#accordionCrew'.$event_id.'" style="">
                             <div class="card col mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column ">
              <h3 class="mb-0 text-dark">
                ' . $event_name . ' - '.$crew_name.' log
              </h3>
              <div class="mb-1 text-muted">' .DATE("j F Y" ,strtotime($event_date)) . '</div>
              <p class="card-text mb-auto">'. $log_event.'</p>
       
            
                                 
                             <div>
                             <hr>
                                                          <h5 class="text-center">'.$crew_name.' volunteers</h5>

                                                    '.populate_volunteers($event_id, $crew_id).'
        
                         </div>           
                    </div>
                </div>
          </div>

                        
                        ';
        }
        $output .= '</div></div>           </div>                 
';

    }
    $output .= '</div>';

    echo $output;
} else {
    echo '<h2 class="text-danger m-3">No events found</h2>';
}
}
