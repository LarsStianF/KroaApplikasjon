<?php

include '../../admin/dbcon.php';

if(isset($_POST['submit_user'])) {


    $fname      = mysqli_real_escape_string($con, $_POST['fornavn']);
    $lname      = mysqli_real_escape_string($con, $_POST['etternavn']);
    $email      = mysqli_real_escape_string($con, $_POST['email']);
    $passw      = mysqli_real_escape_string($con, $_POST['pass']);
    $phone      = mysqli_real_escape_string($con, $_POST['phone']);


    if (empty($fname) || empty($lname) ||  empty($email) || empty($passw) || empty($phone)) {
        header("Location: ../../index.php");
        exit();

    } elseif (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
        header("Location: ../../index.php?signup=invalid");
        exit();

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../index.php?signup=email");
        exit();

    } else {

        $sql = "SELECT * FROM frivillig WHERE Email ='$email'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);


        if ($resultCheck > 0) {
            header("Location: ../../index.php?signup=usertaken");
            exit();
        } else {

            // password hash
            $pwhash = md5($_POST['pass']);

            $sqql = "INSERT INTO `frivillig`(Fornavn, Etternavn, TlfNr, Email, Passord, Enhet)
                     VALUES ('$fname', '$lname', '$phone', '$email', '$pwhash', 0);";
        }
    }
    if (mysqli_query($con, $sqql)) {

        echo "<div style='text-align: center;'><h1 style='color: black'>User creation successful!</h1></div>";
        header("Refresh:3; url=../../index.php");
    } else {
        die("Error: " . mysqli_sqlstate($con));
    }

    mysqli_close($con);

} else {


    exit();
}

?>