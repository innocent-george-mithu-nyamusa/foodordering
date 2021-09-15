<?php
include_once 'config/Database.php';
include_once 'class/Order.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
$order = new Order($db);

if (!$customer->loggedIn()) {
    header("Location: login.php");
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        $order->cleanOrder($_GET["id"]);
        $_SESSION["balance"] =  $_SESSION["balance"] + $_GET["ord_total"];
        $customer->updateAmount($_SESSION["balance"]);
        echo '<script>window.location="orders.php"</script>';

    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "empty") {
        $succ= $order->cleanAllOrders($_SESSION["userid"]);
        $_SESSION["balance"] =  $_SESSION["balance"] + $_GET["ord_total"];
        $customer->updateAmount($_SESSION["balance"]);
        if($succ) {
            echo '<script>window.location="orders.php"</script>';
        }

    }
}

include('inc/header.php');
?>
<title>Msu online food ordering app</title>
<?php include('inc/container.php'); ?>
<div class="content">
    <div class="container-fluid">
        <div class='row'>
            <?php include('top_menu.php'); ?>
        </div>
        <div class='row'>
            <?php
            // Get Number of Orders place by a prticular user using their id
            $numberOfitems = $order->numberOfOrders($_SESSION["userid"]);
            if ($numberOfitems > 0) {
                ?>
                <h3>Your Orders</h3>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th width="40%">Food Name</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Price Details</th>
                        <th width="15%">Order Total</th>
                        <th width="5%">Cancel Order</th>
                        <th width="5%">Collect Order</th>
                    </tr>
                    </thead>
                    <?php
                    $results = $order->myOrdersList($_SESSION["userid"]);
                    $total = 0;
                    foreach ($results as $result) {

                        ?>
                        <tr>
                            <td><?php echo $result["name"]; ?></td>
                            <td><?php echo $result["quantity"] ?></td>
                            <td>$ <?php echo $result["price"]; ?></td>
                            <td>$ <?php echo number_format($result["price"], 2); ?></td>
                            <td><a href="orders.php?action=delete&ord_total=<?php echo $result["price"];?>&id=<?php echo $result["order_id"];?>"><span
                                            class="text-danger">Cancel Order</span></a></td>
                            <td><a href="process_complete_order.php?ord_total=<?php echo $result["price"];?>&orders=<?php echo $result["order_id"]; ?>"><span
                                            class="text-danger">Collect Order</span></a></td>
                        </tr>
                        <?php
                        $total = $total + $result["price"];
                    }

                    ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right">$ <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                </table>
                <?php
                echo '<a href="orders.php?action=empty"><button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Orders</button></a>&nbsp;<a href="process_complete_order.php?order_array=array"><button class="btn btn-success pull-right"><span class="glyphicon glyphicon-share-alt"></span> Collect All Meals</button></a>';
                ?>
                <?php
            } elseif (empty($_SESSION["cart"])) {
                ?>
                <div class="container">
                    <div class="jumbotron">
                        <h3>You currently don't have any orders. Place <a href="index.php">Order Here</a> here.</h3>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<script src="admin/assets/js/scrollspyNav.js"></script>
<script src="admin/plugins/countdown/jquery.countdown.min.js"></script>
<?php include('inc/footer.php'); ?>
