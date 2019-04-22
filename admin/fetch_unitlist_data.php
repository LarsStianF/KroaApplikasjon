<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';


if(isset($_POST['id']))
{
    $id = $_POST['id'];

    $query = "SELECT * FROM volunteer WHERE ID = '".$id."'";
    $result =  mysqli_query($con, $query);

    $row = mysqli_fetch_array($result);


    $output = '
            <div class="text-center">
                <h1>' .$row['Firstname'] . ' ' . $row['Lastname'] . '</h1> 
                <hr class="mt-1">
                <div class="inline">
                    <h3> Current units: '.$row['Unit'].'</h3>
                    <hr>
                    
                        <form method="POST" action="update_handler.php?object=unitlist&name=submit&id='.$id.'">
                        
                        ';


            if($row['Unit'] > 0){

    $output.=

                                '
                                <div class="d-flex justify-content-center">
                                <h4>Units to take out: </h4>
                               <div class="input-group-append ml-2 form-inline"> 
                                 <input type="number" id="numUnits" class="form-control" name="unitRemove" value="1" min="1" max="'.$row['Unit'].'">
                                 
                                 <a class="btn btn-primary" id="numUnitsBtn" data-toggle="collapse" data-target="#unitConfirmation" href="#unitConfimation" role="button" aria-expanded="false" aria-controls="unitConfirmation">Accept</a>
                               </div>
                         </div>
                        
                        
                       
                        ';
} else{


    $output.=
                       '
                        <div class="bg-danger">
                        <h4> This person cannot take out any more units</h4>
                        </div>
                        </div>';
            }


    $output.=
                       '  

  
                        <div class="collapse" id="unitConfirmation">
                        <hr>
                        <h4>Remove <span id="confNumUnits"> </span> units from ' .$row['Firstname'] . ' ' . $row['Lastname'] . '</h4>
                        <button class="btn btn-success" type="submit">Accept</button>
                        </form>
                        <button class="btn btn-danger" data-toggle="collapse" data-target="#unitConfirmation">Cancel</button>

</div>

            ';

    echo $output;


}
?>

<script>
    $(function(){
        $('#numUnitsBtn').click(function () {
    var units = $('#numUnits').val();
    $('#confNumUnits').html(units);
    });
    });
</script>
