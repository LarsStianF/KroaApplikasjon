<?php
include 'dbcon.php';
if( !isset($_SESSION['login']) ){
    header("Location:../index.php")
    ;exit();

}elseif ($_SESSION['login_type'] >= 5) {
    $dag_leder = 2;
    $cur_user = $_SESSION['login_type'];
    $id = $_SESSION['login_id'];
    $tempQuery =  "SELECT * FROM manager WHERE " . $id . " = vol_ID AND crew_type_ID = 1;";
    $tempRes = mysqli_query($con,$tempQuery);
    $tempRow = mysqli_fetch_array($tempRes);
    $bar_manager = $tempRow{'crew_type_ID'};

    if ($cur_user > $dag_leder && $bar_manager != 1) {
        header("Location:index.php");;
        exit();
    }
}
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';
include 'rsc/imports/php/functions/functions.php';
include 'rsc/imports/modals/unitlist_modal.php';


?>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->


<script>



    $(document).ready(function(){
        $("#unitSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#namerow a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>



    <main role="main" class="container">

        <div class="bg-light p-3 m-0 card" >
            <h1 class="display-3 text-center"> Unitlist </h1>

            <div class="input-group input-group-lg">
                <input id="unitSearch" type="text" class="form-control" placeholder="Search for volunteers">
            </div>
            <div class="result"></div>

        </div>


<?php


    $sql = 'SELECT * FROM volunteer WHERE user_type > 1';
    $result = mysqli_query($con, $sql);


                echo '<div class="list-group">';
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $id = $row['ID'];

                    echo '<div id="namerow">';
                    echo '<a href="#unitlistModal" class="list-group-item list-group-item-action flex-column align-items-start view_data" data-toggle="modal" id="'.$id.'">';
                    echo '<div class="d-flex w-100 justify-content-between">';
                    echo '<h2 class="mb-1"  >';
                    echo $row['Firstname'] . ' ' . $row['Lastname'];
                    echo '</h2>';
                    echo '<h2 class="mb-1" >';
                    if ($row['Unit'] > 0) {
                        echo '<span class="badge badge-success"> Units: ';
                    } else {
                        echo '<span class="badge badge-danger"> Units: ';
                    }
                    echo $row['Unit'];
                    echo '</span> </h2>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }

             echo  ' </div>';





?>


        <script src="../rsc/imports/js/unitlist_modal_script.js">
        </script>
    </main>











    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
    ##################################################################################
    -->

<?php include '../rsc/imports/php/components/footer.php'; ?>