$(document).ready(function(){

    // Hides the toggleable divs upon load, but shows the default manager pane if possible
    $(".filter").hide();
    $(".Manager").show();

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');

        if(value === "all")
        {
            $('.filter').show('1000');
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');

        }
    });


    $('.newlog').click(function () {
        $('#newLogModal').modal("show");

    });

    $('.newlog').click(function () {
         var id = $(this).attr('name');
        $.ajax({
            url: "fetch_log_data.php",
            method: "post",
            data: {id:id},
            success:function (data) {
                $('#log_edit_detail').html(data);
                $('#newLogModal').modal("show");
            }
        });
    });

});


$(function() {

    $(".search_button").click(function() {
        // get search value
        var searchValue    = $("#logSearch").val();
        var dataSearch            = 'logSearch='+ searchValue;

        // If there is something to search
        if(searchValue) {
            $.ajax({
                type: "POST",
                url: "fetch_log_search_data.php",
                data: dataSearch,
                // clears the pre-existing results upon new search
                beforeSend: function(html) {
                    $("#results").html('');
                    $("#searchresults").show();
                    $(".word").html(searchValue);
                },
                // shows search results
                success: function(html){
                    $("#results").show();
                    $("#results").append(html);
                }
            });
        }
        return false;
    });
});



