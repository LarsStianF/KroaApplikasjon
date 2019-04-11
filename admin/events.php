<?php
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'dbcon.php';
include 'rsc/imports/modals/event_modal.php';
include '../rsc/imports/php/functions/functions.php';
?>

    <main>

        <?php

        $sql = 'SELECT * FROM event ORDER BY Date ASC, Time_Start ASC';
        $result = mysqli_query($con, $sql);
        $numrow = mysqli_num_rows($result);
        $counter = 1;
        echo '<section class="container pt-2">';
        echo '<div class="row mt-5 ">';
        while ( $row = mysqli_fetch_array( $result ) ){

            // Gets date
            $id = $row['ID'];
            $d = new DateTime($row['Date']);
            $date = $d->format('F jS o');

            // Gets time
            $sTime = new DateTime($row['Time_Start']);
            $eTime = new DateTime($row['Time_End']);
            $startTime = $sTime->format('H:i');
            $endTime = $eTime->format('H:i');

            echo '<div class="card card-custom mx-2 mb-4 border-dark">';
            echo '<div class="card-img-caption">';
            echo '<p class="card-text-top">'.$row['Name'].'</p>';
            echo '<p class="card-text-bottom">'.$date.'</p>';
            echo '<img class="card-img-top" src="../rsc/img/eventbackground.png" alt="">';
            echo '</div>';
            echo '<div class="card-body d-flex flex-column">';
            echo '<h5 class="card-title text-center">';
            echo $startTime . ' - ' . $endTime;
            echo '</h5>';
            get_event_volunteers($id);
            echo '<p class="card-text text-center">';
            echo $row['Event_text'];
            echo '</p>';
            echo '<a href="#eventModal" value="view" type="button" name="view" class="btn btn-primary btn-small border-dark m-2 view_data" id="'.$id.'" data-toggle="modal" >Details</a>';
            echo '</div>';
            echo '</div>';


            if ($counter % 3 == 0) {

                if ($counter == $numrow) {
                    echo '</div>';
                    echo '</section>';
                } else {

                }

            }
            $counter++;
        }

        ?>
        <script>


            $(document).ready(function () {

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

        </script>

    </main>

<?php include '../rsc/imports/php/components/footer.php'; ?>