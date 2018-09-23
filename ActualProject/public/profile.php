<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Profile Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: GhostWhite;
  }
  .myInvestmentTable {
    width: 95%;
  }
  </style>
</head>
<body>

  <div class="container">
    <h2>Profile Page</h2>
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home">My Profile</a></li>
      <li><a data-toggle="tab" href="#menu1">My Project & Investments</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active">
        <form>
          <div class="form-group row">
            <label for="username" class="col-4 col-form-label">User Name</label>
          </div>
          <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email</label>
            <div class="col-8">
              <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text">
            </div>
          </div>
          <div class="form-group row">
            <label for="publicinfo" class="col-4 col-form-label">Public Info</label>
            <div class="col-8">
              <textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="newpass" class="col-4 col-form-label">New Password</label>
            <div class="col-8">
              <input type ="password" id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
              <input type ="password" id="newpassRepeat" name="newpassRepeat" placeholder="Re-Enter New Password" class="form-control here" type="text">
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-4 col-8">
              <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
            </div>
          </div>
        </form>
      </div>
      <div id="menu1" class="tab-pane fade">
        <h3>My Projects</h3>
        <form>
          <div class="form-group row">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="myProjectTable" class="table table-bordred table-striped">
                    <thead>
                      <th>Project Name</th>
                      <th>Project Id</th>
                      <th>Amount Raised</th>
                      <th>Target Amount</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <tbody>
                      </thead>
                    </div>
                    <tr>
                      <td>Dummy Name</td>
                      <td>Dummy Id</td>
                      <td>Dummy Amount Raised</td>
                      <td>Target Amount</td>
                      <td>Dummy Status</td>
                      <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                      <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
        <h3>My Investments</h3>
        <form>
          <div class="form-group row">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table id="myInvestmentTable" class="table table-bordred table-striped">
                    <thead>
                      <th>Project Name</th>
                      <th>Project Id</th>
                      <th>Amount Invested</th>
                      <th>Target Amount</th>
                      <th>Status</th>
                      <th>Withdraw</th>
                      <tbody>
                      </thead>
                    </div>
                    <tr>
                      <td>Dummy Name</td>
                      <td>Dummy Id</td>
                      <td>Dummy Amount Invested</td>
                      <td>Target Amount</td>
                      <td>Dummy Status</td>
                      <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
