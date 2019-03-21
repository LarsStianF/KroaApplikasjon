$(document).ready(function(){
    $("#loginbtn").click(function(){
        $("#welcomediv").fadeOut(1);
        $("#logindiv").fadeIn(1);
    });
    $(".abortbtn").click(function(){
        $("#logindiv").fadeOut(1);
        $("#registerdiv").fadeOut(1);
        $("#welcomediv").fadeIn(1);

    });
    $("#registerbtn").click(function(){
        $("#welcomediv").fadeOut(1);
        $("#registerdiv").fadeIn(1);

    });
});