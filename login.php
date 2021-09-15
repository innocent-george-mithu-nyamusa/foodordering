<?php
include_once 'config/Database.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);

if($customer->loggedIn()) {
	header("Location: index.php");
}

$loginMessage = '';
if(isset($_POST["login"])) {
    $loginMessage = '';

    if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"]))
    {

        $customer->email = $_POST["email"];
        $customer->password = $_POST["password"];


        if ($customer->login()) {
            header("Location: index.php");
        } else {
            $loginMessage = 'Invalid login! Please try again.';
        }

    } else {
        $loginMessage = 'Fill all fields.';
    }
}


include('inc/header.php');
?>
<title>Msu online food ordering app</title>
<?php include('inc/container.php');?>
<div class="content">
	<div class="container-fluid">
        <div class="col-md-6">
		<div class="panel panel-info">
			<div class="panel-heading" style="background:#5bc0de;color:white;">
				<div class="panel-title">Student Log In</div>
			</div>
			<div style="padding-top:30px" class="panel-body" >
				<?php if ($loginMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>
				<?php } ?>
				<form id="loginform" class="form-horizontal" role="form" method="post" action="" onsubmit="return checkForm(this);">
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" class="form-control" id="email" name="email"  placeholder="email" style="background:white;" title="email must not be blank. Email must contain @ and it must be valid" pattern="[^ @]+@[^ @]+.[a-z]+" required>
					</div>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" class="form-control" id="password" name="password"  placeholder="password" title="Password Must not be blank. Password Must have at least 8 characters, must contain 1 uppercase letter, 1 lowercase letter, 1 number" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
					</div>

					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
						  <input type="submit" name="login" value="Login" class="btn btn-info">
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

                const loginForm = document.getElementById("loginform");
                loginForm.addEventListener("submit", checkForm, true);

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
<?php include('inc/footer.php');?>
