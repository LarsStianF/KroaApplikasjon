<?php
include 'rsc/imports/php/components/admin_head.php';
include 'rsc/imports/php/components/admin_header.php';

?>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->

    <body class="bg-light">

    <main role="main" class="container">

        <div class="btn-group btn-group-toggle " data-toggle="buttons">
            <label class="btn btn-primary active btn-lg btn-outline-info">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> Manager
            </label>
            <label class="btn btn-secondary btn-lg btn-outline-info">
                <input type="radio" name="options" id="option2" autocomplete="off"> Volunteers
            </label>
            <label class="btn btn-secondary btn-lg btn-outline-info">
                <input type="radio" name="options" id="option3" autocomplete="off"> Bar log
            </label>
            <label class="btn btn-secondary btn-lg btn-outline-info">
                <input type="radio" name="options" id="option4" autocomplete="off"> Security log
            </label>
            <label class="btn btn-secondary btn-lg btn-outline-info">
                <input type="radio" name="options" id="option5" autocomplete="off"> Crew log
            </label>
            <label class="btn btn-secondary btn-lg btn-outline-info">
                <input type="radio" name="options" id="option6" autocomplete="off"> Tech log
            </label>
        </div>

        <div class="row ">
            <div class="col-md-6 themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Upcoming events</h6>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#007bff" width="100%" height="100%"/><text fill="#007bff" dy=".3em" x="50%" y="50%">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark h4">Kroavalget 2019</strong>
                            <strong class="d-block text-gray dark">Date: 26.2.2019 Time: 20.00 - 02.30</strong>
                            <strong class="d-block text-gray dark">Meetup: kl 18.00</strong>
                            <strong class="d-block text-gray dark">You are working as: Bar</strong>
                            <strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>
                            <strong class="d-block text-gray dark"> Managers: 1/1 Bar, 0/0 Teknisk, 1/1 Crew, 1/1 Security</strong>

                            <span class="text-gray dark h6">Additional Notes: </span>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            <button type="button" class="btn btn-primary btn-sm btn-outline-success" style="float: right;">Sign up</button>
                        </p>
                    </div>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#e83e8c" width="100%" height="100%"/><text fill="#e83e8c" dy=".3em" x="50%" y="50%">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark h4">Loveshack</strong>
                            <strong class="d-block text-gray dark">Date: 26.2.2019 Time: 20.00 - 02.30</strong>
                            <strong class="d-block text-gray dark">Meetup: kl 18.00</strong>
                            <strong class="d-block text-gray dark">You are working as: Bar</strong>
                            <strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>
                            <strong class="d-block text-gray dark"> Managers: 1/2 Bar, 1/1 Teknisk, 1/1 Crew, 2/3 Security</strong>

                            <span class="text-gray dark h6">Additional Notes: </span>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            <button type="button" class="btn btn-primary btn-sm btn-outline-success" style="float: right;">Sign up</button>
                        </p>
                    </div>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#6f42c1" width="100%" height="100%"/><text fill="#6f42c1" dy=".3em" x="50%" y="50%">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark h4">Åpen scene</strong>
                            <strong class="d-block text-gray dark">Date: 26.2.2019 Time: 20.00 - 02.30</strong>
                            <strong class="d-block text-gray dark">Meetup: kl 18.00</strong>
                            <strong class="d-block text-gray dark">You are working as: Bar</strong>
                            <strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>
                            <strong class="d-block text-gray dark"> Managers: 1/1 Bar, 1/1 Teknisk, 0/0 Crew, 1/1 Security</strong>

                            <span class="text-gray dark h6">Additional Notes: </span>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            <button type="button" class="btn btn-primary btn-sm btn-outline-success" style="float: right;">Sign up</button>
                        </p>
                    </div>
                    <small class="d-block text-right mt-3">
                        <a href="#">Sign up for more events!</a>
                    </small>
                </div></div>
            <div class="col-md-6 themed-grid-col"> <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">You`re manager on these events</h6>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#007bff" width="100%" height="100%"/><text fill="#007bff" dy=".3em" x="50%" y="50%">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark h4">Karpe</strong>
                            <strong class="d-block text-gray dark">Date: 26.2.2019 Time: 20.00 - 02.30</strong>
                            <strong class="d-block text-gray dark">Meetup: kl 18.00</strong>
                            <strong class="d-block text-gray dark">You are working as: Bar</strong>
                            <strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>
                            <strong class="d-block text-gray dark"> Managers: 2/2 Bar, 1/1 Teknisk, 2/2 Crew, 1/4 Security</strong>

                            <span class="text-gray dark h6">Additional Notes: </span>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                        </p>
                    </div>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#e83e8c" width="100%" height="100%"/><text fill="#e83e8c" dy=".3em" x="50%" y="50%">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark h4">Rotlaus</strong>
                            <strong class="d-block text-gray dark">Date: 26.2.2019 Time: 20.00 - 02.30</strong>
                            <strong class="d-block text-gray dark">Meetup: kl 18.00</strong>
                            <strong class="d-block text-gray dark">You are working as: Bar</strong>
                            <strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>
                            <strong class="d-block text-gray dark"> Managers: 1/2 Bar, 1/1 Teknisk, 0/1 Crew, 1/3 Security</strong>

                            <span class="text-gray dark h6">Additional Notes: </span>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                        </p>
                    </div>
                    <div class="media text-muted pt-3">
                        <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect fill="#6f42c1" width="100%" height="100%"/><text fill="#6f42c1" dy=".3em" x="50%" y="50%">32x32</text></svg>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark h4">X-RUSS</strong>
                            <strong class="d-block text-gray dark">Date: 26.2.2019 Time: 20.00 - 02.30</strong>
                            <strong class="d-block text-gray dark">Meetup: kl 18.00</strong>
                            <strong class="d-block text-gray dark">You are working as: Bar</strong>
                            <strong class="d-block text-gray dark">Volunteers: 6/6 Bar, 4/5 Teknisk, 4/4 Crew, 10/14 Security</strong>
                            <strong class="d-block text-gray dark"> Managers: 1/2 Bar, 1/1 Teknisk, 0/2 Crew, 1/4 Security</strong>

                            <span class="text-gray dark h6">Additional Notes: </span>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                        </p>
                    </div>
                    <small class="d-block text-right mt-3">
                        <a href="#">Sign up for more events!</a>
                    </small>
                </div></div>
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