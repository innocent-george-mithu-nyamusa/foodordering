<!DOCTYPE html>
<html lang="en">
<?php session_start();


?>
<!-- Mirrored from designreset.com/cork/ltr/demo4/add_meal.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 09:03:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Add Meal | MSU Food Student Food Ordering Dashboard</title>
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
                                    <form method="post" action="includes/data/uploadMeal.php" enctype="multipart/form-data">
                                    <div id="general-info" class="section general-info" >
                                        <div class="info">
                                            <h6 class="">Meal Information</h6>
                                            <?php if(isset($_SESSION["error"]))  {
                                                ?>
                                                <div class="alert alert-arrow-right alert-icon-right alert-light-primary mb-4"
                                                     role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                                    <svg> ... </svg>
                                                    <strong>Warning!</strong> <?php echo $_SESSION["error"] ?> >
                                                </div>
                                                <?php
//                                                unset($_SESSION["error"]);
//                                                session_destroy();
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                <input type="file" id="input-file-max-fs" class="dropify" data-default-file="assets/img/burger.jpg" data-max-file-size="2M" name="image"/>
                                                                <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i>Meal Picture</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Meal Name</label>
                                                                            <input type="text" name="meal-name" class="form-control mb-4" id="fullName" placeholder="Golden Hamburger" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="profession">Ingredients</label>
                                                                    <input type="text" name="meal-ingredients" class="form-control mb-4" id="profession" placeholder="Bun, Tomatoes, Lettuce" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="about" class="section about">
                                        <div class="info">
                                            <h5 class="">Meal Description</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="form-group">
                                                        <label for="aboutBio">Description</label>
                                                        <textarea class="form-control" name="meal-description" id="aboutBio" placeholder="Tell us something interesting about the meal" rows="10" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="contact" class="section contact">
                                        <div class="info">
                                            <h5 class="">Meal Details</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="country">Meal Time</label>
                                                                <select class="form-control" id="country" name="meal-type">
                                                                    <option value="all_day">All Day</option>
                                                                    <option selected value="breakfast">BreakFast</option>
                                                                    <option value="lunch">Lunch</option>
                                                                    <option value="dinner">Dinner</option>
                                                                    <option value="brekfast_lunch">Breakfast/Lunch</option>
                                                                    <option value="brekfast_dinner">Breakfast/Dinner</option>
                                                                    <option value="lunch_dinner">Lunch/Dinner</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="place">Hall </label>
                                                                <select class="form-control" id="place" name="meal-place">
                                                                    <option value="batanai">Batanai</option>
                                                                    <option selected value="telone">Telone</option>
                                                                    <option value="china">China</option>
                                                                    <option value="japan">Japan</option>
                                                                    <option value="main_campus">Main Campus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="location">Price Per Meal</label>
                                                                <input type="number" min="0" class="form-control mb-4" id="location" placeholder="Price" name="meal-price">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="phone">Prepared By</label>
                                                                <input type="text" class="form-control mb-4" id="phone" placeholder="Write the Chef name here" name="meal-chef">
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

                            <button type="reset" id="multiple-reset" class="btn btn-primary">Reset All</button>
                            <div class="blockui-growl-message">
                                <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
                            </div>
                            <button type="submit" name="add_meal" id="multiple-messages" class="btn btn-success">Add Meal</button>

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

<!-- Mirrored from designreset.com/cork/ltr/demo4/add_meal.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 09:03:14 GMT -->
</html>