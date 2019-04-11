<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';


if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $output = "";
    $query = "SELECT * FROM event WHERE ID = '".$id."'";
    $result =  mysqli_query($con, $query);
    $output .= '
    <div class="text-center">';
        $row = mysqli_fetch_array($result);

        //gets time
        $sTime = new DateTime($row['Time_Start']);
        $eTime = new DateTime($row['Time_End']);
        $startTime = $sTime->format('H:i');
        $endTime = $eTime->format('H:i');

        // get fix date
        $d = new DateTime($row['Date']);
        $date = $d->format('d-m-Y');

            $output .= '
                <h1>'.$row['Name'].'</h1> 
                <hr class="mt-1">
                <h2>'.$date.'</h2>
                <h2>'.$startTime.' - '.$endTime.'</h2>
                <h2><label class="mr-2">Event type:</label>'.$row['Type'].'</h2>
                <hr>
                <h6>Info</h6>
                <p>'.$row['Event_text'].'</p>
            ';

        $output .= "</div>";



        echo $output;
        get_event_modal_volunteers($id);

}
?>