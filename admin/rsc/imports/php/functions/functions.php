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
    $sql = "SELECT COUNT(*) FROM event_volunteer WHERE " . $id . " = vol_ID AND crew_type_ID = " . $crew_type ;
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

     if($row['COUNT(*)'] !== '0'){
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
?>