<?php
include 'dbcon.php';
include 'rsc/imports/php/functions/functions.php';


if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($con,$id);

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
                    
                        
                        
                        ';


            if($row['Unit'] > 0){

    $output.=

                                '
                                
                                <form method="POST" action="update_handler.php?object=unitlist&name=submit&id='.$id.'">
                                <div class="d-flex justify-content-around">
                                <h4>Units to take out: </h4>
                               <div class="input-group-append ml-2 form-inline">
                               
                                 <input type="number" id="numUnits" class="form-control" name="unitRemove" value="1" min="1" max="'.$row['Unit'].'">
                                 
                                 <a class="btn btn-primary" id="numUnitsBtn" href="#unitConfimation" role="button">Remove</a>
                                </div>
                               
                         </div>
                         
                          <div class="collapse" id="unitConfirmation">
                        <hr>
                        <h4>Remove <span id="confNumUnits"> </span> units from ' .$row['Firstname'] . ' ' . $row['Lastname'] . '?</h4>
                        <button class="btn btn-success fa fa-check fa-3x" type="submit"></button>
                        </form>
                        <a class="btn btn-danger text-white fa fa-ban fa-3x ml-5" data-toggle="collapse" data-target="#unitConfirmation"></a>

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



            // Make this only visable to Bar-ansvarlig

    $output.=
                        '
                        <hr> 
                         <form method="POST" action="update_handler.php?object=unitlist&id='.$id.'">
                        <div class="d-flex justify-content-around">
                                <h4>Units to add: </h4>
                               <div class="input-group-append ml-2 form-inline"> 
                               
                               
                                 <input type="number" id="numUnitsAdd" class="form-control" name="unitAdd" value="1" min="1" max="99">
                                 
                                 <a class="btn btn-primary" id="numUnitsBtnAdd"  href="#unitConfimationAdd" role="button">Add</a>
                              
                               </div>
                         </div>
                         
                          <div class="collapse" id="unitConfirmationAdd">
                        <hr>
                        <h4>Add <span id="confNumUnitsAdd"> </span> units to ' .$row['Firstname'] . ' ' . $row['Lastname'] . '?</h4>
                        <button class="btn btn-success fa fa-check fa-3x" type="submit"></button>
                        </form>
                        <a class="btn btn-danger text-white fa fa-ban fa-3x ml-5" data-toggle="collapse" data-target="#unitConfirmationAdd"></a>

                        </div>
                         
                         
                        
                        
                        ';


    $output.=
        '  
                         </div>
                         </div>
  
                       

            ';

            // If not bar-ansvarlig, this is visable

    echo $output;


}
?>

<script src="../rsc/imports/js/unitlist_script.js">
</script>
