<?php

if(!isset($orders)){
    include_once 'config/Database.php';
    include_once 'class/Order.php';

    $database = new Database();
    $db = $database->getConnection();

    $order = new Order($db);
}
if (isset($_SESSION["name"])) {
  ?>
   <ul class="nav navbar-nav navbar-right">
       <li>
           <div class="btn-group">
               <button type="button" class="btn btn-danger">Dining Hall</button>
               <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <span class="caret"></span>
                   <span class="sr-only">Toggle Dropdown</span>
               </button>
               <ul class="dropdown-menu">
                   <li><a href="index.php?hall=telone">Telone</a></li>
                   <li><a href="index.php?hall=batanai">Batanai</a></li>
                   <li><a href="index.php?hall=china">China</a></li>
                   <li><a href="index.php?hall=main_campus">Main Campus</a></li>
                   <li><a href="index.php?hall=japan">Japan</a></li>
               </ul>
           </div></li>
	<li><a href="index.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION["name"]; ?> </a></li>
       <?php
       if($order->numberOfOrders($_SESSION["userid"])){
           ?>
           <li><a href="orders.php"><span class="glyphicon glyphicon-glass"></span> Current Orders ( <?php echo $order->numberOfOrders($_SESSION["userid"]); ?> )</a></li>
           <?php
       }
       ?>
       <li><a href="transactions.php"><span class="glyphicon glyphicon-usd"></span> Balance <?php echo $_SESSION["balance"]; ?> </a></li>
	<li class="active" ><a href="index.php"><span class="glyphicon glyphicon-cutlery"></span> Food List </a></li>
	<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
	  if(isset($_SESSION["cart"])){
	  $count = count($_SESSION["cart"]); 
	  echo "$count"; 
		}
	  else
		echo "0";
	  ?>) </a></li>
       <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>

  </ul>
<?php        
}
?>