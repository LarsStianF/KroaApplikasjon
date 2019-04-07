<?php
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';

?>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->
    <link rel="stylesheet" href="../rsc/imports/css/custom.css">

    <main role="main" class="container">

        <div class="pageHeader bg-light" >
            <h1 class="display-3 text-center"> Volunteers </h1>
            <form class="form-inline " action="#">
                <div>
                    <button class="btn btn-dark filter-button" data-filter="#">All</button>
                    <button class="btn btn-light filter-button" data-filter="#">Crew</button>
                    <button class="btn btn-light filter-button" data-filter="#">Security</button>
                    <button class="btn btn-light filter-button" data-filter="#">Bar</button>
                    <button class="btn btn-light filter-button" data-filter="#">Technical</button>
                </div>
                <div class="input-group form-inline">
                    <input type="text" class="form-control" placeholder="Search for volunteers">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button">
                            <i>Search</i>
                        </button>
                    </div>

                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Name</a>
                        <a class="dropdown-item" href="#">Last Volunteered</a>
                    </div>
                </div>

            </form>
        </div>


        <div class="list-group list-people">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <ul class="list-inline ">
                            <li class="list-inline-item "><h5 class="mb-1">Name Nameson - </h5></li>
                            <li class="list-inline-item "><h6 class="mb-1">Volunteer</h6></li>
                            <li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_black.png" alt=""> </li>
                            <li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_red.png" alt=""> </li>
                            <li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_blue.png" alt=""> </li>
                            <li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_black.png" alt=""> </li>
                        </ul>
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </div>
                    <p class="mb-1"><span class="h6">Email: </span>root@test.no       <span class="h6">Tlf: </span>22224444</p>
                    <small>Last Volunteered: 27 January, 2019</small>
                </a>

                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <ul class="list-inline ">
                            <li class="list-inline-item "><h5 class="mb-1">Freddie Potasium - </h5></li>
                            <li class="list-inline-item "><h6 class="mb-1">Crew Manager</h6></li>
                            <li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_black.png" alt=""> </li>
                            <li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_blue.png" alt=""> </li>

                        </ul>
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </div>
                    <p class="mb-1"><span class="h6">Email: </span>root@test.no       <span class="h6">Tlf: </span>22224444</p>
                    <small>Last Volunteered: 27 January, 2019</small>
                </a>

                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <ul class="list-inline ">
                            <li class="list-inline-item "><h5 class="mb-1">Woolbob Roundpants - </h5></li>
                            <li class="list-inline-item "><h6 class="mb-1">Security Manager</h6></li>
                            <li class="list-inline-item " ><img class="man-icon" src="../rsc/img/man_red.png" alt=""> </li>
                        </ul>
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </div>
                    <p class="mb-1"><span class="h6">Email: </span>root@test.no       <span class="h6">Tlf: </span>22224444</p>
                    <small>Last Volunteered: 27 January, 2019</small>
                </a>
            </div>





    </main>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
    <script src="offcanvas.js"></script></body>




    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
    ##################################################################################
    -->

<?php include '../rsc/imports/php/components/footer.php'; ?>