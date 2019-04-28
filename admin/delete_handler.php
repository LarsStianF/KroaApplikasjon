<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';

// checks of object is set.
if(isset($_GET['delete'])) {

    // checks if the object is new event
    if ($_GET['delete'] == 'event') {
        $object = mysqli_real_escape_string($con, $_GET['delete']);
        $id = mysqli_real_escape_string($con, $_GET['id']);

        delete_event($id);
    }
}

?>