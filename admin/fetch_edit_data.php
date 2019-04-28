<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}

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
    <form method="POST" action="update_handler.php?object=event&name=submit&id='.$id.'" enctype="multipart/form-data">

    <!-- Event name: -->
    <div class="form-group">
        <label>Event name</label>
        <input type="text" name="event_name" class="form-control form-text" value="'.$row['Name'].'">
    </div>

    <!-- Event Date: -->
    <div class="form-group">
        <label>Event Date</label>
        <input type="date" name="date" class="form-control form-text" value="'.$row['Date'].'">
    </div>

    <!-- Event Time: -->
    <div class="form-group">
        <label>Event Time</label>
        <div class="form-row">
            <label>From:</label>
            <div class="col">
                <input type="time" name="start_time" class="form-control form-inline" value="'.$row['Time_Start'].'">
            </div>
            <label>To:</label>
            <div class="col">
                <input type="time" name="end_time" class="form-control form-inline" value="'.$row['Time_End'].'">
            </div>
        </div>
    </div>


    <!-- event text: -->
    <div class="form-group mt-4">
        <label>Event text</label>
        <textarea name="event_text" class="form-control" maxlength="255" style="height: 80px">'.$row['Event_text'].'</textarea>
    </div>



    <div class="form-group d-flex justify-content-around">
        <div class="d-flex justify-content-between">
            <i class="man-icons-modal fa fa-user" style="color:orange;font-size:40px;"></i>
            <label>Security</label>
            <input class="form-control d-flex" style="width 60px; max-width: 60px" type="number" name="sec_volunteers" value="'.$row['Event_sec'].'" min="1" max="20">
        </div>

        <div class="d-flex justify-content-around">
            <i class="man-icons-modal fa fa-user" style="color:red;font-size:40px;"></i>
            <input class="form-control d-flex" style="width 60px; max-width: 60px" type="number" name="bar_volunteers" value="'.$row['Event_bar'].'" min="1" max="20">
        </div>
    </div>
    <div class="form-group d-flex justify-content-around">
        <div class="d-flex justify-content-between">
            <i class="man-icons-modal fa fa-user" style="color:black;font-size:40px;"></i>
            <input class="form-control form-inline" style="width 60px; max-width: 60px" type="number" name="crew_volunteers" value="'.$row['Event_crew'].'" min="1" max="20">
        </div>

        <div class="d-flex justify-content-around">
            <i class="man-icons-modal fa fa-user" style="color:blue;font-size:40px;"></i>
            <input class="form-control form-inline" style="width 60px; max-width: 60px" type="number" name="tech_volunteers" value="'.$row['Event_tech'].'" min="1" max="20">
        </div>
    </div>


    <div class="form-group mt-2">
        <button type="submit" class="btn btn-success" name="submit">Edit event</button>
    </div>


</form>
           ';

    echo $output;
}
?>
