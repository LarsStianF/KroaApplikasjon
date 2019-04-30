// Volunteers search div filtering
$(document).ready(function(){
    $("#peopleSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#namerow .filterSearch").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});





/******fetch_people_data.php*******
 * Governs the hiding/showing of  *
 * confirm/decline buttons,       *
 * collapsable content, dropdown  *
 * content ++                     *
 **********************************/



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

    $(".manCheckbox").click(function(){
        $("#manConfirmation").collapse('hide');
    });

});
