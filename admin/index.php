<!DOCTYPE html>
<html lang="en">
<?php
include "../config/Database.php";

$database = new Database();
$dbh =$database->getConnection();

?>
<!-- Mirrored from designreset.com/cork/ltr/demo4/table_dt_multiple_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 08:59:45 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>All Meals | MSU Food Student Food Ordering Dashboard </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_multiple_tables.css">
    <!-- END PAGE LEVEL STYLES -->
</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->
    
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
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <table class="multi-table table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Meal Name</th>
                                        <th>Price</th>
                                        <th>Meal Description</th>
                                        <th>Meal Type</th>
                                        <th>Meal Chef</th>
                                        <th>Meal Ingredients</th>
                                        <th class="text-center dt-no-sorting">Status</th>
                                        <th class="text-center dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM food_items";
                                $stmt_ = $dbh->prepare($sql);
                                $stmt_->execute();
                                $results = $stmt_->get_result();

                                foreach ($results as $result) {
                                ?>

                                    <tr>
                                        <td><?php echo $result["name"];?></td>
                                        <td><?php echo $result["price"];?></td>
                                        <td><?php
                                            echo substr($result["description"], 0, 15). "...";
                                            ?></td>
                                        <td><?php echo $result["meal_type"];?></td>
                                        <td><?php echo $result["meal_chef"];?></td>
                                        <td><?php echo $result["meal_ingredients"];?></td>
                                        <td>
                                            <?php
                                            switch ($result["status"]){
                                                case "DISBALED":
                                                    echo '<div class="t-dot bg-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Low"></div>';
                                                    break;
                                                default:
                                                    echo '<div class="t-dot bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Normal"></div>';
                                                    break;
                                            }
                                           ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="meal_single.php?me_id=<?php echo $result["id"] ?>" class="btn btn-primary btn-sm">view</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Meal Name</th>
                                        <th>Price</th>
                                        <th>Meal Description</th>
                                        <th>Meal Type</th>
                                        <th>Meal Chef</th>
                                        <th>Meal Ingredients</th>
                                        <th class="text-center dt-no-sorting">Status</th>
                                        <th class="text-center dt-no-sorting">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com/">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
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

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('table.multi-table').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7,
                drawCallback: function () {
                    $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })
                    $('.dataTables_wrapper table').removeClass('table-striped');
                }
            });
        } );
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->

</body>

<!-- Mirrored from designreset.com/cork/ltr/demo4/table_dt_multiple_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 08:59:48 GMT -->
</html>