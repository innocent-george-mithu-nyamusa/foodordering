<!DOCTYPE html>
<html lang="en">
<?php
include_once '../config/Database.php';
include_once 'admin.php';

$database = new Database();
$db = $database->getConnection();


$admin = new Admin($db);

if($admin->loggedInAdmin()) {
header("Location: index.php");
}

$loginMessage = '';
if(isset($_POST["login"])) {
    $loginMessage = '';

    if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

        $admin->email = htmlspecialchars($_POST["email"]);
        $admin->password = htmlspecialchars($_POST["password"]);

        if($admin->login()) {
            header("Location: index.php");
        } else {
            $loginMessage = 'Invalid login! Please try again.';
        }
    } else {
        $loginMessage = 'Fill all fields.';
    }
}

?>
<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_login_boxed.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 09:04:10 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login |  MSU Food Ordering Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
</head>
<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Sign In</h1>
                        <p class="">Log in to your account to continue.</p>
                        
                        <form role="form" id="sign_in_form" method="post" action="" class="text-left" onsubmit="return checkForm(this);">
                            <?php if ($loginMessage != '') { ?>
                                <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>
                            <?php } ?>
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="email">USERNAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="email" name="email" type="email" class="form-control"  placeholder="e.g johndoe@mail.com" title="email must not be blank. Email must contain @ and it must be valid" pattern="[^ @]+@[^ @]+.[a-z]+" required>
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password"  title="Password Must not be blank. Password Must have at least 8 characters, must contain 1 uppercase letter, 1 lowercase letter, 1 number" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <input type="submit" name="login" value="Login" class="btn btn-primary" />
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

                if(!RegExp.escape) {
                    RegExp.escape = function(s) {
                        return String(s).replace(/[\\^$*+?.()|[\]{}]/g, '\\$&');
                    };
                }

                function checkPassword(str) {
                    const reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                    return reg.test(str);
                }

                function checkForm(form) {

                    if(form.email.value == "") {
                        this.email.focus();
                        e.preventDefault();
                        return;
                    }
                    if(form.password.value == "") {
                        this.password.focus();
                        e.preventDefault();
                        return;
                    }
                }

                const signInForm = document.getElementById("sign_in_form");
                signInForm.addEventListener("submit", checkForm, true);

                let supports_input_validity = function() {
                    var i = document.createElement("input");
                    return "setCustomValidity" in i;
                }

                if(supports_input_validity()){
                    var emailInput = document.getElementById("email");
                    emailInput.setCustomValidity(emailInput.title);

                    var passwordInput = document.getElementById("password");
                    passwordInput.setCustomValidity(passwordInput.title);

                    emailInput.addEventListener("keyup", function(e) {
                        emailInput.setCustomValidity(this.validity.patternMismatch ? emailInput.title: "");
                    }, false);


                    password.addEventListener("keyup", function(e){
                        this.setCustomValidity(this.validity.patternMismatch ? password.title: "");
                    },false);
                }
            }
            ,false);

    </script>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-2.js"></script>

</body>

<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_login_boxed.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 09:04:25 GMT -->
</html>