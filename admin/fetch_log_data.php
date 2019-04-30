<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../login.php");
    exit();
}

include 'rsc/imports/php/functions/functions.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $crew_id = mysqli_real_escape_string($con,$id);
    $id = mysqli_real_escape_string($con,$id);
    header('Refresh: 0; URL=index.php');

    $query = "
   SELECT * FROM event WHERE ID NOT IN (SELECT event_ID FROM logs WHERE logs.crew_type_ID = '".$id."')
    
        ";
    $result =  mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    // get fix date
    $d = new DateTime($row['Date']);
    $date = $d->format('F jS o');
    $event_id = $row['ID'];

    $output = '
    <form method="POST" action="create_handler.php?object=log&name=submit&event_id='.$event_id.'&id='.$id.'" enctype="multipart/form-data">

    <!-- Event name: -->
    <div class="form-group">
        
        <label>Event name</label>
        <select name="">
        ';

while ($row = mysqli_fetch_array($result)) {
    $output .= '
        <option name="log_event_name" class="form-control form-text" value="' . $row['ID'] . '">' . $row['Name'] .' - '. $date.'</option>
      
      
      ';
}
      $output.= '
        </select>
    </div>
    <!-- log text: -->
    <div class="form-group mt-4">
        <label>Log text</label>
        <textarea name="log_text" class="form-control" maxlength="255" style="height: 80px" placeholder="Write your log here..."></textarea>
    </div>

    <div class="form-group mt-2">
        <button type="submit" class="btn btn-success" name="submit">Submit log</button>
    </div>


</form>
           ';

    echo $output;
}
?>
