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
                    
                        
                        





        $output.=

            '
                                
                                <form method="POST" action="update_handler.php?object=people&name=submit&id='.$id.'">
                                <div class="d-flex justify-content-around">
                                <h4>User role : </h4>
                               <div class="input-group-append ml-2 form-inline">
                               
                                 <div class="form-group">
                                     
                                        '.populate_people_edit_user_type($id, $row).'
                                                </div>
                                 
                                 <a class="btn btn-primary d-none" id="roleBtn" href="#roleConfimation" role="button">Change</a>
                                </div>
                               
                         </div>
                         
                          <div class="collapse" id="roleConfirmation">
                        <hr>
                        <h4>Change role of ' .$row['Firstname'] . ' ' . $row['Lastname'] . '  from <span class="text-danger">'.get_volunteer_user_type($id).' </span>to <span id="newRole" class="text-success"></span>?</h4>
                        <button class="btn btn-success fa fa-check fa-3x" type="submit"></button>
                        </form>
                        <a class="btn btn-danger text-white fa fa-ban fa-3x ml-5" data-toggle="collapse" data-target="#roleConfirmation"></a>

                        </div>
                        
                        
                       
                        ';





    $bar = 1; $sec = 2; $crew = 3; $tech = 4;



    $output.=
        '
                        <div id="managerShow" class="collapse">
                        <hr> 
                         <form method="POST" action="update_handler.php?object=unitlist&name=submit&id='.$id.'">
                        <div class="d-flex justify-content-around">
                                <h5>Manager of: </h5>
                               <div class="checkbox"> 
                               
                                
                                <label><input type="checkbox" value="Bar" '.populate_user_edit_crew_checkbox($id, $bar).'>Bar</label>
                                <label><input type="checkbox" value="Security" '.populate_user_edit_crew_checkbox($id, $sec).'>Security</label>
                                <label><input type="checkbox" value="Crew" '.populate_user_edit_crew_checkbox($id, $crew).'>Crew</label>
                                <label><input type="checkbox" value="Technical" '.populate_user_edit_crew_checkbox($id, $tech).'>Technical</label>
                                 
                                 <a class="btn btn-primary" id="manRoleBtn"  href="#manConfimation" role="button">Update</a>
                              
                               </div>
                         </div>
                         
                          <div class="collapse" id="manConfirmation">
                        <hr>
                        <h4>Set managing role of ' .$row['Firstname'] . ' ' . $row['Lastname'] . ' to: <span id="manCrewList"></span>?</h4>
                        <button class="btn btn-success fa fa-check fa-3x" type="submit"></button>
                        </form>
                        <a class="btn btn-danger text-white fa fa-ban fa-3x ml-5" data-toggle="collapse" data-target="#manConfirmation"></a>

                        </div>
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





    //prepares and executes display of collapsable content and hiding of buttons
    $(document).ready(function(){
        var cur_role = $(this).find('option:selected').text();
        var manager = "Manager";

        //Shows the manager selectables if the role is manager upon loading the page
        if (cur_role === manager){
            $("#managerShow").collapse('show');
        }
        $('#selRole').change(function () {

            //sets the name of the role in which to change to
            $("#roleConfirmation").collapse('hide');
            var role = $(this).find("option:selected").text();
            $("#newRole").text(role);

            //Hides the change button if the selected role is the same as the selected user currently has
            if ($(this).find('option:selected').text() === cur_role && cur_role !== manager){
                $("#roleBtn").addClass('d-none');
                $("#managerShow").collapse('hide');
                //Checks if the selected role is manager, if so hides the button and shows the selectables
            }else if ($(this).find('option:selected').text() === manager){
                $("#managerShow").collapse('show');
                $("#roleBtn").addClass('d-none');

                //hides the selectables and shows the change button if the above statements are not true.
            }else {
                $("#managerShow").collapse('hide');
                $("#roleBtn").removeClass('d-none');
            }

        });
    });

    // Governs hiding and showing content of manager collapsable content
    $(document).ready(function(){

        $("#manRoleBtn").click(function(){
            //Upon click hides the role confirmation content
            $("#roleConfirmation").collapse('hide');

            // Fills in what manager roles have been selected in confirmation box
            var checkValue = $(".checkbox input:checkbox:checked").map(function(){
                return $(this).val();
            }).toArray().join(", ");
            $('#manCrewList').html(checkValue);


            // Prevents opening of confirmation collapsable if no manager roles have been selected.
            if(checkValue.length === 0) {
                $("#manConfirmation").collapse('hide');
            }
            else{
                $("#manConfirmation").collapse('show');
            }


        });

        $("#roleBtn").click(function(){
            $("#roleConfirmation").collapse('show');
            $("#manConfirmation").collapse('hide');
        });

    });

</script>
