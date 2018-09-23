<div class="row">
    <div class="col-md-6 col-md-offset-3" id="form_container">
        <h2>Start a Project</h2>
        <p>
           Please fill in the details below to create a new Project.
        </p>
        <form role="form" method="post" id="reused_form">


            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="name">
                        Your Project Title:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email">
                        Category:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="message">
                            Description:</label>
                        <textarea class="form-control" type="textarea" name="message" id="message" maxlength="6000" rows="7"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-lg btn-default pull-right" >Create</button>
                </div>
            </div>

        </form>
        <div id="success_message" style="width:100%; height:100%; display:none; ">
            <h3>Posted your message successfully!</h3>
        </div>
        <div id="error_message"
                style="width:100%; height:100%; display:none; ">
                    <h3>Error</h3>
                    Sorry there was an error sending your form.
        </div>
    </div>
</div>
