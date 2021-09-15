<?php
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if($customer->loggedIn()) {
	session_start();
	header("Location: index.php");
}

$signInMessage = '';

if(isset($_POST["signup"])) {
    $signInMessage = '';

    if(!empty($_POST["signup"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

        if(($customer->emailExists($_POST["email"]) <= 0)) {
            $customer->email = $_POST["email"];
            $customer->password = $_POST["password"];
            $customer->username = $_POST["username"];
            $customer->phone = $_POST["phone"];
            $customer->address = $_POST["address"];
            $customer->regnumber = $_POST["regnumber"];

            if($customer->signIn()) {
                header("Location: index.php");
            } else {
                $signInMessage = 'Sign Up failed! Please try again.';
            }

        }else {
            $loginMessage = 'Email Already Taken! Select A new one ';
        }

    } else {
        $signInMessage = 'Fill all fields.';
    }
}
include('inc/header.php');
?>
<title>MSU Students Dining Portal</title>
<?php include('inc/container.php');?>
<div class="content">
	<div class="container-fluid">
        <div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading" style="background:#5bc0de;color:white;">
				<div class="panel-title">Student Log In</div>
			</div>
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($signInMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $signInMessage; ?></div>
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="POST" onsubmit="return checkForm(this);" action="">

					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="username" minlength="5" name="username" placeholder="Full name" title="username must have at least 5 (five) characters.It can contain Comprise of Letters, numbers or underscores." style="background:white;"  pattern="^(?:[A-Z\d][A-Z\d_-]{5, 12}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4})$" required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
						<input type="text" class="form-control" id="regnumber" name="regnumber" placeholder="regnumber" minlength="9" maxlength="9" title="Reg number must have at least 8 characters.It can contain Comprise of Letters, numbers or underscores." style="background:white;" pattern=\^(?:[A-Z\d][A-Z\d_-]{8, 12}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4})\ required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" class="form-control" id="email" name="email" title="email must not be blank. Email must contain @ and it must be valid" pattern="[^ @]+@[^ @]+.[a-z]+" placeholder="email" required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
						<input type="text" class="form-control" id="phone" name="phone" title="Phone number must be provided" placeholder="phone number" pattern=\^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}\ required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
						<input type="text" class="form-control" id="address" name="address"  title="Address must be provided" placeholder="address" pattern="^[#.0-9a-zA-Z\s,-]+$" required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="password" name="password"  placeholder="password" title="Password Must not be blank. Password Must have at least 8 characters, must contain 1 uppercase letter, 1 lowercase letter, 1 number" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
					</div>
					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
							<input type="submit" name="signup" value="signup" class="btn btn-info">
						</div>
					</div>
				</form>

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
                    if(form.username.value == "") {
                        this.username.focus();
                        e.preventDefault();
                        return;
                    }

                    if(form.regnumber.value == "") {
                        this.regnumber.focus();
                        e.preventDefault();
                        return;
                    }
                    if(form.phone.value == "") {
                        this.phone.focus();
                        e.preventDefault();
                        return;
                    }

                    if(form.address.value == "") {
                        this.address.focus();
                        e.preventDefault();
                        return;
                    }

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

                    re = /^\w+$/;
                    ren = /^(?:[A-Z\d][A-Z\d_-]{5, 12}|[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4})$/i;
                    if(!ren.test(this.username.value)) {
                        this.username.focus();
                        e.preventDefault();
                        return;
                    }

                    if(this.password.value != "") {
                        if(!checkPassword(this.password.value)) {
                            this.password.focus();
                            e.preventDefault;
                            return;
                        } else {
                            this.password.focus();
                            e.preventDefault();
                        }
                    }
                }

                const signUpForm = document.getElementById("loginform");

                signUpForm.addEventListener("submit", checkForm, true);

                let supports_input_validity = function() {
                    var i = document.createElement("input");
                    return "setCustomValidity" in i;
                }

                if(supports_input_validity()){


                    var usernameInput = document.getElementById("username");
                    usernameInput.setCustomValidity(usernameInput.title);

                    var phoneInput = document.getElementById("phone");
                    phoneInput.setCustomValidity(phoneInput.title);

                    var emailInput = document.getElementById("email");
                    emailInput.setCustomValidity(emailInput.title);

                    var passwordInput = document.getElementById("password");
                    passwordInput.setCustomValidity(passwordInput.title);


                    usernameInput.addEventListener("keyup", function(e) {
                        usernameInput.setCustomValidity(this.validity.patternMismatch ? usernameInput.title: "");
                    }, false);

                    phoneInput.addEventListener("keyup", function(e) {
                        phoneInput.setCustomValidity(this.validity.patternMismatch ? phoneInput.title: "");
                    }, false);


                    emailInput.addEventListener("keyup", function(e) {
                        emailInput.setCustomValidity(this.validity.patternMismatch ? emailInput.title: "");
                    }, false);

                    passwordInput.addEventListener("keyup", function(e) {
                        passwordInput.setCustomValidity(this.validity.patternMismatch ? passwordInput.title: "");
                    }, false);

                }
            }
            ,false);
    </script>
        <script src="admin/assets/js/scrollspyNav.js"></script>
<?php include('inc/footer.php');?>
