<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    header('Refresh: 0; URL=index.php');

    $query = "SELECT * FROM event WHERE ID = '".$id."'";
    $result =  mysqli_query($con, $query);


    $row = mysqli_fetch_array($result);

    // event type
    $type = $row['Type'];

    //gets time
    $sTime = new DateTime($row['Time_Start']);
    $eTime = new DateTime($row['Time_End']);
    $startTime = $sTime->format('H:i');
    $endTime = $eTime->format('H:i');

    // get fix date
    $d = new DateTime($row['Date']);
    $date = $d->format('F jS o');


    $output = '
    <form method="POST" action="????" enctype="multipart/form-data">

    <!-- Event name: -->
    <div class="form-group">
        <label>Event name</label>
        <input type="text" name="event_name" class="form-control form-text" value="'.$row['Name'].'">
    </div>

    <!-- Event type: -->
    <div class="form-group">
        <label>Event type</label>
        <select name="event_type" class="form-control">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="'.$type.'" selected>'.$type.' current type</option>
        </select>
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
            <img class="man-icon d-flex" src="../rsc/img/man_black.png" alt="">
            <label>Security</label>
            <input class="form-control d-flex" style="width 60px; max-width: 60px" type="number" name="sec_volunteers" value="'.$row['Event_sec'].'" min="1" max="20">
        </div>

        <div class="d-flex justify-content-around">
            <img class="man-icon d-flex" src="../rsc/img/man_red.png" alt=""><label>Bar</label>
            <input class="form-control d-flex" style="width 60px; max-width: 60px" type="number" name="bar_volunteers" value="'.$row['Event_bar'].'" min="1" max="20">
        </div>
    </div>
    <div class="form-group d-flex justify-content-around">
        <div class="d-flex justify-content-between">
            <img class="man-icon" src="../rsc/img/man_blue.png" alt=""><label>Crew</label>
            <input class="form-control form-inline" style="width 60px; max-width: 60px" type="number" name="crew_volunteers" value="'.$row['Event_crew'].'" min="1" max="20">
        </div>

        <div class="d-flex justify-content-around">
            <img class="man-icon" src="../rsc/img/man_black.png" alt=""><label>Technical</label>
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