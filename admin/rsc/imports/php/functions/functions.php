<?php
$root = 1; $dag_leder = 2; $vol_cord = 3; $event_man = 4; $manager = 5; $volunteer = 6;

function PwCheck ($myemail, $pwhash)
{
global $con;
$sql = "SELECT Password FROM volunteer WHERE Email = '$myemail'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
if ($pwhash == $row['Password']) {
return true;
} else {
return false;
}

}

function array_list($query)
{
    global $con;
    $query = mysqli_query($con,$query);
    if (!$query) return null;

    // Creates array
    $array = array();
    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row);
    }
    // Frees memory after search
    mysqli_free_result($query);
    return $array;
}


function get_volunteer_user_type($vol_id){
    global $con;

    $user_query= 'SELECT * FROM volunteer WHERE ID = '.$vol_id.';';
    $user_result = mysqli_query($con, $user_query);
    $user_row = mysqli_fetch_array($user_result);

    $sql = 'SELECT * FROM user_type WHERE ID = ' .$user_row['user_type'].';';
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $user_type = $row['user_type'];

    return $user_type;
}


function populate_volunteers_all(){
    global $con;

    $sql = 'SELECT * FROM Volunteer where user_type > 1;';
    $result = mysqli_query($con, $sql);
    volunteers_content($result);
}

function populate_volunteers_filter($crew_type_ID){
    global $con;

    $sql = 'SELECT * FROM Volunteer, event_volunteer 
            WHERE Volunteer.ID = event_volunteer.Vol_ID AND user_type > 1 
              AND  event_volunteer.crew_type_ID = ' . $crew_type_ID.';';
    $result = mysqli_query($con, $sql);

        volunteers_content($result);

}

function volunteers_content($result){
    $root = 1; $dag_leder = 2; $vol_cord = 3; $event_man = 4; $manager = 5; $volunteer = 6;
    $cur_user = $_SESSION['login_type'];
    while ($row = mysqli_fetch_array($result)) {
        $output = "";
        $id = $row['ID'];
        echo '<div id="namerow">';
        if ($cur_user <= $dag_leder){
            echo '<a href="#peopleModal" class=" filterSearch list-group-item list-group-item-action flex-column align-items-start view_data" data-toggle="modal" id="'.$id.'">';

        } else{
            echo '<div class="filterSearch list-group-item list-group-item-action flex-column align-items-start" id="'.$id.'">';
        }
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

        // THIS SHOULD ONLY BE VISABLE TO DAGLIG LEDER
        if ($cur_user <= $dag_leder){
            echo '<button class="btn btn-primary" type="submit">Edit</button>';
        }
        //_____________________________________________________________________

        echo '</div>';
        echo '<p class="mb-1"><span class="h6">Email: </span>';
        echo $row['Email'];
        echo '<span class="h6"> - Tlf: </span>';
        echo $row['nr'];
        echo '</p>';
        populate_last_volunteered($id);
        if ($cur_user <= $dag_leder){
            echo '</a>';
        } else{
            echo '</div>';

        }
        echo '</div>';
    }
}

function populate_people_edit_user_type($id, $row){
        global $con;
        $output = "";
        $cur_user = $_SESSION['login_type'];
        $root = 1; $dag_leder = 2; $vol_cord = 3; $event_man = 4; $manager = 5; $volunteer = 6;

        // If User is root. Get all user types
        if ($cur_user == $root){
            $user_type_sql = "SELECT * FROM user_type WHERE ID > 1;";


            // If User is Daglig Leder, get all user types except root
        }elseif ($cur_user == $dag_leder){
            $user_type_sql = "SELECT * FROM user_type WHERE ID > 2;";
        }else{
            $user_type_sql ="";
        }
        $user_type_result = mysqli_query($con, $user_type_sql);

        $user_query = 'SELECT user_type FROM volunteer WHERE ID = '.$id.';';
        $user_result = mysqli_query($con,$user_query);
        $user_array = mysqli_fetch_array($user_result);
        $user_type_id = $user_array['user_type'];

        $output .= '
                                             <select class="form-control" id="selRole" name="selRole">';

        while ( $row = mysqli_fetch_array($user_type_result) ) {

            if ( $row['ID'] == $user_type_id ){
                $output .='
            
                <option value="' . $row['ID'] . '" name="'.$row['user_type'].'" selected >' . $row['user_type'] . '</option>';
            }
            else {
                $output .= '<option value="' . $row['ID'] . '" name="'.$row['user_type'].'">' . $row['user_type'] . '</option>';
            }

        }
        $output .= '
                                             </select>';
    return $output;
    }

    function populate_user_edit_crew_checkbox($id, $crew_id){
    global $con;
    $checked="";

        $sql = 'SELECT * FROM manager WHERE vol_ID = '.$id.' AND crew_type_ID = '.$crew_id;
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);

            if($row['crew_type_ID'] == 1){
                $checked='checked';

            }if($row['crew_type_ID'] == 2){
                $checked='checked';

            }if($row['crew_type_ID'] == 3){
                $checked='checked';

            }if($row['crew_type_ID'] == 4){
                $checked='checked';

            }


        return $checked;
    }


function manager_check($row, $id, $output){
    global $con;
    if ($row['user_type'] == '5') {


        populate_manager_row($id, $output);

    }else{
        $tempQuery = "SELECT * FROM user_type WHERE " . $row['user_type'] . " = ID;";
        $tempRes = mysqli_query($con,$tempQuery);
        $tempRow = mysqli_fetch_array($tempRes);
        $output = $tempRow['user_type'];

        echo $output;
    }
}


function populate_manager_row($id, $output){
    global $con;
    $sql = "SELECT * FROM manager, crew_type WHERE " . $id . " = manager.vol_ID AND crew_type.ID = manager.crew_type_ID;";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $output.= $row['type'] . ' Manager - ';

    }echo $output;

}

function check_if_worked_crew($id, $crew_type){
    global $con;
    $sql = "SELECT COUNT(*) AS has_worked FROM event_volunteer WHERE " . $id . " = vol_ID AND crew_type_ID = " . $crew_type.';' ;
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
        echo '<li class="list-inline-item fa fa-user fa-lg" style="color: Orange" > </li>';
    } else{

    }
    if (check_if_worked_crew($id, $security) == true) {
        echo '<li class="list-inline-item fa fa-user fa-lg" style="color: Red" > </li>';
    } else{

    }
    if (check_if_worked_crew($id, $crew) == true) {
        echo '<li class="list-inline-item fa fa-user fa-lg" style="color: Black" > </li>';
    } else{

    }
    if (check_if_worked_crew($id, $tech) == true) {
        echo '<li class="list-inline-item  fa fa-user fa-lg" style="color: Blue" > </li>';
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
            LIMIT 1;";
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



    $query = "SELECT crew_type_ID FROM event_volunteer WHERE event_ID = $id";
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

function admin_set_user_role($vol_id){
    global $con;

    $stmt = $con->prepare("UPDATE volunteer SET user_type = ? WHERE ID = ?");
    $newUserType = $_POST['selRole'];
    $newUserType = mysqli_real_escape_string($con,$newUserType);

    $stmt->bind_param("ii", $newUserType, $vol_id);
    $stmt->execute();
    $stmt->close();

    $stmtDel = $con->prepare("DELETE FROM manager WHERE vol_id = ?");
    $stmtDel->bind_param("i", $vol_id);
    $stmtDel->execute();
    $stmtDel->close();

echo $newUserType;
    if ($newUserType === '5'){
        if (!empty($_POST['manRole_list'])) {
            $stmt = $con->prepare("INSERT INTO manager(vol_id, crew_type_ID) VALUES(?, ?)");
            foreach ($_POST['manRole_list'] as $crew_name) {
                if ($crew_name === 'Bar'){
                    $crew_type = 1;
                }elseif ($crew_name === 'Security'){
                    $crew_type = 2;
                }elseif ($crew_name === 'Crew'){
                    $crew_type = 3;
                }elseif ($crew_name === 'Technical'){
                    $crew_type = 4;
                }else{
                    $stmt->close();
                    header('Refresh: 0; URL=people.php');
                }
                $stmt->bind_param("ii", $vol_id, $crew_type);
                $stmt->execute();
            }
            $stmt->close();
        }
    }

    header('Refresh: 0; URL=people.php');

}

    function volUnitUpdate($vol_id)
    {
        global $con;


        if (isset($_POST['unitRemove'])) {
            $units = $_POST['unitRemove'];
            $units= mysqli_real_escape_string($con, $units);

            $sql = 'UPDATE volunteer SET ';
            $sql .= 'Unit = Unit - ' . $units . ' ';
            $sql .= 'WHERE ID = ' . $vol_id . ';';
        }
        if (isset($_POST['unitAdd'])) {
            $units = $_POST['unitAdd'];
            $units= mysqli_real_escape_string($con, $units);
            $sql = 'UPDATE volunteer SET ';
            $sql .= 'Unit = Unit + ' . $units . ' ';
            $sql .= 'WHERE ID = ' . $vol_id . ';';
        }


        mysqli_query($con, $sql);

        header('Refresh: 0; URL=unitlist.php');


    }

    function create_new_event($name_attribute)
    {
        global $con;

        if (isset($_POST[$name_attribute])) {

            // Extract variables from fields
            $event_name = $_POST['event_name'];
            $event_date = $_POST['date'];
            $event_start = $_POST['start_time'];
            $event_end = $_POST['end_time'];
            $event_text = $_POST['event_text'];
            $event_sec_vol = $_POST['sec_volunteers'];
            $event_bar_vol = $_POST['bar_volunteers'];
            $event_crew_vol = $_POST['crew_volunteers'];
            $event_tech_vol = $_POST['tech_volunteers'];

            //Create insert
            $sql = "INSERT INTO event(Name, Date, Time_Start, Time_End, Event_Text, Event_sec, Event_bar, Event_crew, Event_tech) 
                     VALUES ('$event_name', '$event_date', '$event_start', '$event_end', '$event_text', '$event_sec_vol', '$event_bar_vol', '$event_crew_vol', '$event_tech_vol');";

            mysqli_query($con, $sql);


            // Check if event was created in DB:
            $sql_exist = 'SELECT COUNT(*) AS Existence FROM event WHERE ';
            $sql_exist .= 'Name = "' . $event_name . '" AND ';
            $sql_exist .= 'Event_text = "' . $event_text . '" AND ';
            $sql_exist .= 'Date = "' . $event_date . '" AND ';
            $sql_exist .= 'Time_Start = "' . $event_start . '" AND ';
            $sql_exist .= 'Time_End = "' . $event_end . '";';
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

function add_to_want_volunteer($sign_job, $event_id, $vol_id) {

    global $con;


    $sql_exist = 'SELECT COUNT(*) AS Existence FROM want_volunteer WHERE ';
    $sql_exist .= 'vol_ID = "' . $vol_id . '" AND ';
    $sql_exist .= 'event_ID = "' . $event_id . '" AND ';
    $sql_exist .= 'crew_type_ID = "' . $sign_job . '";';

    $result = mysqli_query($con, $sql_exist);
    $row = mysqli_fetch_array($result);

    if ($row['Existence'] == 1) {
        // application exists
        $status_db = 0;

        header('Refresh: 0; URL=index.php?created=application&status=' . $status_db);


    } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

        $sql = "INSERT INTO want_volunteer(vol_ID, event_ID, crew_type_ID)
                              VALUES ('$vol_id', '$event_id', '$sign_job');";

        mysqli_query($con, $sql);

        // Check if event was created in DB:
        $sql_exist = 'SELECT COUNT(*) AS Existence FROM want_volunteer WHERE ';
        $sql_exist .= 'vol_ID = "' . $vol_id . '" AND ';
        $sql_exist .= 'event_ID = "' . $event_id . '" AND ';
        $sql_exist .= 'crew_type_ID = "' . $sign_job . '";';

        $result = mysqli_query($con, $sql_exist);
        $row = mysqli_fetch_array($result);

        if ($row['Existence'] == 1) {

            // event was created in DB:
            $status_db = 1;

        } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

            // event was not created in DB:
            $status_db = 0;

        }

        header('Refresh: 0; URL=index.php?created=application&status=' . $status_db);


    }
}

    function populate_volunteers($id, $crew_id)
    {
        global $con;

        $sql = "SELECT volunteer.Firstname, volunteer.Lastname, event_volunteer.manager
            FROM event_volunteer
            INNER JOIN volunteer
            ON volunteer.ID = event_volunteer.vol_ID 
            AND event_volunteer.crew_type_ID = $crew_id
            AND event_volunteer.event_ID = $id;";

        $result = mysqli_query($con, $sql);


        $output = '<div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr><td><b>First name</b></td><td><b>Last name</b></td><td><b>Manager</b></td></tr>
                        <br>


    
    ';


        while ($row = mysqli_fetch_array($result)) {
            if ($row['manager'] == 1) {
                $output .= "<tr><td>" . $row['Firstname'] . "</td><td>" . $row['Lastname'] . "</td><td>Yes</td></tr>";
            } else
                $output .= "<tr><td>" . $row['Firstname'] . "</td><td>" . $row['Lastname'] . "</td><td>No</td></tr>";


        }

        $output .= "</table>
              </div>";
        return $output;


    }

    function delete_event($id)
    {


        global $con;
        // get preliminary data:
        $sql = "SELECT Date FROM event WHERE ID = $id;";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $event_date = $row['Date'];
        $today = date("Y-m-d");

        if ($event_date <= $today) {
            $status_db = 2;
            header('Refresh: 0; URL=event_grid.php?deleted=event&status=' . $status_db);
            exit();
        } else {

            global $con;

            // get preliminary data:
            $sql = "SELECT Date FROM event WHERE ID = $id;";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);
            $event_date = $row['Date'];
            $today = date("Y-m-d");

            if ($event_date <= $today) {
                $status_db = 2;
                header('Refresh: 0; URL=event_grid.php?deleted=event&status=' . $status_db);
                exit();
            } else {

                $sqllog = "SELECT COUNT(*) AS Existence FROM logs WHERE event_ID = $id;";
                $resultlog = mysqli_query($con, $sqllog);
                $rowlog = mysqli_fetch_array($resultlog);

                if ($rowlog['Existence'] == 0) {
                    // Remove volunteers on waiting list for the event.
                    $sql1 = "DELETE FROM want_volunteer WHERE Event_ID = $id;";
                    mysqli_query($con, $sql1);

                    // Remove accepted volunteers from event volunteers .
                    $sql2 = "DELETE FROM event_volunteer WHERE Event_ID = $id;";
                    mysqli_query($con, $sql2);

                    $sql3 = "DELETE FROM event WHERE ID = $id;";
                    mysqli_query($con, $sql3);


                    // Check if event was deleted in DB:
                    $sql_exist = "SELECT COUNT(*) AS Existence FROM event WHERE ID = $id;";
                    $result = mysqli_query($con, $sql_exist);
                    $row = mysqli_fetch_array($result);

                    $sqllog = "SELECT COUNT(*) AS Existence FROM logs WHERE event_ID = '$id';";
                    $resultlog = mysqli_query($con, $sqllog);
                    $rowlog = mysqli_fetch_array($resultlog);
                    if ($rowlog['Existence'] == 0) {
                        // Remove volunteers on waiting list for the event.
                        $sql1 = "DELETE FROM want_volunteer WHERE Event_ID = $id;";
                        mysqli_query($con, $sql1);

                        // Remove accepted volunteers from event volunteers .
                        $sql2 = "DELETE FROM event_volunteer WHERE Event_ID = $id;";
                        mysqli_query($con, $sql2);

                        $sql3 = "DELETE FROM event WHERE ID = $id;";
                        mysqli_query($con, $sql3);
                        mysqli_commit($con);

                        // Check if event was deleted in DB:
                        $sql_exist = 'SELECT COUNT(*) AS Existence FROM event WHERE ';
                        $sql_exist .= 'ID = ' . $id . ';';

                        $result = mysqli_query($con, $sql_exist);
                        $row = mysqli_fetch_array($result);

                        if ($row['Existence'] == 0) {

                            //event deleted
                            $status_db = 1;
                            header('Refresh: 0; URL=event_grid.php?deleted=event&status=' . $status_db);

                        } else if ($row['Existence'] == 1) {


                            $status_db = 0;

                            header('Refresh: 0; URL=event_grid.php?deleted=event&status=' . $status_db);
                        }
                    } elseif ($rowlog['Existence'] > 0) {

                        $status_db = 3;
                        header('Refresh: 0; URL=event_grid.php?deleted=event&status=' . $status_db);
                    }
                }
            }
        }
    }

            Function edit_event($id, $name_attribute)
            {

                global $con;


                if (isset($_POST[$name_attribute])) {

                    // Extract variables from fields
                    $event_name = $_POST['event_name'];
                    $event_date = $_POST['date'];
                    $event_start = $_POST['start_time'];
                    $event_end = $_POST['end_time'];
                    $event_text = $_POST['event_text'];
                    $event_sec_vol = $_POST['sec_volunteers'];
                    $event_bar_vol = $_POST['bar_volunteers'];
                    $event_crew_vol = $_POST['crew_volunteers'];
                    $event_tech_vol = $_POST['tech_volunteers'];


                    if (isset($_POST[$name_attribute])) {

                        // Extract variables from fields
                        $event_name = mysqli_real_escape_string($con, $_POST['event_name']);
                        $event_date = mysqli_real_escape_string($con, $_POST['date']);
                        $event_start = mysqli_real_escape_string($con, $_POST['start_time']);
                        $event_end = mysqli_real_escape_string($con, $_POST['end_time']);
                        $event_text = mysqli_real_escape_string($con, $_POST['event_text']);
                        $event_sec_vol = mysqli_real_escape_string($con, $_POST['sec_volunteers']);
                        $event_bar_vol = mysqli_real_escape_string($con, $_POST['bar_volunteers']);
                        $event_crew_vol = mysqli_real_escape_string($con, $_POST['crew_volunteers']);
                        $event_tech_vol = mysqli_real_escape_string($con, $_POST['tech_volunteers']);


                        //Create insert
                        $sql = "UPDATE event SET 

                Name        = '$event_name', 
                Date        = '$event_date', 
                Time_Start  = '$event_start', 
                Time_End    = '$event_end',
                Event_text  = '$event_text',
                Event_sec   = '$event_sec_vol',
                Event_bar   = '$event_bar_vol',
                Event_crew  = '$event_crew_vol',
                Event_tech  = '$event_tech_vol'  WHERE
                ID ='$id';";

                        mysqli_query($con, $sql);


                        // Check if event was created in DB:
                        $sql_exist = 'SELECT COUNT(*) AS Existence FROM event WHERE ';
                        $sql_exist .= 'Name = "' . $event_name . '" AND ';
                        $sql_exist .= 'Event_text = "' . $event_text . '" AND ';
                        $sql_exist .= 'Date = "' . $event_date . '" AND ';
                        $sql_exist .= 'Time_Start = "' . $event_start . '" AND ';
                        $sql_exist .= 'Time_End = "' . $event_end . '";';
                        $result = mysqli_query($con, $sql_exist);
                        $row = mysqli_fetch_array($result);

                        if ($row['Existence'] == 1) {

                            // event was created in DB:
                            $status_db = 1;

                        } elseif ($row['Existence'] == 0 || $row['Existence'] == null) {

                            // event was not created in DB:
                            $status_db = 0;

                        }
                        //echo $sql;
                        header('Refresh: 0; URL=event_grid.php?updated=event&status=' . $status_db);


                    }

                }
            }

function get_signed_roles($user_id, $event_id) {
    global $con;

    $sql = "SELECT want_volunteer.crew_type_ID from want_volunteer WHERE want_volunteer.vol_ID = $user_id AND want_volunteer.event_ID = $event_id";

    $result = mysqli_query($con, $sql);


    $output = "<ul class='pr-2' style='list-style: none; padding: 0;'>";



    while($row = mysqli_fetch_array($result)) {

        if($row['crew_type_ID'] == 1) {
            $output .= '<li class="mt-2"><i class="man-icons-modal fa fa-user" style="color:orange;font-size:25px;"></i></li>';
        }
        if($row['crew_type_ID'] == 2) {
            $output .= '<li class="mt-2"><i class="man-icons-modal fa fa-user" style="color:red;font-size:25px;"></i></li>';
        }
        if($row['crew_type_ID'] == 3) {
            $output .= '<li class="mt-2"><i class="man-icons-modal fa fa-user" style="color:black;font-size:25px;"></i></li>';
        }
        if($row['crew_type_ID'] == 4) {
            $output .= '<li class="mt-2"><i class="man-icons-modal fa fa-user" style="color:blue;font-size:25px;"></i></li>';
        }
    }

    $output .= '</ul>';

    return $output;

}

function get_confirmed_role($user_id, $event_id) {
    global $con;

    $sql = "SELECT crew_type_ID FROM event_volunteer WHERE vol_ID = $user_id AND event_ID = $event_id";
    $result = mysqli_query($con, $sql);


    $output = "<div class='mt-2 pr-2'>";



    while($row = mysqli_fetch_array($result)) {

        if($row['crew_type_ID'] == 1) {
            $output .= '<i class="man-icons-modal fa fa-user" style="color:orange;font-size:25px;"></i>';
        }
        if($row['crew_type_ID'] == 2) {
            $output .= '<i class="man-icons-modal fa fa-user" style="color:red;font-size:25px;"></i>';
        }
        if($row['crew_type_ID'] == 3) {
            $output .= '<i class="man-icons-modal fa fa-user" style="color:black;font-size:25px;"></i>';
        }
        if($row['crew_type_ID'] == 4) {
            $output .= '<i class="man-icons-modal fa fa-user" style="color:blue;font-size:25px;"></i>';
        }
    }

    $output .= '</div>';

    return $output;

}

function remove_from_want_volunteer($id, $job_id, $user_id) {

    global $con;

    $sql = "DELETE FROM want_volunteer WHERE event_ID = $id AND vol_ID = $user_id AND crew_type_ID = $job_id";
    mysqli_query($con,$sql);

    // Check if application was deleted in DB:
    $sql_exist = "SELECT COUNT(*) AS Existence FROM want_volunteer WHERE event_ID = $id AND vol_ID = $user_id AND crew_type_ID = $job_id";
    $result = mysqli_query($con, $sql_exist);
    $row = mysqli_fetch_array($result);

    if($row['Existence'] == 0) {

        //volunteer removed
        $status_db = 1;

        header('Refresh: 0; URL=index.php?deleted=application&status=' . $status_db);

    } else if ($row['Existence'] == 1) {

        //volunteer not removed
        $status_db = 0;

        header('Refresh: 0; URL=index.php?deleted=application&status=' . $status_db);
    }

}

function manager_crew_type_check($id, $crew_type) {

    global $con;
    $sql = "SELECT * FROM manager where vol_ID = $id AND crew_type_ID = $crew_type";
    $result = mysqli_query($con, $sql);
    $rows = mysqli_num_rows($result);

    if(!$rows) {
        return false;
    } else
        return true;


}

function populate_want_volunteers($id, $crew_id)
{
    global $con;

    $sql = "SELECT volunteer.ID, volunteer.Firstname, volunteer.Lastname
            FROM volunteer
            INNER JOIN want_volunteer
            ON volunteer.ID = want_volunteer.vol_ID 
            AND want_volunteer.crew_type_ID = $crew_id
            AND want_volunteer.event_ID = $id;";

    $result = mysqli_query($con, $sql);


    $output = '<form action="addvolunteer.php" method="POST">  
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr><td><b>First name</b></td><td><b>Last name</b></td><td><b>Add</b></td></tr>
                        </thead>


    
    ';


    while ($row = mysqli_fetch_array($result)) {

        $output .= '<tr><td>' . $row['Firstname'] . '</td><td>' . $row['Lastname'] . '</td><td><input type="checkbox" name="'.$id.'"></td></tr>';

    }

    $output .= '</table>
              </div>
              <div class="d-flex justify-content-center mb-3">
                <input type="submit" name="submit" value="Add volunteers" class="btn btn-small btn-primary">
              </div>
              
              </from>';
    return $output;

}

function  add_volunteer_to_event($user_id, $event_id, $sign_job, $man) {
    global $con;

    $sql = "INSERT INTO event_volunteer (vol_ID, event_ID, crew_type_ID, manager) VALUES
           ($user_id, $event_id, $sign_job, $man);";

    if( mysqli_query($con, $sql)) {
        $sql = "DELETE FROM want_volunteer 
                       WHERE vol_ID = $user_id
                       AND event_ID = $event_id;";

        //delete the other applications for this event
        mysqli_query($con,$sql);
        //Volunteer added, and deleted from want_volunteer
        $status_db = 1;

        header('Refresh: 0; URL=index.php?created=application&status=' . $status_db);



    } else {
        $status_db = 0;
        echo $sql;
        header('Refresh: 0; URL=index.php?created=application&status=' . $status_db);
    }






}

function remove_from_event_volunteer($user_id, $event_id) {
    global $con;

    $sql = "DELETE FROM event_volunteer WHERE vol_ID = $user_id AND event_ID = $event_id";

    if(mysqli_query($con, $sql)) {
        // if removed correctly
        $status_db = 1;
        header('Refresh: 0; URL=index.php?deleted=application&status=' . $status_db);
    } else {
        // not removed correctly
        $status_db = 0;
        header('Refresh: 0; URL=index.php?deleted=application&status=' . $status_db);
    }

}

?>