
<?php

require_once ("../../admin/dbcon.php");
require("../../admin/rsc/imports/php/functions/functions.php");


if($_SERVER["REQUEST_METHOD"] == "POST") {


    $login_email = mysqli_real_escape_string($con,$_POST['login_email']);
    $login_password = mysqli_real_escape_string($con,$_POST['login_password']);

    $pwhash = md5($login_password);
    $pwverify = PwCheck($login_email, $pwhash);


    if ($pwverify == true) {

        $sql = "SELECT ID FROM volunteer WHERE Email = '$login_email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        echo $count;


        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {

            $sql = "SELECT * FROM volunteer WHERE Email = '$login_email'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $myid = $row['ID'];
            $myfullname = $row['Firstname'] . " " . $row['Lastname'] ;
            $myunits = $row['Unit'];
            $mytel = $row['nr'];
            $myuser_type = $row['user_type'];


            $_SESSION['login'] = true;
            $_SESSION['login_id'] = $myid;
            $_SESSION['login_email'] = $login_email;
            $_SESSION['login_name'] = $myfullname;
            $_SESSION['login_phone'] = $mytel;
            $_SESSION['login_type'] = $myuser_type;
            $_SESSION['login_unit'] = $myunits;



            header('Refresh: 0; URL=../../admin/index.php');




        } else {
            $error = "Your Login Name or Password is invalid!";
            echo "<div style='text-align: center;'><h1 style='color: black'>{$error}</h1></div>";
         //   header('Refresh: 3; URL=../../index.php');
        }
    }
    else {
        $error = "Your Login Name or Password is invalid!";
        echo "<div style='text-align: center;'><h1 style='color: black'>{$error}</h1></div>";
       // header('Refresh: 3; URL=../../index.php');
    }
}

?>
