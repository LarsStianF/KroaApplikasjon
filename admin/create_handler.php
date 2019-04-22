<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';

// checks of object is set.
if(isset($_GET['object'])) {

    // checks if the object is new event
    if ($_GET['object'] == 'newevent') {
        $object = $_GET['object'];
        $name_attribute = $_GET['name'];

        create_new_event($name_attribute);
    }

    if ($_GET['object'] == '') {

    }
}

?>