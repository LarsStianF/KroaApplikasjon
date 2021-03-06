<?php
if ( isset($_GET['deleted'])) {


    // Check if request is for a file:
    if ($_GET['deleted'] == 'event') {
        $object = mysqli_real_escape_string($con, $_GET['deleted']);
        $page = "event_grid.php";

        // Analyze the status codes:
        $status_code = mysqli_real_escape_string($con, $_GET['status']);

        // Generate status feedback in accordance with status codes:
        if ($status_code == '1') {

            // post created from DB:
            $status_adjective = 'successfully';
            $title_text = 'Event Deleted';
            $title_color = 'text-success';

        } elseif ($status_code == '0') {

            // post not created from DB:
            $status_adjective = 'unsuccessfully';
            $title_text = 'Event could not be deleted';
            $title_color = 'text-danger';

        } elseif ($status_code == '2') {
            $status_adjective = 'unsuccessfully';
            $title_text = 'You cant delete old events';
            $title_color = 'text-danger';

        } elseif ($status_code == '3' ) {
            $status_adjective = 'unsuccessfully';
            $title_text = 'You cant delete events containing logs';
            $title_color = 'text-danger';
        }

    }

    if ($_GET['deleted'] == 'application') {

        $object = mysqli_real_escape_string($con, $_GET['deleted']);
        $status_code = mysqli_real_escape_string($con, $_GET['status']);
        $page = "index.php";

        if ($status_code == '1') {

            // post created from DB:
            $status_adjective = 'successfully';
            $title_text = 'Application removed';
            $title_color = 'text-success';

        } elseif ($status_code == '0') {

            // post not created from DB:
            $status_adjective = 'unsuccessfully';
            $title_text = 'Application could not be removed';
            $title_color = 'text-danger';

        }
    }

    $modal = '
    <!-- Executable link for modal window: -->
    <a id="modal-run" class="hidden" data-toggle="modal" data-target="#modal-created"></a>

    <!-- Modal window -->
    <div class="modal fade" id="modal-created" tabindex="-1" role="dialog" aria-labelledby="modal-created-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ' . $title_color . '"> ' . $title_text . '!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-secondary">
                    <p>The ' . $object . ' was ' . $status_adjective . ' deleted.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Click executable link on page load: -->
    <script>
        window.onload=function(){
            if(document.getElementById(\'modal-run\')!=null||document.getElementById(\'modal-run\')!=""){
                document.getElementById(\'modal-run\').click();
            }
        }
    <!-- Redirect page on modal close: -->
    $(".modal").on("hidden.bs.modal", function () {
    window.location = "' .$page. '";
    });
    </script>
    ';


    // Echo modal:
    echo $modal;
}



?>