<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';


if(isset($_REQUEST['term']))
{
    $output = "";
    if(isset($_REQUEST["term"])) {
        $sql = 'SELECT * FROM volunteer WHERE Firstname LIKE ?';

        if ($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_term);
            $param_term = $_REQUEST["term"] . '%';

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {

    $output .= ' <div class="list-group">';

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $output .= '
                
                <a href="#url1" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                <h2 class="mb-1">' . $row['Firstname'] . ' ' . $row['Lastname'] . '</h2>
                <h2 class="mb-1" >'
             if ($row['Unit'] > 0) {
                 echo '<span class="badge badge-success"> Units: ';
             } else {
                 echo '<span class="badge badge-danger"> Units: ';
             }

       $output .= $row['Unit'] .  '
                </span> </h2>
                </div>   
                </a>                     
               ';
    }
                } else{
                    echo "<p>No matches found</p>";
                }
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($con);

    $output .= "</div>";
    echo $output;

}
?>