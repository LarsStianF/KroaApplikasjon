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
                
                
                <h2><label class="mr-2">Event type:</label>'.$row['Type'].'</h2>
                <hr>
                <h6>Info</h6>
                <p>'.$row['Event_text'].'</p>
            </div>
            <div class="table-responsive">
        <table class="table table-striped text-center ">
            <tr>
                <td><img class="man-icon" src="../rsc/img/man_black.png" alt=""></td>
                <td><label>Bar</label></td>
                <td><p>'.$bar.'/'.$row['Event_bar'].'</p></td>
                <td><a href="create_handler.php?object=sign&name=submit&job=bar&id='.$id.'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a>
            </tr>
            <tr>
                <td><img class="man-icon" src="../rsc/img/man_red.png" alt=""></td>
                <td><label>Security</label></td>
                <td><p>'.$security.'/'.$row['Event_sec'].'</p></td>
                <td><a href="create_handler.php?object=sign&name=submit&job=sec&id='.$id.'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a></td>
            </tr>
            <tr>
                <td class="man-icon"><img class="man-icon" src="../rsc/img/man_blue.png" alt=""></td>
                <td><label>Crew</label></td>
                <td><p>'.$crew.'/'.$row['Event_crew'].'</p></td>
                <td><a href="create_handler.php?object=sign&name=submit&job=crew&id='.$id.'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a></td>
            </tr>
             <tr>
                <td><img class="man-icon" src="../rsc/img/man_black.png" alt=""></td>
                <td><label>Technical</label></td>
                <td><p>'.$technical.'/'.$row['Event_tech'].'</p></td>
                <td><a href="create_handler.php?object=sign&name=submit&job==tech&id='.$id.'" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a></td>
                
            </tr>
            </table>
            ';

        echo $output;


}
?>