<?php require("server.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="assets/css/main.min.css">

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <style>
        #p_error {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <div class="row parent-row">
            <!-- Image -->
            <div class="col s1 l7 hide-on-med-and-down">
                <div class="flex-v-center">

                </div>
            </div>
            <!-- Form -->
            <div class="col s12 l5">
                <div class="center-align form-align">
                    <?php if (isset($_GET['reset'])) : ?>
                        <h4> Password changed! </h4>
                        <h6>You can now login with the new password</h6>
                        <a href="http://localhost/housekeeper/source"><h6>GO HOME</h6></a>
                    <?php elseif (isset($_GET['email'])) : ?>
                        <h4> Reset your password </h4>
                        <h6>You must have received an OTP send to your email</h6>
                        <h6><?= $_GET['email'] ?></h6>
                        <div class="row">
                            <form action="" method="POST" autocomplete="off" class="col s12" onsubmit="return checkForm(event);">
                                <?php include("errors.php") ?>
                                <div class="row flex-h-center mb-0">
                                    <div class="input-field col s8">
                                        <input type="hidden" name="email" id="email" value="<?= $_GET['email'] ?>">
                                        <input type="number" name="otp" id="otp">
                                        <label for="otp">Enter OTP</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input type="password" name="n_pwd" id="n_pwd">
                                        <label for="n_pwd">New Password</label>
                                    </div>
                                    <div class="input-field col s8">
                                        <input type="text" id="c_pwd">
                                        <label for="c_pwd">Confirm password</label>
                                    </div>
                                </div>
                                <p id="p_error"></p>
                                <button type="submit" name="reset_pwd" class="waves-effect waves-light btn">RESET</button>
                            </form>
                        </div>
                    <?php else : ?>
                        <h4> Invalid URL </h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </header>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        const p1 = document.getElementById("n_pwd");
        const p2 = document.getElementById("c_pwd");
        const pe = document.getElementById("p_error")

        function checkForm(event) {
            if (!p1.value || p1.value == "") {
                pe.innerText = "Password is required";
                return false;
            }
            if (p1.value !== p2.value) {
                pe.innerText = "Passwords do not match";
                return false;
            }
            return true;
        }
    </script>
</body>

</html>