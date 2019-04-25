<?php
if ( isset($_GET['signup'])|| isset($_GET['login']) ) {


        $object = "user";
        $created = "created";
    // Check if request is for a file:

    if ($_GET['signup'] == 'invalid') {


        $title_color = 'text-danger';
        $status_adjective = 'unsuccessfully';
        $title_text = 'Use of invalid characters';


    } elseif ($_GET['signup'] == 'email') {
        $title_color = 'text-danger';
        $status_adjective = 'unsuccessfully';
        $title_text = 'Email not entered correctly';


    } elseif($_GET['signup'] == 'usertaken') {
        $title_color = 'text-danger';
        $status_adjective = 'unsuccessfully';
        $title_text = 'User with that email exists';

    } elseif($_GET['signup'] == 'success') {
        $status_adjective = 'successfully';
        $title_text = 'User created';
        $title_color = 'text-success';


    } elseif($_GET['login'] == 'fail') {

        $created = "";
        $object = "login attempt";
        $status_adjective = 'unsuccessfull';
        $title_text = 'Wrong username or password';
        $title_color = 'text-danger';
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
                    <p>The ' . $object . ' was ' . $status_adjective .  $created .'</p>
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
    window.location = "index.php";
    });
    </script>
    ';


    // Echo modal:
    echo $modal;
}



?>