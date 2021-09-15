</head>
<?php

include_once 'config/Database.php';
include_once 'class/Order.php';
include_once 'class/Customer.php';

$database = new Database();
$db = $database->getConnection();

$customer = new Customer($db);
$order = new Order($db);

?>
<body class="">
<div role="navigation" class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="" class="navbar-brand">MSU Student Dining Portal</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="./index.php">Home</a></li>
              <?php
              if (!$customer->loggedIn()) {
                  ?>
                  <li class=""><a href="login.php">Login</a></li>
                  <li class=""><a href="signup.php">Sign Up</a></li>
              <?php
              }
              ?>
              <?php
              if(isset($_SESSION["userid"])) {
                  echo '<li class=""><a href="./history.php">History</a></li>';
              }
              if(isset($_GET["hall"])) {
                  echo '<li class=""><a href="">Current Hall: '.$_GET["hall"].'</a></li>';
              } else {
                  echo '<li class=""><a href="">Current Hall: Telone</a></li>';
              }
              ?>
          </ul>

        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div class="container" style="min-height:500px;">
