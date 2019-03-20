<?php

function PwCheck ($myemail, $pwhash)
{
global $con;
$sql = "SELECT Password FROM volunteer WHERE Email = '$myemail'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
echo $pwhash ,  "|";
    echo $row['Password'];
if ($pwhash == $row['Password']) {
return true;
} else {
return false;
}

}
?>