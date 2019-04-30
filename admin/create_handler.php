<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}
include 'rsc/imports/php/functions/functions.php';

// checks of object is set.
if(isset($_GET['object'])) {

    // checks if the object is new event
    if ($_GET['object'] == 'newevent') {
        $object = mysqli_real_escape_string($con, $_GET['object']);
        $name_attribute = mysqli_real_escape_string($con, $_GET['name']);

        create_new_event($name_attribute);
    }

    if ($_GET['object'] == 'application') {
        $man = mysqli_real_escape_string($con, $_GET['manager']);
        $sign_job = mysqli_real_escape_string($con, $_GET['job']);
        $event_id = mysqli_real_escape_string($con,$_GET['id']);
        $vol_id = mysqli_real_escape_string($con,$_SESSION['login_id']);

        if($man == 1) {
            //add as manager
            add_volunteer_to_event($vol_id, $event_id, $sign_job, $man);
        } if($man == 0) {
            // add as volunteer
            add_to_want_volunteer($sign_job, $event_id, $vol_id);
        }


    }

    if ($_GET['object'] == 'log') {
        $object = mysqli_real_escape_string($con, $_GET['object']);
        $crew_id = mysqli_real_escape_string($con, $_GET['id']);
        $event_id = mysqli_real_escape_string($con, $_GET['event_id']);
        $name_attribute = mysqli_real_escape_string($con, $_GET['name']);

        create_new_log($crew_id, $event_id, $name_attribute);
    }
}

?>