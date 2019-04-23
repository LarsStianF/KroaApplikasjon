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
                    <h5> ';
echo $output;
$output = "";

    $output = manager_check($row, $id, $output).
                        '</h5>
                         <hr>';
                    
                        
                        



    if($row['Unit'] > 0){

        $output.=

            '
                                
                                <form method="POST" action="update_handler.php?object=people&name=submit&id='.$id.'">
                                <div class="d-flex justify-content-around">
                                <h4>User role : </h4>
                               <div class="input-group-append ml-2 form-inline">
                               
                                 <div class="form-group">
                                     
                                        <select class="form-control" id="selRole">
                                             <option value="Volunteer">Volunteer</option>
                                                 <option value="Manager">Manager</option>
                                                 <option value="Volunteer Coordinator">Volunteer Coordinator</option>
                                               <option value="Event Manager">Event Manager</option>
                                               <option value="Daglig Leder">Daglig Leder</option>
                                                 </select>
                                                </div>
                                 
                                 <a class="btn btn-primary" id="numUnitsBtn" href="#unitConfimation" role="button">Change</a>
                                </div>
                               
                         </div>
                         
                          <div class="collapse" id="unitConfirmation">
                        <hr>
                        <h4>Change role of ' .$row['Firstname'] . ' ' . $row['Lastname'] . '  from ROLE to <span id="newRole"></span>?</h4>
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
                         <form method="POST" action="update_handler.php?object=unitlist&name=submit&id='.$id.'">
                        <div class="d-flex justify-content-around">
                                <h4>Units to add: </h4>
                               <div class="input-group-append ml-2 form-inline"> 
                               
                               
                                 <input type="number" id="numUnitsAdd" class="form-control" name="unitAdd" value="1" min="1" max="99">
                                 
                                 <a class="btn btn-primary" id="selRoleBtn"  href="#unitConfimationAdd" role="button">Add</a>
                              
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

<script>
    $(function(){
        $('#selRole').change(function () {
            var role = $(this).find("option:selected").text();
            $("#newRole").text(role);
        });
    });

    $(function(){
        $('#numUnitsBtnAdd').click(function () {
            var units = $('#numUnitsAdd').val();
            $('#confNumUnitsAdd').html(units);
        });
    });

    $(document).ready(function(){

        $("#numUnitsBtnAdd").click(function(){
            $("#unitConfirmationAdd").collapse('show');
            $("#unitConfirmation").collapse('hide');
        });

        $("#numUnitsBtn").click(function(){
            $("#unitConfirmation").collapse('show');
            $("#unitConfirmationAdd").collapse('hide');
        });

    });

</script>
