<html>
    <head>
        <title>Employee Data</title>
        <link href="Assets/css/bootstrap.min.css" rel="stylesheet" >
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="emp_data"></tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <form id="emp_form">
                        <input type="hidden" name="action" value="emp_data_save" />
                        <input type="hidden" name="emp_id" id="emp_id" value="0" />
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Nme</label>
                                <input type="email" class="form-control" id="emp_first_name" name="emp_first_name" placeholder="First Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Last Name</label>
                                <input type="text" class="form-control" id="emp_last_name" name="emp_last_name" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="emp_email" name="emp_email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Designation</label>
                                <input type="text" class="form-control" id="emp_designation" name="emp_designation" placeholder="Designation">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button type="submit" id="save_btn" class="btn btn-primary" onclick="return save_emp_data()">Save</button>
                                <button type="button" id="cancel_btn" class="btn btn-primary" onclick="return cancel_emp_data()">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </body>
    <script src="Assets/js/jquery-3.7.1.min.js"></script>
    <script src="Assets/js/bootstrap.min.js" ></script>
    <script src="Assets/js/custom.js" ></script>
</html>

