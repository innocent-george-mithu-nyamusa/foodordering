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
            <?php if (!empty($_GET['order'])) {
                $total = 0;
                $orderId = $_GET["order"];
                $orderDate = date('Y-m-d');
                $_SESSION["order_time"] = time();

                if (isset($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $keys => $values) {
                        $order->item_id = $values["item_id"];
                        $order->item_name = $values["item_name"];
                        $order->item_price = $values["item_price"];
                        $order->quantity = $values["item_quantity"];
                        $order->order_date = $orderDate;
                        $order->order_id = $_GET['order'];
                        $order->userorder = $_SESSION["name"];
                        $order->userid = $_SESSION["userid"];
                        $order->insert();
                    }

                    $_SESSION["balance"] = $_SESSION["balance"] - $_SESSION["total"];

                    $customer->updateAmount($_SESSION["balance"]);
                    unset($_SESSION["cart"]);
                    unset($_SESSION["total"]);
                }
                ?>
                <div class="container">
                    <div class="jumbotron">
                        <?php
                        $num = $order->numberOfOrdersToCollect($_SESSION["userid"]);
                        if ($num > 0) {
                            ?>
                            <li class="active">
                                <div id="cd-simple"></div>
                            </li>
                            <?php
                        } ?>
                        <h1 class="text-center" style="color: green;"><span
                                    class="glyphicon glyphicon-ok-circle"></span> Order Placed Successfully.</h1>
                    </div>
                </div>
                <br>
                <h2 id="que-message" class="text-center">Please proceed to collect your order..</h2>

                <h3 class="text-center"><strong>Your Order Number:</strong> <span
                            style="color: blue;"><?php echo $_GET['order']; ?></span></h3>

                <h3 class="text-center">Enjoy our <a href="index.php">Food Zone!</a></h3>
            <?php } else { ?>
                <h3 class="text-center">Order Failed<a href="index.php">Please Reorder!</a></h3>
                <h3 class="text-center">Enjoy our <a href="index.php">Food Zone!</a></h3>
            <?php } ?>
        </div>
    </div>
    <script src="admin/assets/js/scrollspyNav.js"></script>
    <script src="admin/plugins/countdown/jquery.countdown.min.js"></script>
    <?php include('inc/footer.php'); ?>
