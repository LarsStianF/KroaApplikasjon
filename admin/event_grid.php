<?php
include 'dbcon.php';

if( !isset($_SESSION['login']) ){
    header("Location:../index.php");
    exit();

}


include 'rsc/imports/php/functions/functions.php';
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'rsc/imports/modals/event_modal.php';
include 'rsc/imports/modals/delete_event_modal.php';
include 'rsc/imports/modals/new_event_modal.php';
include 'rsc/imports/modals/edit_event_modal.php';

?>

    <main class="container">

            <div class="bg-light p-3 m-0 card" >
                <h1 class="display-3 text-center"> Event Page </h1>
                <div>
                    <a href="#newmodal" class="btn btn-dark" id="newevent" data-toggle="modal" >New Event</a>
                </div>

            </div>


        <?php

        $sql = 'SELECT * FROM event WHERE DATE >= Curdate() ORDER BY Date ASC, Time_Start ASC';
        $result = mysqli_query($con, $sql);
        $numrow = mysqli_num_rows($result);
        $counter = 1;

        // Starts output
        $output = '<section class="container pt-2">
                    <div class="row">
                    ';




            while ($row = mysqli_fetch_array($result)) {

                //fix event substring
                $event_text = substr($row['Event_text'], 0, 50) . '..';


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
                $bar = $volunteers[0];
                $security = $volunteers[1];
                $crew = $volunteers[2];
                $technical = $volunteers[3];

                $output .= '
                <div class="card card-custom border-light ml-2">
                    <div class="card-img-caption">
                    <p class="card-text-top">' . $row['Name'] . '</p>
                    <p class="card-text-bottom">' . $date . '</p>
                    <img class="card-img-top" src="../rsc/img/eventbackground.png" alt="">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">' . $startTime . ' - ' . $endTime . '</h5>
                    <ul class="list-group list-group-flush volunteers_list ml-5">
                        <li class="list-group-item volunteers_item"><p>' . $bar . '/' . $row['Event_bar'] . '</p><i class="fa fa-user" style="color:orange; font-size:25px;"></i></li>
                        <li class="list-group-item volunteers_item"><p>' . $security . '/' . $row['Event_sec'] . '</p><i class="fa fa-user" style="color:red; font-size:25px;"></i></li>
                        <li class="list-group-item volunteers_item"><p>' . $crew . '/' . $row['Event_crew'] . '</p><i class="fa fa-user" style="color:black; font-size:25px;"></i></li>
                        <li class="list-group-item volunteers_item"><p>' . $technical . '/' . $row['Event_tech'] . '</p><i class="fa fa-user" style="color:blue; font-size:25px;"></i></li>
                    </ul>
                    <p class="card-text text-center">' . $event_text . '</p>
                    
                    
                    <div class="btn-group justify-content-center">
                        <a href="#eventModal" class="btn btn-block btn-primary border-dark view_data" id="' . $id . '" data-toggle="modal" >Details</a>
                        <a class="btn btn-primary dropdown-toggle dropdown-toggle-split border-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </a>
                        <div class="dropdown-menu">
                           <a href="#editEventModal" class="dropdown-item view_edit_data" data-toggle="modal" id="' . $id . '" >Edit event</a>
                             <div class="dropdown-divider"></div>
                           <a href="#delEventModal" class="dropdown-item view_delete_data" data-toggle="modal" id="' . $id . '" >Delete event</a>
                        </div>
                    </div>
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
            $output = "";

        ?>


        <section class="container ">
            <div class="row">
                <div class="col text-center">
                    <p>
                        <a class="btn btn-dark" data-toggle="collapse" href="#collapseEvents" role="button" aria-expanded="false" aria-controls="collapseExample">
                            View completed events
                        </a>
                    </p>
                </div>
            </div>
        </section>

        <div class="collapse" id="collapseEvents">





<?php

            $sql = 'SELECT * FROM Event WHERE Date < CURDATE() ORDER BY Date DESC, Time_Start ASC';
            $result = mysqli_query($con, $sql);
            $numrow = mysqli_num_rows($result);
            $counter = 1;
            $output = '<section class="container">
                            <div class="row">
                    ';

             while ($row = mysqli_fetch_array($result)) {

                //fix event substring
                $event_text = substr($row['Event_text'], 0, 40) . '..';


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
                $bar = $volunteers[0];
                $security = $volunteers[1];
                $crew = $volunteers[2];
                $technical = $volunteers[3];

                $output .= '
                <div class="card card-custom border-light ml-2">
                    <div class="card-img-caption">
                    <p class="card-text-top">' . $row['Name'] . '</p>
                    <p class="card-text-bottom">' . $date . '</p>
                    <img class="card-img-top" src="../rsc/img/eventbackground.png" alt="">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">' . $startTime . ' - ' . $endTime . '</h5>
                    <ul class="list-group list-group-flush volunteers_list ml-5">
                        <li class="list-group-item volunteers_item"><p>' . $bar . '/' . $row['Event_bar'] . '</p><i class="fa fa-user" style="color:orange; font-size:25px;"></i></li>
                        <li class="list-group-item volunteers_item"><p>' . $security . '/' . $row['Event_sec'] . '</p><i class="fa fa-user" style="color:red; font-size:25px;"></i></li>
                        <li class="list-group-item volunteers_item"><p>' . $crew . '/' . $row['Event_crew'] . '</p><i class="fa fa-user" style="color:black; font-size:25px;"></i></li>
                        <li class="list-group-item volunteers_item"><p>' . $technical . '/' . $row['Event_tech'] . '</p><i class="fa fa-user" style="color:blue; font-size:25px;"></i></li>
                    </ul>
                    <p class="card-text text-center">' . $event_text . '</p>
                    
                    
                    <div class="btn-group justify-content-center">
                        <a href="#eventModal" class="btn btn-block btn-primary border-dark view_data" id="' . $id . '" data-toggle="modal" >Details</a>
                        <a class="btn btn-primary dropdown-toggle dropdown-toggle-split border-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </a>
                        <div class="dropdown-menu">
                           <a href="#editEventModal" class="dropdown-item view_edit_data" data-toggle="modal" id="' . $id . '" >Edit event</a>
                             <div class="dropdown-divider"></div>
                           <a href="#delEventModal" class="dropdown-item view_delete_data" data-toggle="modal" id="' . $id . '" >Delete event</a>
                        </div>
                    </div>
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


    </main>

<?php
include 'rsc/imports/modals/created_modal.php';
include 'rsc/imports/modals/updated_modal.php';
include 'rsc/imports/modals/deleted_modal.php';
include '../rsc/imports/php/components/footer.php';
?>