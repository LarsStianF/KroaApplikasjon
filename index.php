<?php
include 'rsc/imports/php/components/head.php';

?>
    <script src="rsc\imports\js\index_script.js"></script>

    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
    ##################################################################################
    -->
    <section class="landing-page">
        <div class="front-cover d-flex">

            <div id="welcomediv" class="bg-light container  align-self-center rounded p-3">

                <div class="container-fluid text-center ">
                    <h1 class="">Welcome!</h1>
                    <button id="loginbtn" class="btn btn-success btn-lg">Login</button>
                    <button id="registerbtn" class="btn btn-primary btn-lg">Signup</button>
                </div>
            </div>

            <div id="logindiv" class="bg-light center container align-self-center rounded p-3 w-50" style="display:none;">

                <form action="rsc/scripts/login_script.php" method="POST" >

                    <!-- Email address: -->
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input id="inputEmail" name="login_email" class="form-control" type="email" placeholder="Enter email address" autofocus required>
                    </div>

                    <!-- Password: -->
                    <div class="form-group">
                        <label for="inputPassword">Password:</label>
                        <input id="inputPassword" name="login_password" class="form-control" type="password" placeholder="Enter password" required>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary abortbtn">Return</button>

                </form>

            </div>

            <div id="registerdiv" class="bg-light center container align-self-center rounded p-3 w-50" style="display: none;">

                <form action="rsc/scripts/reg_script.php" method="post">

                    <!-- First name: -->
                    <div class="form-group">
                        <label for="inputNameFirst">First name:</label>
                        <input id="inputNameFirst" name="firstname" class="form-control" type="text" placeholder="First name" autofocus required>
                    </div>

                    <!-- Last name: -->
                    <div class="form-group">
                        <label for="inputNameLast">Last name:</label>
                        <input id="inputNameLast" name="lastname" class="form-control" type="text" placeholder="Last name" required>
                    </div>

                    <!-- Email address: -->
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input id="inputEmail" name="email" class="form-control" type="email" placeholder="Email address" required>
                    </div>

                    <!-- Password: -->
                    <div class="form-group">
                        <label for="inputPassword">Password:</label>
                        <input id="inputPassword" name="password" class="form-control" type="password" placeholder="Password" required>
                    </div>


                    <!-- Phone number: -->
                    <div class="form-group">
                        <label for="inputPhone">Phone number:</label>
                        <input id="inputPhone" name="telephone" class="form-control" type="telephone" placeholder="Phone number">
                    </div>

                    <!-- Wanted Crew:

                    <div class="form-group">
                        <label for="inputCompany">Crew</label>
                        <select id="inputCrew" name="crew" class="form-control">



                        </select>
                    </div>
                    -->
                    <button type="submit" name="submit_user" class="btn btn-success my-3">Submit</button>
                    <button type="button" class="btn btn-secondary abortbtn">Return</button>
                </form>

            </div>



        </div>



    </section>



    <!--
    ##################################################################################
    ######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
    ##################################################################################
    -->

<?php include 'rsc/imports/php/components/footer.php'; ?>