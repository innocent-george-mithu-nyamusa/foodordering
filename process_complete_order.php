<?php
include_once 'config/Database.php';
include_once 'class/Customer.php';
include_once 'class/Order.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
$order = new Order($db);

if (!$customer->loggedIn()) {
    header("Location: login.php");
}
include('inc/header.php');
?>

<title>Msu online food ordering app</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">
<?php include('inc/container.php'); ?>
<div class="content">
    <div class="container-fluid">
        <div class='row'>
            <?php

            if (!empty($_GET['orders']) || !empty($_SESSION["orders_array"])) {
                ?>
                <div class="container">
                    <div class="jumbotron">

                        <h1 class="text-center" style="color: green;"><span
                                    class="glyphicon glyphicon-ok-circle"></span> Collect Your order in Time.</h1>
                    </div>
                </div>
                <br>
                <h2 id="que-message" class="text-center">Please proceed to collect your order..</h2>

                <?php
                if (isset($_GET['orders'])) {

                    $order->toCollectOrder($_GET["orders"]);

                    echo '<h3 class="text-center"><strong>Your Order Number:</strong> <span
                            style="color: blue;">' . $_GET["orders"] . '</span></h3>';


                } elseif (isset($_GET["orders_array"])) {

                    $number = $order->numberOfOrders($_SESSION["userid"]);

                    foreach ($_SESSION["orders_array"] as $order) {
                        echo '<h3 class="text-center"><strong>Your Order Number(s):</strong> <span
                            style="color: blue;">' . $order["$number"] . '</span></h3>';
                        $number = $number - 1;

                    }
                }
                ?>
                <h3 class="text-center">Enjoy our <a href="index.php">Food Zone!</a></h3>
            <?php } else { ?>
                <h3 class="text-center">Enjoy our <a href="index.php">Food Zone!</a></h3>
            <?php } ?>
        </div>
    </div>
    <script src="admin/assets/js/scrollspyNav.js"></script>
    <script src="admin/plugins/countdown/jquery.countdown.min.js"></script>
    <?php include('inc/footer.php'); ?>

