<?php
session_start();
require("db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

$errors = array();

// ========================= LOGIN STUDENT =======================
if (isset($_POST['studentLogin'])) {
  $rollnumber = mysqli_real_escape_string($db, $_POST['studentRoll']);
  $password = mysqli_real_escape_string($db, $_POST['studentPass']);
  $rollnumber = (int)$rollnumber;

  $query_find_student = "select * from student where rollnumber='$rollnumber'";
  $result_find_student = mysqli_query($db, $query_find_student);
  if (mysqli_num_rows($result_find_student) == 1) {
    $row = mysqli_fetch_assoc($result_find_student);

    if ($password == $row['password']) {
      $_SESSION['rollnumber'] = $rollnumber;
      $_SESSION['student_logged'] = "You are now logged in";
      header("Location: index.php");
    } else {
      array_push($errors, "Wrong password! Please try again.");
    }
  } else {
    array_push($errors, "Student not found!");
  }
}

// ========================= LOGIN ADMIN` =======================
if (isset($_POST['adminLogin'])) {
  $adminUsername = mysqli_real_escape_string($db, $_POST['adminUsername']);
  $adminPassword = mysqli_real_escape_string($db, $_POST['adminPassword']);

  //$adminPassword =$adminPassword;
  $query_find_admin = "select * from admin where username='$adminUsername'";
  $result_find_admin = mysqli_query($db, $query_find_admin);
  if (mysqli_num_rows($result_find_admin) == 1) {
    $row = mysqli_fetch_assoc($result_find_admin);
    // echo "$adminPassword<br>";
    // echo $adminUsername;

    if ($adminPassword == $row['password']) {
      $_SESSION['username'] = $adminUsername;
      $_SESSION['admin_logged'] = "You are now logged in";
      header("Location: allot.php");
    } else {
      array_push($errors, "Wrong password! Please try again.");
    }
  } else {
    array_push($errors, "Admin not found!");
  }
}

// ========================= Email Verify` =======================
if (isset($_POST['email_verify'])) {
  $email_id = mysqli_real_escape_string($db, $_POST['email_id']);
  $otp = random_int(100000, 999999);
  $curr_date = date_create();
  date_add($curr_date, date_interval_create_from_date_string("1 hour"));
  $otp_expire = date_format($curr_date, 'Y-m-d H:i:s');

  $update_otp_query = "UPDATE admin SET otp = $otp, otp_expire = '$otp_expire' WHERE email='$email_id'";
  mysqli_query($db, $update_otp_query);
  $row_updated = mysqli_affected_rows($db);
  if ($row_updated == 1) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAutoTLS = false;
    $mail->Username = 'hkexperiment786@gmail.com';
    $mail->Password = 'bswfvtnmtxauttya';
    $mail->Port = 587;
    $mail->setFrom('maitri02manu@gmail.com', 'Hostel MNG System');
    $mail->addAddress($email_id);
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset';
    $body = "Hi, Admin. OTP for resetting password: $otp<br>";
    $url_email = urlencode($email_id);
    $body .= "Reset link: <a href=\"http://localhost/housekeeper/source/reset_password.php?email=$url_email\">Open</a>";
    $mail->Body = $body;

    if ($mail->send()) {
      header("location: reset_password.php?email=$url_email");
    } else {
      array_push($errors, "Error in sending E-Mail!");
      array_push($errors, $mail->ErrorInfo);
    }
  } else {
    array_push($errors, "Invalid Admin E-Mail!");
  }
}

// =================== RESET PASSWORD ==========================================
if (isset($_POST['reset_pwd'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $new_pwd = mysqli_real_escape_string($db, $_POST['n_pwd']);
  $otp = mysqli_real_escape_string($db, $_POST['otp']);
  $curr_date = date('Y-m-d H:i:s');
  $update_otp_query = "UPDATE admin SET otp = NULL, otp_expire = NULL, password = '$new_pwd' WHERE email='$email' AND otp = $otp AND otp_expire > '$curr_date'";
  mysqli_query($db, $update_otp_query);
  $row_updated = mysqli_affected_rows($db);
  if ($row_updated == 1) {
    header("location: reset_password.php?email=$url_email&reset=success");
  } else {
    array_push($errors, "Invalid OTP!");
  }
}
