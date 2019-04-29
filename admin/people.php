<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../index.php")
    ;exit();

}
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'rsc/imports/php/functions/functions.php';
include 'rsc/imports/modals/people_modal.php';




?>

<script>
    $(document).ready(function(){
        $("#peopleSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#namerow .filterSearch").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    // */
</script>




    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->
    <link rel="stylesheet" href="../rsc/imports/css/custom.css">

    <main role="main" class="container">

        <div class="bg-light p-3 m-0 card" >
            <h1 class="display-3 text-center"> Volunteers </h1>
            <form class="form-inline " name="filter" method="POST" action="">
                <div>
                    <button class="btn btn-dark filter-button" id="all" name="all" data-filter="">All</button>
                    <button class="btn btn-dark filter-button" id="crew" name="3" data-filter="">Crew</button>
                    <button class="btn btn-dark filter-button" id="sec" name="2" data-filter="">Security</button>
                    <button class="btn btn-dark filter-button" id="bar" name="1" data-filter="">Bar</button>
                    <button class="btn btn-dark filter-button" id="tech" name="4" data-filter="">Technical</button>
                </div>
                <div class=" m-2 input-group form-inline">
                    <input id="peopleSearch" type="text" class="form-control" placeholder="Search for volunteers">
                    <div class="input-group-append">
                    </div>

                </div>


            </form>
        </div>


        <div class="list-group list-people">



            <?php
            if (isset($_POST['1']) || isset($_POST['2']) || isset($_POST['3']) || isset($_POST['4']))  {
                foreach($_POST as $key => $value){
                    $crew_type = $key;
                }

                populate_volunteers_filter($crew_type);

            } else {
                populate_volunteers_all();
            }


?>
            </div>






    </main>

    <script src="../rsc/imports/js/people_modal_script.js">
    </script>




    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
    ##################################################################################
    -->

<?php include '../rsc/imports/php/components/footer.php'; ?>