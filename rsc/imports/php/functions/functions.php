<?php

function PwCheck ($myemail, $pwhash)
{
global $con;
$sql = "SELECT Passord FROM frivillig WHERE Email = '$myemail'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
echo $pwhash ,  "|";
    echo $row['Passord'];
if ($pwhash == $row['Passord']) {
return true;
} else {
return false;
}

}
?>