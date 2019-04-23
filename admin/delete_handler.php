<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';

// checks of object is set.
if(isset($_GET['delete'])) {

    // checks if the object is new event
    if ($_GET['delete'] == 'event') {
        $object = $_GET['delete'];
        $id = $_GET['id'];

        delete_event($id);
    }
}

?>