<div class="modal fade" id="newmodal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create new event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="create_handler.php?object=newevent&name=submit" enctype="multipart/form-data">

                        <!-- Event name: -->
                        <div class="form-group">
                            <label>Event name</label>
                            <input type="text" name="event_name" class="form-control form-text" placeholder="What's the name of your event?">
                        </div>

                        <!-- Event Date: -->
                        <div class="form-group">
                            <label>Event Date</label>
                            <input type="date" name="date" class="form-control form-text" placeholder="What date is the event?">
                        </div>

                        <!-- Event Time: -->
                        <div class="form-group">
                            <label>Event Time</label>
                            <div class="form-row">
                                <label>From:</label>
                                <div class="col">
                                    <input type="time" name="start_time" class="form-control form-inline" placeholder="What time does the event start?">
                                </div>
                                <label>To:</label>
                                <div class="col">
                                    <input type="time" name="end_time" class="form-control form-inline" placeholder="What time does the event end?">
                                </div>
                            </div>
                        </div>


                        <!-- event text: -->
                        <div class="form-group mt-4">
                            <label>Event text</label>
                            <textarea name="event_text" class="form-control" placeholder="Give a short description of the event (maximum 255 characters)" maxlength="255" style="height: 80px"></textarea>
                        </div>



                        <div class="form-group d-flex justify-content-around">
                            <div class="d-flex justify-content-between">
                                <i class="man-icons-modal fa fa-user" style="color:orange;font-size:40px;"></i>
                                <label>Security</label>
                                <input class="form-control d-flex" style="width 60px; max-width: 60px" type="number" name="sec_volunteers" value="1" min="1" max="20">
                            </div>

                           <div class="d-flex justify-content-around">
                               <i class="man-icons-modal fa fa-user" style="color:red;font-size:40px;"></i><label>Bar</label>
                               <input class="form-control d-flex" style="width 60px; max-width: 60px" type="number" name="bar_volunteers" value="1" min="1" max="20">
                           </div>
                        </div>
                        <div class="form-group d-flex justify-content-around">
                            <div class="d-flex justify-content-between">
                                <i class="man-icons-modal fa fa-user" style="color:black;font-size:40px;"></i><label>Crew</label>
                                <input class="form-control form-inline" style="width 60px; max-width: 60px" type="number" name="crew_volunteers" value="1" min="1" max="20">
                            </div>

                            <div class="d-flex justify-content-around">
                                <i class="man-icons-modal fa fa-user" style="color:blue;font-size:40px;"></i><label>Technical</label>
                                <input class="form-control form-inline" style="width 60px; max-width: 60px" type="number" name="tech_volunteers" value="1" min="1" max="20">
                            </div>
                        </div>


                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-success" name="submit">Create event</button>
                        </div>


                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>