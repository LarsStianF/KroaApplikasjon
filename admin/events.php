<?php
include 'dbcon.php';
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'rsc/imports/modals/event_modal.php';
include 'rsc/imports/modals/new_event_modal.php';
include 'rsc/imports/php/functions/functions.php';
?>

    <main class="container">

            <div class="bg-light p-3 m-0 card" >
                <h1 class="display-3 text-center"> Event Page </h1>
                <div>
                    <a href="#newmodal" class="btn btn-dark" id="newevent" data-toggle="modal" >New Event</a>
                </div>

            </div>


        <?php

        $sql = 'SELECT * FROM event ORDER BY Date ASC, Time_Start ASC';
        $result = mysqli_query($con, $sql);
        $numrow = mysqli_num_rows($result);
        $counter = 1;

        // Starts output
        $output = '<section class="container pt-1">
                    <div class="row">
                    ';


        while ( $row = mysqli_fetch_array( $result ) ) {

            //fix event substring
            $event_text = substr($row['Event_text'], 0, 40).'..';


            // Gets date
            $id = $row['ID'];
            $d = new DateTime($row['Date']);
            $date = $d->format('F jS o');

            // Gets time
            $sTime = new DateTime($row['Time_Start']);
            $eTime = new DateTime($row['Time_End']);
            $startTime = $sTime->format('H:i');
            $endTime = $eTime->format('H:i');

            // get event volunteers
            $volunteers = get_event_volunteers($id);
            $bar        = $volunteers[0];
            $security   = $volunteers[1];
            $crew       = $volunteers[2];
            $technical  = $volunteers[3];

            $output .= '
                <div class="card card-custom border-light ml-2">
                    <div class="card-img-caption">
                    <p class="card-text-top">'.$row['Name'].'</p>
                    <p class="card-text-bottom">'.$date.'</p>
                    <img class="card-img-top" src="../rsc/img/eventbackground.png" alt="">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">'.$startTime.' - ' . $endTime.'</h5>
                    <ul class="list-group list-group-flush volunteers_list ml-5">
                        <li class="list-group-item volunteers_item"><p>'.$bar.'/'.$row['Event_bar'].'</p><img class="man-icon" src="../rsc/img/man_black.png" alt=""></li>
                        <li class="list-group-item volunteers_item"><p>'.$security.'/'.$row['Event_sec'].'</p><img class="man-icon" src="../rsc/img/man_red.png" alt=""></li>
                        <li class="list-group-item volunteers_item"><p>'.$crew.'/'.$row['Event_crew'].'</p><img class="man-icon" src="../rsc/img/man_blue.png" alt=""></li>
                        <li class="list-group-item volunteers_item"><p>'.$technical.'/'.$row['Event_tech'].'</p><img class="man-icon" src="../rsc/img/man_black.png" alt=""></li>
                    </ul>
                    <p class="card-text text-center">'.$event_text.'</p>
                    <a href="#eventModal" class="btn btn-primary btn-small border-dark m-2 view_data" id="'.$id.'" data-toggle="modal" >Details</a>
                </div>
            </div>
            ';

            if ($counter % 3 == 0) {

                if ($counter == $numrow) {
                    echo '</div>';
                    echo '</section>';
                } else {
                }
            }
            $counter++;
        }
        echo $output;
        ?>

        <script src="../rsc/imports/js/event_modal_script.js">
        </script>
        <script src="../rsc/imports/js/new_event_modal_script.js">
        </script>

    </main>

<?php include '../rsc/imports/php/components/footer.php'; ?>