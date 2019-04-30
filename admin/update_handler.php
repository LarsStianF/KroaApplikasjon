<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}
include 'rsc/imports/php/functions/functions.php';

// Check if there is something to update:
if (isset($_GET['object'])){


    // Check if object is unitlist:
    if ($_GET['object'] == 'unitlist'){

        $object = 'unitlist';


        //get variables
        $vol_id = $_GET['id'];
        // Function redirects

        volUnitUpdate($vol_id);
    }
    // check if object is event
    if ($_GET['object'] == 'event') {

        $object = $_GET['object'];

        //get variables
        $name_attribute = $_GET['name'];
        $id = $_GET['id'];

        edit_event($id, $name_attribute);

    }

    // check if object is people
    if ($_GET['object'] == 'people') {

        $object = $_GET['object'];

        //get variable
        $id = $_GET['id'];

        admin_set_user_role($id);

    }

    // check if object is application
    if ($_GET['object'] == 'application') {

        $user_list = $_POST['user_list'];
        $event_id = mysqli_real_escape_string($con, $_GET['id']);
        $job = mysqli_real_escape_string($con, $_GET['job']);
        foreach ($user_list as $user) {

            add_volunteer_to_event($user, $event_id, $job,0);
        }



    }


}