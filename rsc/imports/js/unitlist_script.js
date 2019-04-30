
// Div filtering for unitlist search.
$(document).ready(function(){
    $("#unitSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#namerow a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


/******fetch_unitlist_data.php*****
 * Governs the hiding/showing of  *
 * confirm/decline buttons        *
 **********************************/


$(function(){
    $('#numUnitsBtn').click(function () {
        var units = $('#numUnits').val();
        $('#confNumUnits').html(units);
    });
});

$(function(){
    $('#numUnitsBtnAdd').click(function () {
        var units = $('#numUnitsAdd').val();
        $('#confNumUnitsAdd').html(units);
    });
});

$(document).ready(function(){

    $('#numUnits').change(function () {
        $("#unitConfirmation").collapse('hide');
    });

    $('#numUnitsAdd').change(function () {
        $("#unitConfirmationAdd").collapse('hide');
    });

    $("#numUnitsBtnAdd").click(function(){
        $("#unitConfirmationAdd").collapse('show');
        $("#unitConfirmation").collapse('hide');
    });

    $("#numUnitsBtn").click(function(){
        $("#unitConfirmation").collapse('show');
        $("#unitConfirmationAdd").collapse('hide');
    });

});