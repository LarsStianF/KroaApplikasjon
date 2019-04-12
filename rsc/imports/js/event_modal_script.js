$(document).ready(function () {

    $('#newevent').click(function () {
        $('#newmodal').modal("show");

    });

    $('.view_data').click(function () {
        var id = $(this).attr('id');

        $.ajax({
            url: "fetch_modal_data.php",
            method: "post",
            data: {id:id},
            success:function (data) {
                $('#event_detail').html(data);
                $('#eventModal').modal("show");
            }
        });
    });
});
