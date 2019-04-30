<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}
include 'rsc/imports/php/functions/functions.php';

// checks of object is set.
if(isset($_GET['delete'])) {

    // checks if the object is new event
    if ($_GET['delete'] == 'event') {
        $object = mysqli_real_escape_string($con, $_GET['delete']);
        $id = mysqli_real_escape_string($con, $_GET['id']);

        delete_event($id);
    }
    if ($_GET['delete'] == 'application') {
        $man = mysqli_real_escape_string($con, $_GET['manager']);
        $object = mysqli_real_escape_string($con, $_GET['delete']);
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $job_id = mysqli_real_escape_string($con, $_GET['job']);
        $user_id = mysqli_real_escape_string($con, $_SESSION['login_id']);

        if($man == 1) {
            remove_from_event_volunteer($user_id, $id);
        }
        if($man == 0){
            remove_from_want_volunteer($id, $job_id, $user_id);
        }

    }
}

?>