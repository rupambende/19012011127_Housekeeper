<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: alogin.php");
}
if (isset($_GET['logout'])) {
  unset($_SESSION['username']);
  session_destroy();
  header("Location: alogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register Student - Housekeeper Admin Dashboard</title>
  <?php require("meta.php"); ?>
</head>

<body>
  <!-- Side Navigation -->
  <?php require("allotsidenav.php"); ?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-background pb-6 pt-5 pt-md-6">
      <div class="container-fluid">
        <!-- notification message -->
        <?php if (isset($_SESSION['student_registered'])) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
            <?php echo $_SESSION['student_registered'];
            unset($_SESSION['student_registered']); ?>
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>
        <?php require("allotheader.php"); ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--5 pb-6">
      <div class="row mt-2">
        <div class="col-xl-12 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <h3 class="mb-0">Register New Student</h3>
            </div>
            <div class="card-body pb-5">
              <form method="POST" action="allothandler.php" enctype="multipart/form-data">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-id">Select Excell / CSV file<span class="text-danger">*</span></label>
                        <input type="file" name="file" id="input-id" class="form-control" required>
                        <small>Format (no heading): rollnumber, roomnumber, floor </small>
                        <a href="./sample.csv"><small>Sample file</small></a>
                      </div>
                    </div>
                  </div>
                  <button name="regBatchSubmit" class="btn btn-icon btn-3 btn-primary" type="submit">
                    <span class="btn-inner--text">Upload</span>
                  </button>
                </div>
              </form>
              <hr>
              <form method="POST" autocomplete="off" action="allothandler.php">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-id">Roll Number <span class="text-danger">*</span></label>
                        <input type="number" name="regRoll" id="input-id" class="form-control" required placeholder="Enter numeric value">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-room">Room Number <span class="text-danger">*</span></label>
                        <input type="text" name="regRoom" id="input-room" class="form-control" required placeholder="Ex : C202">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-time">Floor <span class="text-danger">*</span></label>
                        <input type="number" name="regFloor" id="input-time" class="form-control" required placeholder="Enter single digit no.">
                      </div>
                    </div>
                  </div>
                  <button name="regSubmit" class="btn btn-icon btn-3 btn-primary" type="submit">
                    <span class="btn-inner--text">Register</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="assets/js/argon.min.js"></script>
</body>

</html>