<?php
include 'dbcon.php';
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
        $sign_job = mysqli_real_escape_string($con, $_GET['job']);
        $event_id = mysqli_real_escape_string($con,$_GET['id']);
        $vol_id = mysqli_real_escape_string($con,$_SESSION['login_id']);

        add_to_want_volunteer($sign_job, $event_id, $vol_id);
    }
}

?>