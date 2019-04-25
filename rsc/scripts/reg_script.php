<?php

include '../../admin/dbcon.php';

if(isset($_POST['submit_user'])) {


    $fname      = mysqli_real_escape_string($con, $_POST['firstname']);
    $lname      = mysqli_real_escape_string($con, $_POST['lastname']);
    $email      = mysqli_real_escape_string($con, $_POST['email']);
    $passw      = mysqli_real_escape_string($con, $_POST['password']);
    $phone      = mysqli_real_escape_string($con, $_POST['telephone']);


    if (!preg_match("/^[a-zA-Z]*$/", $fname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
        header("Location: ../../index.php?signup=invalid");
        exit();

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../../index.php?signup=email");
        exit();

    } else {

        $sql = "SELECT * FROM volunteer WHERE Email ='$email'";
        $result = mysqli_query($con, $sql);
        $resultCheck = mysqli_num_rows($result);


        if ($resultCheck > 0) {
            header("Location: ../../index.php?signup=usertaken");
            exit();
        } else {

            // password hash
            $pwhash = md5($_POST['password']);

            $sqql = "INSERT INTO volunteer (Firstname, Lastname, nr, Email, Password, Unit, user_type)
                     VALUES ('$fname', '$lname', '$phone', '$email', '$pwhash', 0, 6);";
        }
    }
    if (mysqli_query($con, $sqql)) {


        header("Refresh:0; url=../../index.php?signup=success");
    } else {
        die("Error: " . mysqli_sqlstate($con));
    }

    mysqli_close($con);

} else {

    exit();
}

?>