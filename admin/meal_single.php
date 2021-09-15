<!DOCTYPE html>
<html lang="en">
<?php

include "../config/Database.php";

$database = new Database();
$db = $database->getConnection();


if (isset($_GET["me_id"])) {

    $id = $_GET["me_id"];

    $mealQuery = "SELECT * FROM food_items WHERE id=?";
    $mealStmt = $db->prepare($mealQuery);
    $mealStmt->bind_param("d", $id);
    $mealStmt->execute();
    $results = $mealStmt->get_result();

    foreach ($results as $result) {
        ?>
        <!-- Mirrored from designreset.com/cork/ltr/demo4/user_profile.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 08:38:12 GMT -->
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
            <title>Meal Details | MSU Online Food Ordering Dashboard</title>
            <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
            <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
            <!-- END GLOBAL MANDATORY STYLES -->

            <!--  BEGIN CUSTOM STYLE FILE  -->
            <link href="assets/css/users/user-profile.css" rel="stylesheet" type="text/css"/>
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
            <?php include "includes/sidebar.php"; ?>
            <!--  END SIDEBAR  -->

            <!--  BEGIN CONTENT AREA  -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">

                    <div class="row layout-spacing">

                        <!-- Content -->
                        <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                            <div class="user-profile layout-spacing">
                                <div class="widget-content widget-content-area">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="">Meal Details </h3>
                                        <a href="edit_meal.php?edit_meal_id=<?php echo $id ?>" class="mt-2 edit-profile">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-edit-3">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="text-center user-info">
                                        <img src="./../images/<?php echo $result["images"] ?>" height="150px"
                                             width="150px" alt="avatar">
                                        <p class=""><?php echo $result["name"] ?></p>
                                    </div>
                                    <div class="user-info-list">

                                        <div class="">
                                            <ul class="contacts-block list-unstyled">
                                                <li class="contacts-block__item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-coffee">
                                                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                                                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                                                        <line x1="6" y1="1" x2="6" y2="4"></line>
                                                        <line x1="10" y1="1" x2="10" y2="4"></line>
                                                        <line x1="14" y1="1" x2="14" y2="4"></line>
                                                    </svg> <span class="badge badge-success"><?php echo $result["meal_type"] ?></span>
                                                </li>
                                                <li class="contacts-block__item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-calendar">
                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                    </svg><span class="badge badge-primary"> <?php echo $result["meal_chef"] ?></span>
                                                </li>
                                                <li class="contacts-block__item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-map-pin">
                                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                        <circle cx="12" cy="10" r="3"></circle>
                                                    </svg><span class="badge badge-info"> <?php echo $result["meal_place"] ?> </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="education layout-spacing ">

                            </div>

                            <div class="work-experience layout-spacing ">

                            </div>

                        </div>

                        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                            <div class="skills layout-spacing ">
                                <div class="widget-content widget-content-area">
                                    <h3 class="">Meal Servings And Orders This Week</h3>
                                    <?php
                                    $collectedQuery = "SELECT * FROM food_orders WHERE item_id=? AND status='collected'";
                                    $collectedStmt = $db->prepare($collectedQuery);
                                    $collectedStmt->bind_param("d", $id);
                                    $collectedStmt->execute();
                                    $collectedStmt->store_result();
                                    $total = $collectedStmt->num_rows();
                                    $width_collected = $total;

                                    if ($total < 15) {
                                        $width_collected = 20;
                                    }

                                    echo "<h1 style='color: black;' >" . $total . "</h1>";
                                    ?>
                                    <div class="progress br-30">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                             style="width: <?php echo $width_collected; ?>%" aria-valuenow="25"
                                             aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-title"><span>Servings</span>
                                                <span><?php echo $total; ?>%</span></div>
                                        </div>
                                    </div>
                                    <?php
                                    $orderQuery = "SELECT * FROM food_orders WHERE item_id=? AND status='active'";
                                    $orderStmt = $db->prepare($orderQuery);
                                    $orderStmt->bind_param("d", $id);
                                    $orderStmt->execute();
                                    $orderStmt->store_result();
                                    $number = $orderStmt->num_rows();
                                    $width = $number;

                                    if ($number < 15) {
                                        $width = 20;
                                    }

                                    echo "<h1 style='color: black;' >" . $number . "</h1>";
                                    ?>
                                    <div class="progress br-30">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                             style="width: <?php echo $width; ?>%" aria-valuenow="25" aria-valuemin="0"
                                             aria-valuemax="100">
                                            <div class="progress-title"><span>Orders</span> <span><?php echo $number; ?>%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bio layout-spacing ">
                                <div class="widget-content widget-content-area">
                                    <h3 class="">Additional Meal Details</h3>
                                    <p><?php echo $result["description"]; ?></p>
                                    <div class="bio-skill-box">

                                        <div class="row">

                                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                                                <div class="d-flex b-skills">
                                                    <div>
                                                    </div>
                                                    <div class="">
                                                        <h5>Meal Ingredients</h5>
                                                        <p><?php echo $result["meal_ingredients"] ?></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                                                <div class="d-flex b-skills">
                                                    <div>
                                                    </div>
                                                    <div class="">
                                                        <h5>Meal Type</h5>
                                                        <p><?php echo $result["meal_type"] ?></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-5 ">

                                                <div class="d-flex b-skills">
                                                    <div>
                                                    </div>
                                                    <div class="">
                                                        <h5>Meal Is Served In</h5>
                                                        <p><?php echo $result["meal_place"] ?></p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-0 ">

                                                <div class="d-flex b-skills">
                                                    <div>
                                                    </div>
                                                    <div class="">
                                                        <h5>Meal Chef</h5>
                                                        <p><?php echo $result["meal_chef"] ?></p>
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
                <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com/">DesignReset</a>,
                            All rights reserved.</p>
                    </div>
                    <div class="footer-section f-section-2">
                        <p class="">Coded with
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-heart">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
            <!--  END CONTENT AREA  -->
        </div>
    <?Php } ?>
    <!-- END MAIN CONTAINER -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function () {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    </body>
<?php } ?>
<!-- Mirrored from designreset.com/cork/ltr/demo4/user_profile.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 08:38:38 GMT -->
</html>