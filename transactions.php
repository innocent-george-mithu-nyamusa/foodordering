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
                <h3>All Transactions (Current Amount: <?php echo $_SESSION["balance"]; ?>)</h3>
                <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th width="40%">Transaction Name</th>
                        <th width="10%">Status</th>
                        <th width="20%">Quantity</th>
                        <th width="15%">Total</th>
                        <th width="15%">Date</th>
                    </tr>
                    </thead>
                    <?php
                    $results = $order->allTransactionsList($_SESSION["userid"]);
                    $total = 0;
                    foreach ($results as $result) {
                        ?>
                        <tr>
                            <td><?php echo $result["name"]; ?></td>
                            <td><?php echo $result["status"]; ?></td>
                            <td><?php echo $result["quantity"] ?></td>
                            <td>$ <?php echo $result["price"]; ?></td>
                            <td><?php echo $result["order_time"]; ?></td>
                        </tr>
                        <?php
                        $total = $total + $result["price"];
                    }

                    ?>
                    <tr>
                        <td colspan="3" align="right">Total Amount</td>
                        <td align="right">$ <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                </table>
                <?php
            } else {
                ?>
                <div class="container">
                    <div class="jumbotron">
                        <h3>You haven't completed any transactions yet. Place <a href="index.php">Order Here</a> here.</h3>
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
