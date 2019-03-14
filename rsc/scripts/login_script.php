
<?php

require_once ("../../admin/dbcon.php");
require("../imports/php/functions/functions.php");


if($_SERVER["REQUEST_METHOD"] == "POST") {


    $login_email = mysqli_real_escape_string($con,$_POST['login_email']);
    $login_password = mysqli_real_escape_string($con,$_POST['login_password']);

    $pwhash = md5($login_password);
    $pwverify = PwCheck($login_email, $pwhash);


    if ($pwverify == true) {

        $sql = "SELECT ID FROM frivillig WHERE Email = '$login_email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        echo $count;


        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {

            $sql = "SELECT * FROM frivillig WHERE Email = '$myemail'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($result);

            $myfullname = $row['Fornavn'] . " " . $row['Etternavn'] ;
            $myenhet = $row['Enhet'];
            $myphone = $row['TlfNr'];
            $myid = $row['ID'];


            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $myid;
            $_SESSION['login_email'] = $myemail;
            $_SESSION['login_name'] = $myfullname;
            $_SESSION['user_phone'] = $myphone;



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
