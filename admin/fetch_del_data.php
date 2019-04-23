<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    header('Refresh: 0; URL=index.php');

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
            <hr>
            <h6 class="text-center">Are you sure you want to delete this event?</h6>
            <p class="text-center">Volunteers would have to apply again</p>
            <div class="d-flex justify-content-center">
            
            <a href="delete_handler.php?delete=event&id='.$id.'" type="button"  class="btn btn-danger btn-lg border-dark m-2">Delete event</a>
            </div>';

    echo $output;
}
?>