$(document).ready(function(){
    $("a.mainnav").click(function(){
        $("a.mainnav").removeClass("active");
        $(".subhide").removeClass("subshow");
        $(this).addClass("active");

        if ($(this).is("#homenav")) {
            $("#homenavsub").addClass("subshow");
        }

        if ($(this).is("#eventnav")) {
            $("#eventnavsub").addClass("subshow");
        }

        if ($(this).is("#peoplenav")) {
            $("#peoplenavsub").addClass("subshow");
        }
        else {

        }
    });
});