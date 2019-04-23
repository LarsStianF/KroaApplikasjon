<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';


if(isset($_POST['id']))
{
    $id = $_POST['id'];

    $query = "SELECT * FROM event WHERE ID = '".$id."'";
    $result =  mysqli_query($con, $query);


        $row = mysqli_fetch_array($result);

        //gets time
        $sTime = new DateTime($row['Time_Start']);
        $eTime = new DateTime($row['Time_End']);
        $startTime = $sTime->format('H:i');
        $endTime = $eTime->format('H:i');

        // get fix date
        $d = new DateTime($row['Date']);
        $date = $d->format('F jS o');
        //today
        $date_today = date("Y-m-d");
        $compare_date = $row['Date'];

        $volunteers = get_event_volunteers($id);
        $bar        = $volunteers[0];
        $security   = $volunteers[1];
        $crew       = $volunteers[2];
        $technical  = $volunteers[3];

            $output = '
            <div class="text-center">
                <h1>'.$row['Name'].'</h1> 
                <hr class="mt-1">
                <div class="inline">
                <h2>'.$date.'</h2>
                <h2>'.$startTime.' - '.$endTime.'</h2>
                </div>
                
                <hr>
                <h6>Info</h6>
                <p>'.$row['Event_text'].'</p>
            </div>
         
            
            <div id="accordion">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        
                        <i class="man-icons-modal fa fa-user" style="color:orange;font-size:40px;"></i>
                        <label>Bar</label>
                        <p>'.$bar.'/'.$row['Event_bar'].'</p>
                        <div class="d-flex justify-content-around">
                         ';

                        if ($compare_date > $date_today) {
                            $output .= '<a href="create_handler.php?object=application&job=crew&id=\'.$id.\'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a>';

                        }


          $output .= '<a class="btn btn-primary btn-small border-dark m-2" type="button" data-toggle="collapse" href="#collapseBar"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="collapseBar" class="collapse" data-parent="#accordion">
                            '.populate_volunteers($id, 1).'
                           
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between ">
                        
                        <i class="man-icons-modal fa fa-user" style="color:red;font-size:40px;"></i>
                        <label>Security</label>
                        <p>'.$security.'/'.$row['Event_sec'].'</p>
                        <div class="d-flex justify-content-around">
                        ';

                        if ($compare_date > $date_today) {
                            $output .= '<a href="create_handler.php?object=application&job=sec&id='.$id.'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a>';

                        }


          $output .= '      
                            <a class="btn btn-primary btn-small border-dark m-2" type="button" data-toggle="collapse" href="#collapseSec"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="collapseSec" class="collapse" data-parent="#accordion">
                        '.populate_volunteers($id, 2).'
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        
                        <i class="man-icons-modal fa fa-user" style="color:black;font-size:40px;"></i>
                        <label>Crew</label>
                        <p>'.$crew.'/'.$row['Event_crew'].'</p>
                        <div class="d-flex justify-content-around">
                        ';

                        if ($compare_date > $date_today) {
                            $output .= '<a href="create_handler.php?object=application&job=crew&id='.$id.'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a>';

                        }

            $output .= '<a class="btn btn-primary btn-small border-dark m-2" type="button" data-toggle="collapse" href="#collapseCrew"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="collapseCrew" class="collapse" data-parent="#accordion">
                        '.populate_volunteers($id, 3).'
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        
                        <i class="man-icons-modal fa fa-user" style="color:blue;font-size:40px;"></i>
                        <label>Technical</label>
                        <p>'.$technical.'/'.$row['Event_tech'].'</p>
                        <div class="d-flex justify-content-around">
                         ';

                        if ($compare_date > $date_today) {
                            $output .= '<a href="create_handler.php?object=application&job==tech&id='.$id.'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a>';

                        }


          $output .= '    <a class="btn btn-primary btn-small border-dark m-2" type="button" data-toggle="collapse" href="#collapseTech"><i class="fa fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div id="collapseTech" class="collapse" data-parent="#accordion">
                        '.populate_volunteers($id, 4).'
                    </div>
                </div>
            <div>
            ';

        echo $output;


}

?>