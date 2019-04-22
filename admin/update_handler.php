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

}