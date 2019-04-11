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
    $numrow = mysqli_num_rows($result);


    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID'];

        echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">';
        echo '<div class="d-flex w-100 justify-content-between">';
        echo '<ul class="list-inline ">';
        echo '<li class="list-inline-item "><h5 class="mb-1">';
        echo $row['Firstname'] . ' ' . $row['Lastname'];
        echo '</h5></li>';
        echo '<li class="list-inline-item "><h6 class="mb-1">';
        if ($row['user_type'] == '5') {


            populate_manager_row($id);

        }else{
            $tempQuery = "SELECT * FROM user_type WHERE " . $row['user_type'] . " = ID";
            $tempRes = mysqli_query($con,$tempQuery);
            $tempRow = mysqli_fetch_array($tempRes);
            echo $tempRow['user_type'];
        }


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
    }
}

function populate_volunteers_filter($crew_type_ID){
    global $con;

    $sql = 'SELECT * FROM Volunteer, event_volunteer 
            WHERE Volunteer.ID = event_volunteer.Vol_ID 
              AND  event_volunteer.crew_type_ID = ' . $crew_type_ID;
    $result = mysqli_query($con, $sql);


    while ($row = mysqli_fetch_array($result)) {
        $id = $row['ID'];

        echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">';
        echo '<div class="d-flex w-100 justify-content-between">';
        echo '<ul class="list-inline ">';
        echo '<li class="list-inline-item "><h5 class="mb-1">';
        echo $row['Firstname'] . ' ' . $row['Lastname'];
        echo '</h5></li>';
        echo '<li class="list-inline-item "><h6 class="mb-1">';
        if ($row['user_type'] == '5') {


            populate_manager_row($id);

        }else{
            $tempQuery = "SELECT * FROM user_type WHERE " . $row['user_type'] . " = ID";
            $tempRes = mysqli_query($con,$tempQuery);
            $tempRow = mysqli_fetch_array($tempRes);
            echo $tempRow['user_type'];
        }


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
    }
}


function populate_manager_row($id){
    global $con;
    $sql = "SELECT * FROM manager, crew_type WHERE " . $id . " = manager.vol_ID AND crew_type.ID = manager.crew_type_ID";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo $row['type'] . ' Manager - ';
    }
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
    $output = "";

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

    $output .= '
    <ul class="list-group list-group-flush volunteers_list ml-5">
        <li class="list-group-item volunteers_item"><p>'.$numBar.'/10</p><img class="man-icon" src="../rsc/img/man_black.png" alt=""></li>
        <li class="list-group-item volunteers_item"><p>'.$numSec.'/10</p><img class="man-icon" src="../rsc/img/man_red.png" alt=""></li>
        <li class="list-group-item volunteers_item"><p>'.$numCrew.'/10</p><img class="man-icon" src="../rsc/img/man_blue.png" alt=""></li>
        <li class="list-group-item volunteers_item"><p>'.$numTech.'/10</p><img class="man-icon" src="../rsc/img/man_black.png" alt=""></li>
    </ul>
    ';

    echo $output;
}

function get_event_modal_volunteers($id) {
    global $con;

    $numBar = 0;
    $numSec = 0;
    $numCrew = 0;
    $numTech = 0;
    $output = "";

    $query = "SELECT * FROM event_volunteer WHERE event_ID = '$id'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);

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

    $output .= '
    <div class="table-responsive">
        <table class="table table-striped text-center ">
            <tr>
                <td><img class="man-icon" src="../rsc/img/man_black.png" alt=""></td>
                <td><label>Bar</label></td>
                <td><p>'.$numBar.'/10</p></td>
                <td><a href="index.php?signup=true&name=bar" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a>
            </tr>
            <tr>
                <td><img class="man-icon" src="../rsc/img/man_red.png" alt=""></td>
                <td><label>Security</label></td>
                <td><p>'.$numSec.'/10</p></td>
                <td><a href="index.php?signup=true&name=sec" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a></td>
            </tr>
            <tr>
                <td class="man-icon"><img class="man-icon" src="../rsc/img/man_blue.png" alt=""></td>
                <td><label>Crew</label></td>
                <td><p>'.$numCrew.'/10</p></td>
                <td><a href="index.php?signup=true&name=crew" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a></td>
            </tr>
             <tr>
                <td><img class="man-icon" src="../rsc/img/man_black.png" alt=""></td>
                <td><label>Technical</label></td>
                <td><p>'.$numTech.'/10</p></td>
                <td><a href="index.php?signup=true&name=tech" type="button"  class="btn btn-primary btn-small border-dark m-2">Sign up!</a></td>
                
            </tr>
            </table>
           
           
            

    ';
    echo $output;


}
?>