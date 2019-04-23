<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';

// Check if there is something to update:
if (isset($_GET['object'])){


    // Check if object is unitlist:
    if ($_GET['object'] == 'unitlist'){

        $object = 'unitlist';


        //get variables
        $vol_id = $_GET['id'];
        $name = $_GET['name'];
        // Function redirects

        volUnitUpdate($vol_id, $name);
    }
    // check if object is event
    if ($_GET['object'] == 'event') {

        $object = $_GET['object'];

        //get variables
        $name_attribute = $_GET['name'];
        $id = $_GET['id'];

        edit_event($id, $name_attribute);

    }

}