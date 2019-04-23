$(document).ready(function () {



    $('.view_data').click(function () {
        var id = $(this).attr('id');

        $.ajax({
            url: "fetch_people_data.php",
            method: "post",
            data: {id:id},
            success:function (data) {
                $('#peopleDetail').html(data);
                $('#peopleModal').modal("show");
            }
        });
    });
});
