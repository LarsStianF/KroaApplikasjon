<?php

function PwCheck ($myemail, $pwhash)
{
global $con;
$sql = "SELECT Password FROM volunteer WHERE Email = '$myemail'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
echo $pwhash ,  "|";
    echo $row['Password'];
if ($pwhash == $row['Password']) {
return true;
} else {
return false;
}

}

function populate_volunteers_all(){
    global $con;

    $sql = 'SELECT * FROM Volunteer';
    $result = mysqli_query($con, $sql);
    volunteers_content($result);
}

function populate_volunteers_filter($crew_type_ID){
    global $con;

    $sql = 'SELECT * FROM Volunteer, event_volunteer 
            WHERE Volunteer.ID = event_volunteer.Vol_ID 
              AND  event_volunteer.crew_type_ID = ' . $crew_type_ID;
    $result = mysqli_query($con, $sql);

        volunteers_content($result);

}

function volunteers_content($result){


    while ($row = mysqli_fetch_array($result)) {
        $output = "";
        $id = $row['ID'];
        echo '<div id="namerow">';
        echo '<a href="#peopleModal" class="list-group-item list-group-item-action flex-column align-items-start view_data" data-toggle="modal" id="'.$id.'">';
        echo '<div class="d-flex w-100 justify-content-between">';
        echo '<ul class="list-inline ">';
        echo '<li class="list-inline-item "><h5 class="mb-1">';
        echo $row['Firstname'] . ' ' . $row['Lastname'];
        echo '</h5></li>';
        echo '<li class="list-inline-item "><h6 class="mb-1">';

        manager_check($row, $id, $output);
        echo $output;

        echo '</h6></li>';
        populate_little_men($id);

        echo '</ul>';

        // THIS SHOULD ONLY BE VISABLY TO DAGLIG LEDER / FRIVILLIGKOORDINATOR
        echo '<button class="btn btn-primary" type="submit">Edit</button>';
        //_____________________________________________________________________

        echo '</div>';
        echo '<p class="mb-1"><span class="h6">Email: </span>';
        echo $row['Email'];
        echo '<span class="h6"> - Tlf: </span>';
        echo $row['nr'];
        echo '</p>';
        populate_last_volunteered($id);
        echo '</a>';
        echo '</div>';
    }
}

function manager_check($row, $id, $output){
    global $con;
    if ($row['user_type'] == '5') {


        populate_manager_row($id, $output);

    }else{
        $tempQuery = "SELECT * FROM user_type WHERE " . $row['user_type'] . " = ID";
        $tempRes = mysqli_query($con,$tempQuery);
        $tempRow = mysqli_fetch_array($tempRes);
        $output = $tempRow['user_type'];

        echo $output;
    }
}


function populate_manager_row($id, $output){
    global $con;
    $sql = "SELECT * FROM manager, crew_type WHERE " . $id . " = manager.vol_ID AND crew_type.ID = manager.crew_type_ID";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $output.= $row['type'] . ' Manager - ';

    }echo $output;

}

function check_if_worked_crew($id, $crew_type){
    global $con;
    $sql = "SELECT COUNT(*) AS has_worked FROM event_volunteer WHERE " . $id . " = vol_ID AND crew_type_ID = " . $crew_type ;
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

     if($row['has_worked'] !== '0'){
         return true;
     } else {
         return false;
     }
}

function populate_little_men($id){

    $bar = 1;
    $security = 2;
    $crew = 3;
    $tech = 4;

        if (check_if_worked_crew($id, $bar) == true){
            echo '<li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_black.png" alt=""> </li>';
        } else{

        }
        if (check_if_worked_crew($id, $security) == true) {
            echo '<li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_red.png" alt=""> </li>';
        } else{

        }
        if (check_if_worked_crew($id, $crew) == true) {
            echo '<li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_blue.png" alt=""> </li>';
        } else{

        }
        if (check_if_worked_crew($id, $tech) == true) {
            echo '<li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_black.png" alt=""> </li>';
        } else{

        }

}


function populate_last_volunteered($id){
    global $con;
    $sql = "SELECT event.Date 
            FROM event, event_volunteer 
            WHERE event.Date < CURDATE()
                AND " . $id . " = event_volunteer.vol_ID 
                AND event_volunteer.event_ID = event.ID 
            LIMIT 1";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    echo '<small>Last Volunteered: ';

    if($row['Date'] !== NULL) {
        echo $row['Date'];
    } else{
        echo 'Never';
    }
                echo '</small>';

  }


function get_event_volunteers($id) {
    global $con;

    //Preliminary data:
    $numBar = 0;
    $numSec = 0;
    $numCrew = 0;
    $numTech = 0;



    $query = "SELECT * FROM event_volunteer WHERE event_ID = '$id' ";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        if($row['crew_type_ID'] == 1)
            $numBar++;
        else if ($row['crew_type_ID'] == 2)
            $numSec++;
        else if ($row['crew_type_ID'] == 3)
            $numCrew++;
        else if ($row['crew_type_ID'] == 4)
            $numTech++;
    }
    $volunteers = array($numBar,$numSec,$numCrew,$numTech);
    return $volunteers;

}


function volUnitUpdate($vol_id, $name){
    global $con;


    if (isset($_POST['unitRemove'])){
        $units = $_POST['unitRemove'];

        $sql  = 'UPDATE volunteer SET ';
        $sql .= 'Unit = Unit - '.$units.' ';
        $sql .= 'WHERE ID = '.$vol_id.';';
    }
    if (isset($_POST['unitAdd'])){
        $units = $_POST['unitAdd'];

        $sql  = 'UPDATE volunteer SET ';
        $sql .= 'Unit = Unit + '.$units.' ';
        $sql .= 'WHERE ID = '.$vol_id.';';
    }



    mysqli_query($con,$sql);

    header('Refresh: 0; URL=unitlist.php');


}

function create_new_event($name_attribute) {
    global $con;

    if(isset($_POST[$name_attribute])) {

        // Extract variables from fields
        $event_name = $_POST['event_name'];
        $event_type = $_POST['event_type'];
        $event_date = $_POST['date'];
        $event_start = $_POST['start_time'];
        $event_end = $_POST['end_time'];
        $event_text = $_POST['event_text'];
        $event_sec_vol = $_POST['sec_volunteers'];
        $event_bar_vol = $_POST['bar_volunteers'];
        $event_crew_vol = $_POST['crew_volunteers'];
        $event_tech_vol = $_POST['tech_volunteers'];

        //Create insert
        $sql = "INSERT INTO event(Name, Date, Time_Start, Time_End, Type, Event_Text, Event_sec, Event_bar, Event_crew, Event_tech) 
                     VALUES ('$event_name', '$event_date', '$event_start', '$event_end', '$event_type', '$event_text', '$event_sec_vol', '$event_bar_vol', '$event_crew_vol', '$event_tech_vol');";

        mysqli_query($con, $sql);


        // Check if event was created in DB:
        $sql_exist = 'SELECT COUNT(*) AS Existence FROM event WHERE ';
        $sql_exist .= 'Name = "' . $event_name . '" AND ';
        $sql_exist .= 'Event_text = "' . $event_text . '" AND ';
        $sql_exist .= 'Date = "' . $event_date . '" AND ';
        $sql_exist .= 'Time_Start = "' . $event_start . '" AND ';
        $sql_exist .= 'Time_End = "' . $event_end . '" AND ';
        $sql_exist .= 'Type = "' . $event_type . '";';
        $result = mysqli_query($con, $sql_exist);
        $row = mysqli_fetch_array($result);

        if ($row['Existence'] == 1) {

            // event was created in DB:
            $status_db = 1;

        } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

            // event was not created in DB:
            $status_db = 0;

        }

        header('Refresh: 0; URL=event_grid.php?created=event&status=' . $status_db);


    }
}
?>