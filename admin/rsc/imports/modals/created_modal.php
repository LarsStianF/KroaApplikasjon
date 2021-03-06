<?php

if ( isset($_GET['created']) ) {


    // Check if request is for a file:
    if ($_GET['created'] == 'event') {
        $object = 'event';
        $page = "event_grid.php";
        // Analyze the status codes:
        $status_code = mysqli_real_escape_string($con, $_GET['status']);

        // Generate status feedback in accordance with status codes:
        if ( $status_code == '1' ){

            // post created from DB:
            $status_adjective = 'successfully';
            $title_text = 'Event Created';
            $title_color = 'text-success';

        } elseif ( $status_code == '0' ){

            // post not created from DB:
            $status_adjective = 'unsuccessfully';
            $title_text = 'Nothing Created';
            $title_color = 'text-danger';

        }

    }
    elseif ($_GET['created'] == 'application') {

        $object = $_GET['created'];
        $page = "index.php";
        $status_code = mysqli_real_escape_string($con, $_GET['status']);

        if ($status_code == 1) {
            // user signed up in DB:
            $status_adjective = 'successfully';
            $title_text = 'Application Created';
            $title_color = 'text-success';
        } else if ($status_code == 0) {
            // user not signed in DB:
            $status_adjective = 'unsuccessfully';
            $title_text = 'You have already applied for this';
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
                    <h5 class="modal-title '.$title_color.'"> '.$title_text.'!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-secondary">
                    <p>The '.$object.' was '.$status_adjective.' created.</p>
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
        
            window.location = "' . $page . '";
          
    });
    </script>
    ';




    // Echo modal:
    echo $modal;
}

?>