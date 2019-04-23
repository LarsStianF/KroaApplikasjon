<?php
include 'dbcon.php';
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';


include 'rsc/imports/modals/unitlist_modal.php';

include 'rsc/imports/php/functions/functions.php';

?>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->


<script>
      /* ***** AJAX SCRIPT *****
    $(document).ready(function(){
        $('.unitSearch input[type="text"]').on("keyup input", function(){
            // Get input value on change
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("fetch_unitlist_data.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result a", function(){
            $(this).parents("#unitSearch").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
      */


   //  /* *OLD SCRIPT *
    $(document).ready(function(){
        $("#unitSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#namerow a").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
  // */
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
<!--
        <script>


            $(document).ready(function () {

                $('.view_data').click(function () {
                    var id = $(this).attr('id');

                    $.ajax({
                        url: "fetch_unitlist_data.php",
                        method: "post",
                        data: {id:id},
                        success:function (data) {
                            $('#event_detail').html(data);

                        }
                    });
                });
            });

        </script>
-->
<!--
  <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h2 class="mb-1">Name Nameson</h2>
                    <h2 class="mb-1"> <span class="badge badge-success">Units: 4</span> </h2>
                </div>

            </a>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h2 class="mb-1">Freddie Potasium</h2>
                    <h2 class="mb-1"> <span class="badge badge-success">Units: 14</span> </h2>
                </div>
            </a>
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h2 class="mb-1">Woolbob Roundpants</h2>
                    <h2 class="mb-1"> <span class="badge badge-danger">Units: 0</span> </h2>
                </div>
            </a>
        </div>
    -->


        <script src="../rsc/imports/js/unitlist_modal_script.js">
        </script>
    </main>











    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
    ##################################################################################
    -->

<?php include '../rsc/imports/php/components/footer.php'; ?>