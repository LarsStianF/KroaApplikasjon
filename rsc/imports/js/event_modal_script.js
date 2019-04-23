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
            success:function (data1) {
                $('#event_detail').html(data1);
                $('#eventModal').modal("show");
            }
        });
    });
    $('.view_delete_data').click(function () {
        var id = $(this).attr('id');

        $.ajax({
            url: "fetch_del_data.php",
            method: "post",
            data: {id:id},
            success:function (data) {
                $('#event_delete_detail').html(data);
                $('#delEventModal').modal("show");
            }
        });
    });
    $('.view_edit_data').click(function () {
        var id = $(this).attr('id');

        $.ajax({
            url: "fetch_edit_data.php",
            method: "post",
            data: {id:id},
            success:function (data) {
                $('#event_edit_detail').html(data);
                $('#editEventModal').modal("show");
            }
        });
    });
});
