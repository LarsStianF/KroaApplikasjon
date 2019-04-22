$(document).ready(function () {



    $('.view_data').click(function () {
        var id = $(this).attr('id');

        $.ajax({
            url: "fetch_unitlist_data.php",
            method: "post",
            data: {id:id},
            success:function (data) {
                $('#unitlistDetail').html(data);
                $('#unitlistModal').modal("show");
            }
        });
    });
});
