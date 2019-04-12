<div class="modal fade" id="newmodal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Need to fix</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="../../../events.php?object=created&type=event" method="post">

                    <!-- First name: -->
                    <div class="form-group">
                        <label for="inputNameFirst">Event name</label>
                        <input id="inputNameFirst" name="firstname" class="form-control" type="text" placeholder="Event name" autofocus required>
                    </div>

                    <!-- Last name: -->
                    <div class="form-group">
                        <label for="inputNameLast">Date:</label>

                    </div>

                    <!-- Email address: -->


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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>