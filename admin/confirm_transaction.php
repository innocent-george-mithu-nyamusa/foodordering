<!DOCTYPE html>
<html lang="en">
<?php

    include "admin.php";
    include "../config/Database.php";

    $database = new Database();
    $dbh =$database->getConnection();

    $admin = new Admin($dbh);

    if($admin->loggedInAdmin()) {
        header("Location: login.php");
    }

    if(isset($_GET["conf_stud"])) {

        $student_id = $_GET["conf_stud"];
        $getQuery = "SELECT * FROM food_customer WHERE id=?";
        $getStmt  = $dbh->prepare($getQuery);
        $getStmt->bind_param("d", $student_id);
        $getStmt->execute();
        $student = $getStmt->get_result();

        foreach ($student as $single) {

    }
?>
<!-- Mirrored from designreset.com/cork/ltr/demo4/add_meal.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 09:03:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Confirm Deposit | MSU Food Student Food Ordering Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
</head>
<body>
    
    <!--  BEGIN NAVBAR  -->
    <?php include "includes/header.php"; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <?php include "includes/sub_header.php"; ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php include "includes/sidebar.php"; ?><div class="sidebar-wrapper sidebar-theme">

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form method="post" action="includes/data/updateStudent.php" enctype="multipart/form-data">
                                    <div id="general-info" class="section general-info" >
                                        <div class="info">
                                            <h6 class="">Confirm Deposit</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                <input disabled="disabled" type="file" id="input-file-max-fs" class="dropify" data-default-file="assets/img/user-profile.jpeg" data-max-file-size="2M" />
                                                                <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Full Name</label>
                                                                            <input type="text" name="student_name" class="form-control mb-4" id="fullName" placeholder="Full Name" value="<?php echo $single['name'];?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="bankName">Bank Name </label>
                                                                            <input type="text"  name="student_bank" class="form-control mb-4" id="bankName" placeholder="Fast Bank Ltd" >
                                                                            <input type="hidden" name="student_id" value="<?php echo $single['id'];?>">
                                                                            <input type="hidden" name="current_amount" value="<?php echo $single['user_amount'];?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="amount">Amount</label>
                                                                            <input type="number" min="0" name="student_deposit_amount" class="form-control mb-4" id="amount" placeholder="0000">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="trans_date">Bank Deposit Date</label>
                                                                            <input type="date"  name="student_deposit_date" class="form-control mb-4" id="trans_date" placeholder="12-02-2003" >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="form-group">
                                                                    <label for="profession">Bank Transaction Confirmation Slip Code</label>
                                                                    <input type="text" name="student_bank_slip_code" class="form-control mb-4" id="profession" placeholder="XXX-90787-XXX-XXXX">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="account-settings-footer">
                        
                        <div class="as-footer-container">

                            <a href="registered_students.php" type="reset" id="multiple-reset" class="btn btn-primary">Back</a>
                            <div class="blockui-growl-message">
                                <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
                            </div>
                            <button type="submit" name="update_account" id="multiple-messages" class="btn btn-success">Confirm Transaction</button>

                        </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="plugins/dropify/dropify.min.js"></script>
    <script src="plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
</body>
<?php } ?>
<!-- Mirrored from designreset.com/cork/ltr/demo4/add_meal.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 09:03:14 GMT -->
</html>