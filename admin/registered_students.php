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


    if(isset($_GET["der_stud"])) {
        $up_id = $_GET["der_stud"];
        $updateQuery = "UPDATE food_customer SET status='disabled' WHERE id=?";
        $updateStmt  = $dbh->prepare($updateQuery);
        $updateStmt->bind_param("d", $up_id);
        $updateStmt->execute();

    }

 ?>
<!-- Mirrored from designreset.com/cork/ltr/demo4/registered_students.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 08:59:48 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Registered Students | MSU Food Ordering Dashboard</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->    
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
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
        <?php include "includes/sidebar.php" ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <table id="alter_pagination" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Reg Number</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th class="text-center dt-no-sorting">De-Register</th>
                                        <th>Confirm Deposit</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
                                $sql = "SELECT * FROM food_customer WHERE status='active'";
                                $stmt_ = $dbh->prepare($sql);
                                $stmt_->execute();
                                $results = $stmt_->get_result();

                                    foreach ($results as $result) {
                                ?>
                                    <tr>
                                        <td><?php echo $result["name"];?></td>
                                        <td><?php echo $result["regnumber"];?></td>
                                        <td><?php echo $result["email"];?></td>
                                        <td><?php echo $result["phone"];?></td>
                                        <td><?php echo $result["address"];?></td>
                                        <td>$<?php echo$result["user_amount"];?></td>
                                        <td class="text-center">
                                            <a href="registered_students.php?der_stud=<?php echo $result["id"];?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon table-cancel"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a>
                                        </td>
                                        <td class="text-center">
                                            <a href="confirm_transaction.php?conf_stud=<?php echo $result["id"];?>" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Confirm Deposit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Reg Number</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Amount</th>
                                        <th class="text-center dt-no-sorting">De-Register</th>
                                        <th>Confirm Deposit</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <?php  include "includes/footer.php"; ?>
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

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#alter_pagination').DataTable( {
                "pagingType": "full_numbers",
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7 
            });
        } );
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/cork/ltr/demo4/registered_students.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 08:59:48 GMT -->
</html>