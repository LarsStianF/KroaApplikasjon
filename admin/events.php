<?php
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'dbcon.php';
include 'rsc/imports/modals/event_modal.php';


?>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->
    <main class="container">



            <div class="row pt-3">
                <?php
                $query = "SELECT * FROM event ORDER BY Date DESC, ID DESC;";
                $result = mysqli_query($con, $query);
                $count = 1;
                $numrow = mysqli_num_rows($result);


                while ($row = mysqli_fetch_array($result)) {


                    echo  '<div class=" card card-custom justify-content mx-2 mb-3 border-light">';

                    echo   '<div class="card-img-caption">';
                    echo        '<p class="card-text-top">'.$row['Name'].'</p>';
                    echo        '<p class="card-text-bottom">'.$row['Date'].'</p>';
                    echo        '<img class="card-img-top" src="../rsc/img/eventbackground.png" alt="">';
                    echo   '</div>';
                    echo   '<div class="card-body d-flex flex-column">';
                    echo        '<div class="text-center">';
                    echo            '<p class="card-text">'.$row['Event_text'].'</p>';
                    echo        '</div>';
                    echo        '<ul class="list-group-flush  volunteers_list">';
                    echo            '<li class="list-group-item volunteers_item"><p>6/10</p><img class="man-icon" src="../rsc/img/man_black.png" alt=""></li>';
                    echo            '<li class="list-group-item volunteers_item"><p>6/10</p><img class="man-icon" src="../rsc/img/man_red.png" alt=""></li>';
                    echo            '<li class="list-group-item volunteers_item"><p>6/10</p><img class="man-icon" src="../rsc/img/man_blue.png" alt=""></li>';
                    echo            '<li class="list-group-item volunteers_item"><p>6/10</p><img class="man-icon" src="../rsc/img/man_black.png" alt=""></li>';
                    echo        '</ul>';
                    echo    '<a href="#eventModal" value="view" type="button" name="view" class="btn btn-primary btn-small border-dark m-2 view_data" id="'.$row['ID'].'" data-toggle="modal" >Details</a>';
                    echo   '</div>';
                    echo  '</div>';


                    if ($count % 3 == 0) {
                        echo '</div>';
                        if ($count == $numrow) {

                        } else {
                            echo '<div class="row pt-3">';
                        }



                    }
                    $count++;
                }


                ?>
                <script>
                    $(document).ready(function () {
                        $('.view_data').click(function () {
                            var id = $(this).attr('id');

                            $.ajax({
                                url: "fetch_data.php",
                                method: "post",
                                data: {id:id},
                                success:function (data) {
                                    $('#event_detail').html(data);
                                    $('#eventModal').modal("show");
                                }
                            });


                        });
                    });
                </script>


    </main>


    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
    ##################################################################################
    -->

<?php include '../rsc/imports/php/components/footer.php'; ?>