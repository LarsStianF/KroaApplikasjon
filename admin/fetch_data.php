<?php
include 'dbcon.php';

if(isset($_POST['id']))
{
    $output = "";
    $query = "SELECT * FROM event WHERE ID = '".$_POST["id"]."'";
    $result =  mysqli_query($con, $query);
    $output .= '
    <div class="table-responsive">
        <table class="table table-bordered">';
        while($row = mysqli_fetch_array($result)) {
            $output .= '
                <tr>
                <td><label>Event name</label></td>
                <td>'.$row['Name'].'</td>
                </tr>
                
                <tr>
                <td><label>Event date</label></td>
                <td>'.$row['Date'].'</td>
                </tr>
                
                <tr>
                <td><label>Event start</label></td>
                <td>'.$row['Time_Start'].'</td>
                </tr>
                
                <tr>
                <td><label>Event end</label></td>
                <td>'.$row['Time_End'].'</td>
                </tr>
            ';
        }
        $output .= "</table></div>";
        echo $output;

}
?>