<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<?php
include '../php/db.php';
include '../php/member.php';

session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true) {
  //echo "You're logged into the member's area " . $_SESSION['username'] . "!";
} else {
  header("location:login.php");
}
$UNAME = $_SESSION['username'];	//retrieve USERNAME
$currentId = '0';

//Pagination Implementation
$resultPage = pg_query($db, "SELECT COUNT(*) FROM advertised_project");
$r = pg_fetch_row($resultPage);
$numrows = $r[0];
// num of rows to show per page
$rowsperpage = 9;
$totalpages = ceil($numrows/$rowsperpage);

if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
  // cast var as int
  $currentpage = (int) $_GET['currentpage'];
} else {
  // default page num
  $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
  // set current page to last page
  $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
  // set current page to first page
  $currentpage = 1;
} // end if

// the offset of the list, based on current page
$offset = ($currentpage - 1) * $rowsperpage;
// get the info from the db
$sql = "SELECT * FROM advertised_project LIMIT $rowsperpage OFFSET $offset";
$result = pg_query($db, $sql);

$i=0;
$project = array();
while($row = pg_fetch_assoc($result)){
  $project[$i] = $row;
  $i++;
}
if(!result) {
  echo "Unable to retrieve result";
}
?>

<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

  <style>
  a.logout {
    color: white;
  }
  card {
    padding-top: 15px;
  }
  #custom-search-input {
    margin:0;
    margin-top: 10px;
    padding: 0;
    color:#091d30;
  }

  #custom-search-input .search-query {
    width:100%;
    padding-right: 3px;
    padding-left: 15px;
    /* IE7-8 doesn't have border-radius, so don't indent the padding */
    margin-bottom: 0;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 0;

  }

  .search-query:focus{
    z-index: 0;
  }

  .category-list {
    margin-bottom: : 8px;
  }

  searchBtn {
     position: relative;
     left: 28px;
  }
  </style>
</head>
<form = "form-vertical" method="post" action="home.php">
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0">
      <div class="container">
        <div class="collapse navbar-collapse navMenu justify-content-between">
          <div class="d-flex justify-content-end justify-content-lg-start pt-1 pt-lg-0">
            <div class="dropdown">
              <button class="btn dropdown-toggle btn-dark btn-sm"  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="img/user.png" alt="user image" class="btn-image" width="60" height="40">
                <span>Welcome! <?php echo "$UNAME";?>
                </span>
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="profile.php">Profile</a>
              </div>
            </div>
          </div>
          <div class="py-1 d-flex align-items-center justify-content-end">
            <ul class="navbar-nav d-flex flex-row">
              <li class="nav-item">
                <a href="home.php" class="text-small nav-link px-2">Explore</a>
              </li>
              <li class="nav-item">
                <a href="createProject.php" class="text-small nav-link px-2">Start a New Project
                </a>
              </li>
              <?php
              include 'db.php';
              $queryUser = $_SESSION['username'];
              $isAdmin = isMemberAdmin($db, $queryUser);
              if($isAdmin){
                echo '<li class="nav-item">';
                echo '<a href="admin.php" class="text-small nav-link px-2">Admin';
                echo '</a>';
                echo '</li>';
              }
              ?>
            </ul>
            <button class="btn btn-primary btn-sm" name="logout"><a href="../php/logout.php" class="logout">Logout</a></button>
          </div>
        </div>
      </div>
    </nav>
    <section class="pb-0">
      <div class="container" style="padding-top: 25px">
        <div class="row text-center mb-4">
          <div class="col">
            <h2>Entrepreneur Projects</h2>
            <div class="col-12">
              <div id="custom-search-input">
                <div class="input-group">
                  <input type="text" class="search-query form-control" placeholder="Search" />
                </div>
              </div>
            </div>
            <div class="col-10" id = 'category-list'>
              <label for="name" class="col-sm-2 control-label">Search Under: </label>
              <select>
                <option value="Fashion">Fashion</option>
                <option value="Technology">Technology</option>
                <option value="Games">Games</option>
                <option value="Food">Food</option>
                <option value="Music">Music</option>
                <option value="Photography">Photography</option>
                <option value="Handicraft">Hand</option>
                <option value="Community">Community</option>
              </select>
              <button class="btn btn-primary btn-sm" name="searchBtn">Search</a></button>
            </div>
          </div>
        </div>
        <div class="row">
          <?php foreach($project as $projectRow): ?>
            <?php echo "<script> console.log('Iterating project') </script>"; ?>
            <div class="col-12 col-md-4" style="padding-top: 15px;">
              <div class="card">
                <div class="card-body py-3">
                  <h5><?php echo $projectRow['title'];?></h5>
                  <div class="mb-4">
                    <p><?php echo $projectRow['description'];?></p>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="d-flex align-items-center">Amount needed : <?php echo $projectRow['amt_needed'];?></div>
                      <div class="d-flex align-items-center">Amount raised : <?php echo $projectRow['amt_raised'];?></div>
                    </div>
                    <?php if($UNAME!=$projectRow['entrepreneur']): ?>
                      <div class="col-md-4">
                        <div class="d-flex align-items-center justify-content-between">
                          <a href="#!" data-toggle="modal" data-target="#exampleModal"
                          onClick="displayPopupInformation('<?php echo $projectRow['id'];?>',
                          '<?php echo $projectRow['title'];?>',
                          '<?php echo $projectRow['description'];?>',
                          '<?php echo $projectRow['category'];?>',
                          '<?php echo $projectRow['start_date'];?>',
                          '<?php echo $projectRow['duration'];?>',
                          '<?php echo $projectRow['entrepreneur'];?>',
                          '<?php echo $projectRow['amt_needed'];?>',
                          '<?php echo $projectRow['amt_raised'];?>',
                          '<?php echo $projectRow['status'];?>')">Invest</a>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- Modal Popup-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalProjectTitle"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                </div>
                <div class="modal-body">
                  <p id="modalProjectDescription"></p>
                </div>
                <div class="modal-body">
                  <table>
                    <tr>
                      <td>Funding started on: </td>
                      <td style="padding-left:10px;"><span id="modalProjectStartDate"></span></td></p>
                    </tr>
                    <tr>
                      <td>It will last for: </td>
                      <td style="padding-left:10px;"><span id="modalProjectDuration"></span></td>
                    </tr>
                  </table>
                </div>
                <div class="modal-body">
                  <table>
                    <tr>
                      <td>Amount Needed: </td>
                      <td style="padding-left:10px;"><span id="modalProjectAmtNeeded"></span></td>
                    </tr>
                    <tr>
                      <td>Current Amount Raised: </td>
                      <td style="padding-left:10px;"><span id="modalProjectAmtRaised"></span></td>
                    </tr>
                  </table>
                  <br>
                  <form action="home.php" method="POST" id="modalFormPledge">
                    <input type="hidden" name="formId" value="" id="modalFormId">
                    <label id="modalFormLabel">SGD</label>
                    <input type="text" name="amtPledged" value="10" id="modalFormAmt" required>
                  </form>
                  <p id="investmentStatus">Fully Funded</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" form="modalFormPledge" class="btn btn-primary" data-dismiss="modal" id="modalButtonInvest" onClick="sendInvestment()">Invest</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class = "row" style="padding-top: 25">
          <div class="col-4">
          </div>
          <div class="col-4" style="text-align: center;">
            <?php
            /******  build the pagination links ******/
            // if not on page 1, don't show back links
            if ($currentpage > 1) {
              // show << link to go back to page 1
              echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
              // get previous page num
              $prevpage = $currentpage - 1;
              // show < link to go back to 1 page
              echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
            } // end if
            // range of num links to show
            $range = 3;

            // loop to show links to range of pages around current page
            for ($x = ($currentpage - $range); $x < (($currentpage + $range)  + 1); $x++) {
              // if it's a valid page number...
              if (($x > 0) && ($x <= $totalpages)) {
                // if we're on current page...
                if ($x == $currentpage) {
                  // 'highlight' it but don't make a link
                  echo " [<b>$x</b>] ";
                  // if not current page...
                } else {
                  // make it a link
                  echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
                } // end else
              } // end if
            } // end for
            // if not on last page, show forward and last page links
            if ($currentpage != $totalpages) {
              // get next page
              $nextpage = $currentpage + 1;
              // echo forward link for next page
              echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
              // echo forward link for lastpage
              echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
            } // end if
            /****** end build pagination links ******/
            ?>
          </div>
          <div class="col-4">
          </div>
        </div>
      </div>
    </section>
    <script>
    function displayPopupInformation(id, title, description, category, startDate, duration, entrepreneur, amtNeeded, amtRaised, status) {
      console.log("Project id: " + id);
      document.getElementById("modalFormId").value = id;
      document.getElementById("modalProjectTitle").innerHTML = title;
      document.getElementById("modalProjectDescription").innerHTML = description;
      document.getElementById("modalProjectStartDate").innerHTML = startDate;
      document.getElementById("modalProjectDuration").innerHTML = duration;
      document.getElementById("modalProjectAmtNeeded").innerHTML = amtNeeded;
      document.getElementById("modalProjectAmtRaised").innerHTML = amtRaised;

      var username = '<?php echo $UNAME?>';

      // Hide invest button so entrepreneur cannot invest his/her own advertisement
      if (username === entrepreneur || status==1) {
        document.getElementById("modalButtonInvest").hidden = true;
        document.getElementById("modalFormLabel").hidden = true;
        document.getElementById("modalFormAmt").hidden = true;
      } else {
        document.getElementById("modalButtonInvest").hidden = false;
        document.getElementById("modalFormLabel").hidden = false;
        document.getElementById("modalFormAmt").hidden = false;
      }

      document.getElementById("investmentStatus").hidden = status == 0;
    }

    function sendInvestment() {
      document.forms[0].submit();
      <?php
      include '../php/investment.php';
      $investment = pg_query($db, "SELECT * FROM invest WHERE investor='$UNAME' AND proj_id='$_POST[formId]'");
      $numRows = pg_num_rows($investment);

      if ($numRows>0) {
        $result = pg_query($db, "SELECT amount FROM invest WHERE investor='$UNAME' AND proj_id='$_POST[formId]'");
        $prevAmount = pg_fetch_result($result, 0, 0);
        updateInvestmentAmount($db, $UNAME, $_POST[formId], $_POST[amtPledged]+$prevAmount);
      } else {
        pg_query($db, "INSERT INTO invest(proj_id, investor, amount) VALUES('$_POST[formId]', '$UNAME', '$_POST[amtPledged]')");
      }
      ?>;
    }
    </script>
  </body>
  </html>
