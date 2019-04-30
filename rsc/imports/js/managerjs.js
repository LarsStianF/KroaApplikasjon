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

});