<?php
require_once('vendor/autoload.php');

include_once 'config/Database.php';
include_once 'class/Customer.php';
include_once 'class/invoice.php';

use Ramsey\Uuid\Uuid;

$paynow = new Paynow\Payments\Paynow(
    '12424',
    '6547891f-07e5-46e2-bcf4-f9003831ba33',
    'http://localhost/foodordering/paynow.php?gateway=paynow&received_payment=true',
    'http://localhost/foodordering/checkout.php?mke_payment=true',
    // The return url can be set at later stages. You might want to do this if you want to pass data to the return url (like the reference of the transaction)
);

$database = new Database();
$db = $database->getConnection();
$customer = new Customer($db);
$invoice = new Invoice($db);

if (!$customer->loggedIn()) {
    header("Location: login.php");
}

include('inc/header.php');

?>

<title>phpzag.com : Demo Online Food Ordering System with PHP & MySQL</title>
<link rel="stylesheet" type="text/css" href="css/foods.css">

<?php

    include('inc/container.php');

    $myuuid = Uuid::uuid4();

    $inv = "MSU ONLINE FOOD OREDRING INVOICE ". $myuuid;
    $payment = $paynow->createPayment($inv, $_SESSION["email"].'');



?>

<div class="content">
    <div class="container-fluid">

        <div class='row'>
            <?php include('top_menu.php'); ?>
        </div>
        <?php
        $orderTotal = 0;
        foreach ($_SESSION["cart"] as $keys => $values) {
            $total = ($values["item_quantity"] * $values["item_price"]);
            $payment->add($values["item_name"], $values["item_price"]);

            $orderTotal = $orderTotal + $total;
        }
        ?>
        <div class='row'>
            <div class="col-md-6">
                <h3>Delivery Address</h3>
                <?php
                $addressResult = $customer->getAddress();
                $count = 0;
                while ($address = $addressResult->fetch_assoc()) {
                    ?>
                    <p><?php echo $address["address"]; ?></p>
                    <p><strong>Phone</strong>:<?php echo $address["phone"]; ?></p>
                    <p><strong>Email</strong>:<?php echo $address["email"]; ?></p>
                    <?php
                }
                ?>
            </div>
            <?php
            $randNumber1 = rand(100000, 999999);
            $randNumber2 = rand(100000, 999999);
            $randNumber3 = rand(100000, 999999);
            $orderNumber = $randNumber1 . $randNumber2 . $randNumber3;
            ?>
            <div class="col-md-6">
                <h3>Order Summery</h3>
                <p><strong>Items</strong>: $<?php echo $orderTotal; ?></p>
                <p><strong>Delivery</strong>: $0</p>
                <p><strong>Total</strong>: $<?php echo $orderTotal; ?></p>
                <p><strong>Order Total</strong>: $<?php echo $orderTotal; ?></p>
                <?php if ($orderTotal > $_SESSION["balance"] || $_SESSION["balance"] < 0) {
                    ?>
                    <p><a href="index.php">
                            <button class="btn btn-danger">Insufficient Funds</button>
                        </a></p>
                    <?php
                } else {

                    $_SESSION["total"] = $orderTotal;
                    ?>
                    <p><a href="process_order.php?order=<?php echo $orderNumber; ?>">
                            <button class="btn btn-warning">Place Order</button>
                        </a></p>
                    <p><a href="process_order.php?mke_payment=<?php echo $orderNumber; ?>">
                            <button class="btn btn-warning">
                                <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN"
                                "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                     width="200px" height="81px" viewBox="0 0 200 81" enable-background="new 0 0 200 81"
                                     xml:space="preserve">
<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="100.4756" y1="6.2368" x2="100.4756" y2="48.1255">
    <stop offset="0" style="stop-color:#88D3E5"/>
    <stop offset="0.0675" style="stop-color:#7EC5DF"/>
    <stop offset="0.3338" style="stop-color:#5A9ECF"/>
    <stop offset="0.5345" style="stop-color:#4388C5"/>
    <stop offset="0.6452" style="stop-color:#3A80C2"/>
</linearGradient>
                                    <polygon fill="url(#SVGID_1_)"
                                             points="196.528,6.237 10,6.237 4.422,48.125 192.16,48.125 "/>
                                    <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="100.5088"
                                                    y1="7.9551" x2="100.5088" y2="46.0591">
                                        <stop offset="0" style="stop-color:#5CB3E4"/>
                                        <stop offset="0.107" style="stop-color:#4EA1D7"/>
                                        <stop offset="0.355" style="stop-color:#2F7FBF"/>
                                        <stop offset="0.5421" style="stop-color:#126DB2"/>
                                        <stop offset="0.6452" style="stop-color:#0067AD"/>
                                    </linearGradient>
                                    <polygon fill="url(#SVGID_2_)"
                                             points="194.28,7.955 11.863,7.955 6.736,46.059 190.183,46.059 "/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" stroke="#C4E1F6"
                                          stroke-width="0.5" stroke-miterlimit="10" d="
	M4.4,54.918L4.4,54.918 M2,75.006L2,75.006l2.2-19.764c0-0.081,0.2-0.162,0.2-0.243c0.4,0,29.8,0,30.6,0l-2.2,19.764
	c0,0.081,0,0.162-0.2,0.243C32.2,75.006,2.8,75.006,2,75.006"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" stroke="#C4E1F6"
                                          stroke-width="0.5" stroke-miterlimit="10" d="
	M36.85,54.918L36.85,54.918 M34.45,75.006L34.45,75.006l2.2-19.764c0-0.081,0.2-0.162,0.2-0.243c0.4,0,29.8,0,30.6,0l-2.2,19.764
	c0,0.081,0,0.162-0.2,0.243C64.65,75.006,35.25,75.006,34.45,75.006"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#F6EC13" stroke="#C4E1F6"
                                          stroke-width="0.5" stroke-miterlimit="10" d="
	M69.3,54.918L69.3,54.918 M66.9,75.006L66.9,75.006l2.2-19.764c0-0.081,0.2-0.162,0.2-0.243c0.4,0,29.801,0,30.6,0l-2.2,19.764
	c0,0.081,0,0.162-0.2,0.243C97.1,75.006,67.7,75.006,66.9,75.006"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" stroke="#C4E1F6"
                                          stroke-width="0.5" stroke-miterlimit="10" d="
	M101.75,54.918L101.75,54.918 M99.35,75.006L99.35,75.006l2.201-19.764c0-0.081,0.199-0.162,0.199-0.243c0.4,0,29.801,0,30.6,0
	l-2.199,19.764c0,0.081,0,0.162-0.2,0.243C129.551,75.006,100.15,75.006,99.35,75.006"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" stroke="#C4E1F6"
                                          stroke-width="0.5" stroke-miterlimit="10" d="
	M134.199,54.918L134.199,54.918 M131.8,75.006L131.8,75.006l2.199-19.764c0-0.081,0.2-0.162,0.2-0.243c0.399,0,29.801,0,30.6,0
	l-2.2,19.764c0,0.081,0,0.162-0.199,0.243C161.999,75.006,132.599,75.006,131.8,75.006"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" stroke="#C4E1F6"
                                          stroke-width="0.5" stroke-miterlimit="10" d="
	M166.649,54.918L166.649,54.918 M164.249,75.006L164.249,75.006l2.201-19.764c0-0.081,0.199-0.162,0.199-0.243
	c0.4,0,29.801,0,30.6,0l-2.199,19.764c0,0.081,0,0.162-0.2,0.243C194.45,75.006,165.05,75.006,164.249,75.006"/>
                                    <path fill="#010101" d="M75.553,64.285v-3.003c0-0.211,0.169-0.38,0.38-0.38c0.212,0,0.381,0.169,0.381,0.38v3.003
	c0,0.211-0.169,0.381-0.381,0.381C75.722,64.666,75.553,64.496,75.553,64.285 M77.244,64.666h-0.55
	c-0.085,0-0.126-0.043-0.085-0.127l1.312-3.214c0.085-0.212,0.296-0.338,0.55-0.338c0.211,0,0.423,0.168,0.507,0.338l0.932,2.283
	l0.931-2.283c0.084-0.212,0.296-0.338,0.55-0.338c0.21,0,0.422,0.168,0.507,0.338l1.31,3.214c0.044,0.084,0,0.127-0.083,0.127
	h-0.551c-0.042,0-0.126-0.043-0.126-0.084l-1.1-2.664l-1.1,2.664c-0.042,0.126-0.169,0.084-0.254,0.084h-0.339
	c-0.042,0-0.126-0.043-0.126-0.084l-1.101-2.664l-1.099,2.664C77.329,64.623,77.287,64.666,77.244,64.666L77.244,64.666z
	 M75.172,68.261l-2.284-2.114c-0.043-0.042-0.211-0.212-0.211-0.507c0-0.212,0.168-0.381,0.38-0.381h3.003
	c0.212,0,0.381,0.169,0.381,0.381c0,0.211-0.169,0.38-0.381,0.38h-2.115l2.284,2.114c0.043,0.043,0.212,0.211,0.212,0.508
	c0,0.212-0.169,0.381-0.381,0.381h-3.003c-0.212,0-0.38-0.169-0.38-0.381c0-0.211,0.168-0.381,0.38-0.381H75.172z M77.244,65.259
	h-0.55c-0.085,0-0.126,0.042-0.085,0.126l1.312,3.214c0.085,0.212,0.296,0.339,0.55,0.339c0.211,0,0.423-0.17,0.507-0.339
	l0.932-2.283l0.931,2.283c0.084,0.212,0.296,0.339,0.55,0.339c0.21,0,0.422-0.17,0.507-0.339l1.31-3.214
	c0.044-0.084,0-0.126-0.083-0.126h-0.551c-0.042,0-0.126,0.042-0.126,0.083l-1.1,2.665l-1.1-2.665
	c-0.042-0.126-0.169-0.083-0.254-0.083h-0.339c-0.042,0-0.126,0.042-0.126,0.083l-1.101,2.665l-1.099-2.665
	C77.329,65.301,77.287,65.259,77.244,65.259L77.244,65.259z M83.546,68.642V65.64c0-0.212,0.169-0.381,0.38-0.381
	c0.212,0,0.381,0.169,0.381,0.381v3.002c0,0.212-0.169,0.381-0.381,0.381C83.715,68.979,83.546,68.811,83.546,68.642z M84.94,65.301
	h2.707c0.212,0,0.381,0.169,0.381,0.381c0,0.211-0.169,0.38-0.381,0.38h-0.93c-0.128,0-0.212,0.127-0.212,0.212v2.368
	c0,0.212-0.169,0.381-0.38,0.381c-0.212,0-0.381-0.169-0.381-0.381v-2.368c0-0.127-0.127-0.212-0.212-0.212h-0.634
	c-0.212,0-0.381-0.169-0.381-0.38C84.519,65.47,84.729,65.301,84.94,65.301L84.94,65.301z M90.228,65.301h1.184
	c0.212,0,0.339,0.169,0.339,0.339c0,0.211-0.17,0.338-0.339,0.338h-1.563c-0.593,0-1.101,0.507-1.101,1.099v0.128
	c0,0.592,0.508,1.1,1.101,1.1h1.563c0.212,0,0.339,0.168,0.339,0.338c0,0.212-0.17,0.338-0.339,0.338h-1.607
	c-0.973,0-1.732-0.803-1.732-1.734v-0.211c0-0.973,0.803-1.733,1.732-1.733H90.228z M79.104,64.92l-0.677-1.606l-0.676,1.606
	l0.676,1.608L79.104,64.92z M81.431,63.27l-0.676,1.607l0.676,1.607l0.678-1.607L81.431,63.27z M92.089,68.642V65.64
	c0-0.212,0.169-0.339,0.338-0.339c0.212,0,0.338,0.169,0.338,0.339v0.93c0,0.127,0.128,0.211,0.211,0.211h1.438
	c0.212,0,0.339,0.169,0.339,0.339c0,0.212-0.17,0.338-0.339,0.338h-1.438c-0.126,0-0.211,0.128-0.211,0.212v0.93
	c0,0.212-0.169,0.339-0.338,0.339C92.258,68.979,92.089,68.854,92.089,68.642z M95.05,68.642V65.64c0-0.212,0.169-0.381,0.38-0.381
	s0.381,0.169,0.381,0.381v3.002c0,0.212-0.17,0.381-0.381,0.381C95.219,68.979,95.05,68.811,95.05,68.642z M73.818,61.662
	l-2.283,2.116c-0.042,0.042-0.212,0.212-0.212,0.507c0,0.211,0.17,0.381,0.381,0.381h3.002c0.213,0,0.382-0.17,0.382-0.381
	s-0.169-0.382-0.382-0.382h-2.114l2.283-2.114c0,0,0.213-0.211,0.213-0.507c0-0.211-0.169-0.38-0.382-0.38h-3.002
	c-0.211,0-0.381,0.169-0.381,0.38c0,0.212,0.17,0.38,0.381,0.38H73.818z"/>
                                    <g>
                                        <path fill="#E82140" d="M174.009,63.186h0.547c0.421,0,0.801,0.337,0.801,0.801v2.992c0,0.464,0.59,0.421,0.8,0.379
		c0,0.21,0.043,0.38-0.042,0.548c-0.168,0.801-1.517,0.588-1.896,0c-0.21-0.295-0.253-0.717-0.253-1.18v-3.54H174.009
		L174.009,63.186z M168.868,63.564h0.083v0.929h1.096c0.042,0.42,0.042,1.053-0.633,1.053h-0.506v1.516
		c0,0.422,0.716,0.381,1.055,0.254c0.041,0.506-0.041,0.758-0.253,0.926c-0.422,0.339-1.307,0.213-1.687-0.168
		c-0.209-0.211-0.378-0.59-0.378-1.053v-2.191C167.688,64.111,168.235,63.564,168.868,63.564 M173.545,67.23
		c0.083,0.591-0.126,0.885-0.506,1.054c-0.632,0.253-1.645,0.209-2.192-0.211c-0.42-0.336-0.632-0.758-0.674-1.264
		c-0.126-0.885,0.21-1.728,0.971-2.149c0.251-0.128,0.505-0.211,0.715-0.253c0.758-0.085,1.518,0.253,1.813,0.969
		c0.084,0.211,0.127,0.422,0.127,0.632c-0.043,0.591-0.422,0.76-0.929,0.843c-0.379,0.043-0.883,0.043-1.516,0.043
		C171.395,67.737,173.164,67.61,173.545,67.23L173.545,67.23z"/>
                                        <path fill="#FFFFFF" d="M171.354,66.051c0.041-0.253,0.168-0.464,0.295-0.59c0.127-0.127,0.338-0.169,0.505-0.127
		c0.421,0.042,0.76,0.591,0.043,0.674C171.942,66.094,171.605,66.051,171.354,66.051"/>
                                        <path fill="#E82140" d="M179.57,67.23c0.084,0.591-0.127,0.885-0.506,1.054c-0.632,0.253-1.645,0.209-2.192-0.211
		c-0.42-0.336-0.631-0.758-0.673-1.264c-0.126-0.885,0.21-1.728,0.969-2.149c0.252-0.128,0.507-0.211,0.716-0.253
		c0.759-0.085,1.517,0.253,1.813,0.969c0.084,0.211,0.125,0.422,0.125,0.632c-0.041,0.591-0.422,0.76-0.926,0.843
		c-0.38,0.043-0.885,0.043-1.517,0.043C177.462,67.737,179.189,67.61,179.57,67.23L179.57,67.23z"/>
                                        <path fill="#FFFFFF" d="M177.38,66.051c0.04-0.253,0.168-0.464,0.295-0.59c0.126-0.127,0.337-0.169,0.504-0.127
		c0.424,0.042,0.76,0.591,0.043,0.674C177.97,66.094,177.632,66.051,177.38,66.051"/>
                                        <path fill="#010101" d="M182.729,68.284v-0.885c-0.631,0.294-1.137,0.211-1.348-0.127c-0.422-0.547-0.124-1.39,0.422-1.727
		c0.336-0.254,0.8-0.296,1.221-0.128c0.085-0.295,0.212-0.589,0.254-0.886c-0.38-0.167-1.812-0.251-2.654,0.718
		c-0.716,0.801-0.927,2.36,0.126,2.991C181.214,68.537,181.888,68.58,182.729,68.284"/>
                                        <path fill="#010101" d="M185.385,67.693c0,0.212-0.041,0.422,0,0.675h1.013c0.041-1.39,0.294-2.57,0.505-3.836
		c-1.223-0.421-2.992-0.125-3.708,1.224c-0.336,0.675-0.506,1.896,0.168,2.445C183.91,68.662,184.754,68.537,185.385,67.693z"/>
                                        <path fill="#FFFFFF" d="M185.638,65.292c-1.01-0.21-1.98,1.349-1.474,2.065c0.125,0.21,0.421,0.336,0.716,0.126
		c0.084-0.041,0.21-0.126,0.253-0.253C185.47,66.768,185.513,65.798,185.638,65.292"/>
                                        <path fill="#010101" d="M189.851,68.454l1.098-5.774h1.138l-0.421,2.317c0.589-0.548,1.053-0.675,1.432-0.59
		c1.054,0.169,0.886,1.265,0.758,2.065c-0.126,0.676-0.421,1.39-0.377,1.981h-1.181c0.126-0.592,0.21-1.139,0.337-1.687
		c0.042-0.253,0.126-0.59,0.126-0.885c0-1.054-1.139-0.591-1.391,0.674l-0.337,1.937L189.851,68.454z"/>
                                        <path fill="#E82140" d="M188.629,67.188c0.043-0.632-0.42-0.969-0.378-1.348c0.042-0.675,0.927-0.675,1.391-0.507l-0.128,0.253
		l0.802-0.337l-0.211-0.885l-0.126,0.254c-0.421-0.254-1.138-0.297-1.728-0.087c-0.675,0.255-1.18,1.014-0.758,1.688
		C187.787,66.683,188.378,66.768,188.629,67.188"/>
                                        <path fill="#231F20" d="M188.504,65.714c-0.042,0.294,0.125,0.549,0.211,0.717c0.675,1.18-0.633,1.348-1.518,1.053l0.125-0.253
		l-0.799,0.337l0.211,0.887l0.125-0.253c0.212,0.125,0.59,0.21,0.97,0.253c0.717,0.039,1.433-0.043,1.813-0.717
		c0.209-0.338,0.209-0.759,0-1.139C189.39,66.136,188.798,66.136,188.504,65.714"/>
                                    </g>
                                    <g>
                                        <path fill="#2C2A29" d="M45.194,70.186c-0.042-0.043-0.127-0.084-0.169-0.127c-0.042-0.043-0.125-0.043-0.211-0.043h-0.126
		l-0.127,0.043l-0.127,0.084l-0.126,0.127c-0.042-0.084-0.127-0.127-0.211-0.211c-0.085-0.043-0.169-0.043-0.254-0.043h-0.126
		l-0.128,0.043l-0.126,0.043c-0.042,0.041-0.042,0.041-0.085,0.126v-0.169H43.08v1.354h0.295V70.65c0-0.042,0-0.126,0.043-0.169
		c0.042-0.042,0.042-0.085,0.084-0.126c0.042-0.042,0.084-0.042,0.127-0.086c0.042-0.042,0.085-0.042,0.127-0.042
		c0.127,0,0.169,0.042,0.211,0.086c0.041,0.042,0.084,0.168,0.084,0.253v0.76h0.296v-0.76c0-0.042,0-0.127,0.042-0.17
		c0.042-0.041,0.042-0.083,0.085-0.127c0.042-0.042,0.084-0.042,0.126-0.084c0.043-0.043,0.084-0.043,0.126-0.043
		c0.127,0,0.17,0.043,0.211,0.085c0.043,0.042,0.084,0.169,0.084,0.254v0.762h0.297v-0.888c0-0.086,0-0.17-0.043-0.213
		L45.194,70.186 M46.759,70.228c-0.042-0.042-0.127-0.126-0.211-0.126c-0.085-0.043-0.17-0.043-0.255-0.043
		c-0.126,0-0.211,0.043-0.253,0.043c-0.085,0.041-0.17,0.084-0.211,0.126c-0.043,0.042-0.128,0.128-0.128,0.212
		c-0.042,0.085-0.042,0.211-0.042,0.296c0,0.126,0.042,0.211,0.042,0.296c0.043,0.084,0.085,0.17,0.128,0.212
		c0.042,0.042,0.126,0.127,0.211,0.127c0.083,0.043,0.169,0.043,0.253,0.043c0.085,0,0.212-0.043,0.255-0.043
		c0.084-0.044,0.126-0.085,0.211-0.127v0.17h0.295v-1.354h-0.295V70.228z M46.759,70.946c-0.042,0.043-0.042,0.128-0.084,0.128
		c-0.042,0-0.085,0.084-0.126,0.084c-0.043,0.043-0.128,0.043-0.17,0.043c-0.042,0-0.126,0-0.169-0.043l-0.127-0.084
		c-0.042-0.043-0.042-0.085-0.084-0.128s-0.042-0.126-0.042-0.169c0-0.042,0-0.127,0.042-0.169s0.042-0.127,0.084-0.127
		c0.041-0.042,0.084-0.085,0.127-0.085c0.042-0.041,0.126-0.041,0.169-0.041c0.042,0,0.127,0,0.17,0.041l0.126,0.085
		c0.042,0.043,0.042,0.085,0.084,0.127s0.042,0.127,0.042,0.169C46.802,70.82,46.759,70.861,46.759,70.946z M48.45,70.735
		c-0.126-0.085-0.212-0.127-0.338-0.127l-0.127-0.042c-0.042,0-0.042,0-0.085-0.042l-0.085-0.043l-0.042-0.042h-0.084
		c0-0.043,0.043-0.084,0.043-0.126c0.041-0.044,0.126-0.044,0.21-0.044h0.127c0.042,0,0.084,0.044,0.126,0.044l0.127,0.042
		c0.042,0.041,0.042,0.041,0.084,0.041l0.127-0.254l-0.253-0.127c-0.127-0.041-0.211-0.041-0.296-0.041s-0.17,0-0.252,0.041
		c-0.085,0.043-0.128,0.043-0.212,0.086l-0.126,0.126c-0.043,0.042-0.043,0.128-0.043,0.212c0,0.127,0.043,0.211,0.126,0.254
		c0.085,0.084,0.212,0.127,0.338,0.127l0.127,0.041c0.084,0,0.127,0.042,0.212,0.042c0.042,0.043,0.042,0.043,0.042,0.128
		c0,0.084-0.042,0.084-0.084,0.127c-0.042,0.043-0.127,0.043-0.253,0.043h-0.17c-0.042,0-0.085-0.043-0.127-0.043
		s-0.085-0.043-0.126-0.043l-0.085-0.041l-0.126,0.211l0.169,0.085l0.168,0.043c0.042,0,0.127,0.041,0.127,0.041h0.126
		c0.127,0,0.212,0,0.255-0.041c0.084-0.043,0.126-0.043,0.211-0.087l0.126-0.125c0.042-0.043,0.042-0.127,0.042-0.212
		C48.535,70.903,48.535,70.82,48.45,70.735 M51.242,70.228c-0.042-0.042-0.127-0.126-0.211-0.126
		c-0.084-0.043-0.169-0.043-0.254-0.043c-0.127,0-0.211,0.043-0.253,0.043c-0.084,0.041-0.169,0.084-0.212,0.126
		c-0.041,0.042-0.126,0.128-0.126,0.212c-0.042,0.085-0.042,0.211-0.042,0.296c0,0.126,0.042,0.211,0.042,0.296
		c0.042,0.084,0.085,0.17,0.126,0.212c0.043,0.042,0.127,0.127,0.212,0.127c0.085,0.043,0.212,0.043,0.253,0.043
		c0.127,0,0.211-0.043,0.297-0.043c0.084-0.044,0.211-0.085,0.254-0.169L51.2,70.989c-0.042,0.042-0.127,0.085-0.212,0.126
		c-0.084,0.043-0.126,0.043-0.211,0.043c-0.041,0-0.127,0-0.127-0.043c-0.042,0-0.084-0.041-0.126-0.041
		c-0.042-0.043-0.042-0.043-0.084-0.128c-0.042-0.043-0.042-0.126-0.042-0.169h1.015V70.65c0-0.126-0.043-0.211-0.043-0.295
		C51.327,70.355,51.284,70.313,51.242,70.228 M50.396,70.65l0.042-0.126c0.042-0.043,0.042-0.085,0.084-0.128
		c0.042-0.041,0.085-0.041,0.126-0.083c0.043-0.044,0.086-0.044,0.127-0.044c0.127,0,0.17,0.044,0.254,0.086
		c0.043,0.041,0.127,0.126,0.127,0.253L50.396,70.65L50.396,70.65z M55.218,70.228c-0.042-0.042-0.127-0.126-0.212-0.126
		c-0.083-0.043-0.169-0.043-0.254-0.043c-0.126,0-0.211,0.043-0.253,0.043c-0.084,0.041-0.169,0.084-0.211,0.126
		s-0.127,0.128-0.127,0.212c-0.042,0.085-0.042,0.211-0.042,0.296c0,0.126,0.042,0.211,0.042,0.296
		c0.043,0.084,0.085,0.17,0.127,0.212s0.127,0.127,0.211,0.127c0.084,0.043,0.169,0.043,0.253,0.043
		c0.127,0,0.211-0.043,0.254-0.043c0.085-0.044,0.128-0.085,0.212-0.127v0.17h0.295v-1.354h-0.295V70.228z M55.218,70.946
		c-0.042,0.043-0.042,0.128-0.084,0.128c-0.043,0.041-0.085,0.084-0.128,0.084c-0.042,0.043-0.126,0.043-0.169,0.043
		c-0.042,0-0.126,0-0.168-0.043l-0.127-0.084c-0.042-0.043-0.042-0.085-0.084-0.128c-0.042-0.043-0.042-0.126-0.042-0.169
		c0-0.042,0-0.127,0.042-0.169c0.042-0.042,0.042-0.127,0.084-0.127c0.042-0.042,0.084-0.085,0.127-0.085
		c0.042-0.041,0.126-0.041,0.168-0.041c0.043,0,0.127,0,0.169,0.041l0.128,0.085c0.042,0.042,0.042,0.085,0.084,0.127
		s0.042,0.127,0.042,0.169C55.26,70.82,55.26,70.861,55.218,70.946z M49.719,71.201c-0.042,0.042-0.126,0.042-0.126,0.042
		c-0.043,0-0.043,0-0.085-0.042c-0.042,0-0.042-0.043-0.084-0.043l-0.042-0.084l-0.042-0.128v-0.591h0.508v-0.254h-0.508v-0.424
		h-0.295v0.424H48.79v0.254h0.254v0.591c0,0.212,0.041,0.339,0.126,0.424c0.084,0.084,0.212,0.127,0.339,0.127
		c0.085,0,0.169,0,0.254-0.043l0.126-0.041l-0.126-0.255C49.805,71.158,49.763,71.158,49.719,71.201 M52.426,70.016
		c-0.084,0-0.168,0-0.211,0.043c-0.084,0.043-0.127,0.084-0.169,0.169v-0.212h-0.254v1.354h0.254v-0.762
		c0-0.042,0-0.127,0.042-0.169c0.042-0.043,0.042-0.084,0.042-0.126c0.042-0.044,0.084-0.044,0.127-0.086
		c0.042-0.042,0.084-0.042,0.127-0.042h0.127c0.041,0,0.041,0,0.041,0.042l0.085-0.296l-0.085-0.042
		C52.511,70.016,52.511,70.016,52.426,70.016 M56.613,70.016c-0.084,0-0.168,0.043-0.211,0.043
		c-0.084,0.043-0.127,0.084-0.169,0.169v-0.212h-0.253v1.354h0.253v-0.762c0-0.042,0-0.127,0.042-0.169
		c0.042-0.043,0.042-0.084,0.042-0.126c0.042-0.044,0.084-0.044,0.127-0.086c0.042-0.042,0.084-0.042,0.126-0.042h0.126
		c0.042,0,0.042,0,0.042,0.042l0.084-0.296L56.74,69.89C56.697,70.016,56.655,70.016,56.613,70.016 M58.009,69.509v0.719
		c-0.043-0.042-0.127-0.126-0.212-0.126c-0.084-0.043-0.169-0.043-0.253-0.043c-0.127,0-0.212,0.043-0.254,0.043
		c-0.084,0.041-0.169,0.084-0.212,0.126c-0.041,0.042-0.125,0.128-0.125,0.212c-0.043,0.085-0.043,0.211-0.043,0.296
		c0,0.126,0.043,0.211,0.043,0.296c0.042,0.084,0.084,0.17,0.125,0.212c0.043,0.042,0.127,0.127,0.212,0.127
		c0.085,0.043,0.169,0.043,0.254,0.043c0.084,0,0.211-0.043,0.253-0.043c0.085-0.044,0.127-0.085,0.212-0.127v0.17h0.295v-1.946
		L58.009,69.509z M58.009,70.946c-0.043,0.043-0.043,0.128-0.085,0.128c-0.042,0.041-0.085,0.084-0.127,0.084
		c-0.042,0.043-0.125,0.043-0.169,0.043c-0.042,0-0.126,0-0.169-0.043l-0.127-0.084c-0.042-0.043-0.042-0.085-0.084-0.128
		c-0.043-0.043-0.043-0.126-0.043-0.169c0-0.042,0-0.127,0.043-0.169c0.042-0.042,0.042-0.127,0.084-0.127
		c0.042-0.042,0.084-0.085,0.127-0.085c0.042-0.041,0.127-0.041,0.169-0.041c0.043,0,0.127,0,0.169,0.041l0.127,0.085
		c0.042,0.043,0.042,0.085,0.085,0.127c0.041,0.042,0.041,0.127,0.041,0.169C58.009,70.82,58.009,70.861,58.009,70.946z
		 M53.145,70.439c0.042-0.043,0.085-0.084,0.126-0.084c0.042-0.042,0.127-0.042,0.17-0.042c0.043,0,0.127,0,0.211,0.042
		c0.042,0.041,0.127,0.041,0.127,0.084l0.127-0.254c-0.042-0.043-0.127-0.084-0.211-0.127c-0.084-0.043-0.21-0.043-0.296-0.043
		c-0.085,0-0.212,0.043-0.296,0.043c-0.084,0.043-0.169,0.084-0.253,0.169c-0.042,0.042-0.127,0.128-0.17,0.212
		c-0.042,0.085-0.042,0.211-0.042,0.296c0,0.126,0.042,0.211,0.042,0.296c0.043,0.084,0.085,0.17,0.17,0.212
		c0.041,0.042,0.126,0.127,0.253,0.17c0.084,0.041,0.211,0.041,0.296,0.041c0.085,0,0.212-0.041,0.296-0.041
		c0.042-0.043,0.127-0.043,0.211-0.128l-0.127-0.254l-0.127,0.084c-0.042,0.043-0.127,0.043-0.211,0.043
		c-0.042,0-0.127,0-0.17-0.043c-0.042-0.041-0.126-0.041-0.126-0.084c-0.042-0.042-0.084-0.085-0.084-0.128
		c-0.042-0.042-0.042-0.126-0.042-0.21c0-0.085,0-0.127,0.042-0.212C53.103,70.524,53.145,70.481,53.145,70.439 M58.939,71.243
		h0.042l0.042,0.042l0.042,0.041v0.128l-0.042,0.043l-0.042,0.042h-0.126l-0.043-0.042l-0.043-0.043v-0.128l0.043-0.041l0.043-0.042
		H58.939 M58.939,71.497c0.042,0,0.042,0,0.042-0.043l0.042-0.041V71.37c0,0,0-0.044-0.042-0.044l-0.042-0.041h-0.042
		c0,0-0.042,0-0.042,0.041l-0.043,0.044v0.043c0,0,0,0.041,0.043,0.041L58.939,71.497L58.939,71.497z M58.939,71.326l0.042,0.044
		h-0.042l0.042,0.043h-0.042l-0.042-0.043v0.043h-0.042v-0.128L58.939,71.326L58.939,71.326z"/>
                                        <path fill="#F4A01E" d="M58.813,66.463v-0.168H58.77V66.21h0.17v0.041h-0.042v0.171h-0.084V66.463z M59.108,66.463v-0.126
		l-0.042,0.126h-0.042l-0.042-0.126v0.126h-0.042v-0.212h0.042l0.042,0.129l0.042-0.129h0.042V66.463z"/>
                                        <path fill="#E32528" d="M47.521,58.386c2.876,0,5.202,2.326,5.202,5.202c0,2.875-2.326,5.201-5.202,5.201
		c-2.875,0-5.203-2.326-5.203-5.201C42.361,60.712,44.687,58.386,47.521,58.386"/>
                                        <path fill="#F4A01E" d="M53.991,58.386c2.875,0,5.203,2.326,5.203,5.202c0,2.875-2.328,5.201-5.203,5.201
		c-2.876,0-5.201-2.326-5.201-5.201C48.79,60.712,51.115,58.386,53.991,58.386"/>
                                        <path fill="#EB6424" d="M50.735,59.528c1.183,0.973,1.987,2.411,1.987,4.06c0,1.649-0.761,3.13-1.987,4.06
		c-1.185-0.973-1.989-2.41-1.989-4.06C48.79,61.939,49.55,60.501,50.735,59.528"/>
                                    </g>
                                    <g>
                                        <polygon fill="#2A2A6E"
                                                 points="14.172,69.082 16.202,69.082 17.852,61.258 15.822,61.258 	"/>
                                        <path fill="#2A2A6E" d="M17.937,67.094c-0.085,0.128-0.381,1.522-0.381,1.733c1.522,0.635,4.186,0.678,5.328-0.803
		c0.339-0.422,0.593-1.143,0.424-1.859c-0.254-1.27-1.692-1.608-2.454-2.201c-0.803-0.592,0-1.438,1.65-1.1
		c0.38,0.086,0.592,0.211,0.888,0.297l0.338-1.649c-0.719-0.213-1.099-0.338-1.988-0.338c-1.183,0-2.537,0.464-3.087,1.563
		c-0.676,1.312,0,2.369,1.184,3.004c0.423,0.211,1.227,0.549,1.354,0.972c0.211,0.72-0.761,0.973-1.354,0.931
		C18.698,67.476,18.613,67.263,17.937,67.094z"/>
                                        <path fill="#2A2A6E" d="M5.46,61.343v0.127c0.592,0.085,1.733,0.465,2.157,0.761c0.253,0.212,0.338,0.592,0.422,1.015l1.184,4.652
		c0.084,0.381,0.211,0.805,0.296,1.185h2.115c0.169-0.339,1.479-3.511,1.648-3.934l1.228-2.918c0.084-0.212,0.338-0.805,0.423-0.973
		h-2.114l-2.115,5.286c-0.127-0.168-0.719-3.849-0.846-4.398c-0.212-0.931-0.804-0.888-1.734-0.888c-0.846,0-1.776-0.043-2.622,0
		L5.46,61.343z"/>
                                        <path fill="#2A2A6E" d="M30.539,69.082v-0.044l-1.649-7.78c-0.507-0.043-1.141,0-1.649,0c-0.592,0-0.804,0.254-0.974,0.72
		c-0.21,0.422-2.959,7.021-2.959,7.146h2.114l0.424-1.184h2.579c0.084,0.211,0.127,0.507,0.169,0.676
		c0.127,0.551,0.042,0.508,0.339,0.508C29.398,69.082,29.989,69.082,30.539,69.082L30.539,69.082z M26.395,66.29
		c0.042-0.169,0.972-2.79,1.057-2.875l0.592,2.875H26.395"/>
                                    </g>
                                    <g>
                                        <path fill="#195DA9" d="M106.298,64.01h-2.019v1.088h1.863c0.155,0,0.232,0.039,0.31,0.077c0.079,0.079,0.118,0.155,0.118,0.234
		c0,0.077-0.039,0.193-0.118,0.232c-0.077,0.078-0.154,0.078-0.31,0.078h-1.863v1.281h2.096c0.156,0,0.233,0.039,0.311,0.116
		c0.078,0.078,0.117,0.155,0.117,0.271s-0.039,0.195-0.117,0.272c-0.077,0.077-0.193,0.116-0.311,0.116h-2.445
		c-0.194,0-0.35-0.039-0.428-0.116s-0.117-0.233-0.117-0.429v-3.338c0-0.117,0.039-0.233,0.039-0.311
		c0.04-0.078,0.117-0.155,0.195-0.195c0.076-0.037,0.193-0.037,0.311-0.037h2.368c0.154,0,0.233,0.037,0.311,0.077
		c0.077,0.077,0.116,0.155,0.116,0.232c0,0.079-0.039,0.194-0.116,0.272C106.531,63.972,106.415,64.01,106.298,64.01z"/>
                                        <path fill="#195DA9" d="M110.22,66.807c0,0.116-0.04,0.194-0.077,0.311c-0.078,0.115-0.156,0.233-0.273,0.351
		c-0.154,0.116-0.31,0.193-0.465,0.271c-0.194,0.079-0.428,0.116-0.66,0.116c-0.505,0-0.893-0.155-1.204-0.466
		c-0.271-0.311-0.427-0.697-0.427-1.203c0-0.35,0.078-0.622,0.195-0.894c0.115-0.271,0.31-0.467,0.582-0.622
		c0.232-0.153,0.543-0.233,0.893-0.233c0.193,0,0.389,0.041,0.582,0.08c0.194,0.077,0.35,0.153,0.467,0.232
		c0.115,0.116,0.232,0.194,0.271,0.311c0.076,0.115,0.116,0.232,0.116,0.311c0,0.077-0.04,0.193-0.116,0.271
		c-0.077,0.078-0.156,0.116-0.271,0.116c-0.078,0-0.117,0-0.156-0.038c-0.076-0.039-0.116-0.117-0.154-0.156
		c-0.117-0.154-0.195-0.271-0.312-0.35c-0.117-0.077-0.233-0.116-0.427-0.116c-0.232,0-0.428,0.077-0.584,0.272
		c-0.154,0.193-0.232,0.466-0.232,0.776c0,0.155,0.039,0.311,0.039,0.426c0.039,0.119,0.078,0.234,0.156,0.351
		c0.077,0.078,0.154,0.155,0.271,0.194s0.232,0.078,0.35,0.078c0.155,0,0.31-0.039,0.427-0.117c0.116-0.077,0.233-0.194,0.312-0.35
		c0.038-0.077,0.116-0.156,0.154-0.232c0.078-0.039,0.156-0.078,0.233-0.078c0.117,0,0.194,0.039,0.233,0.117
		C110.18,66.651,110.22,66.729,110.22,66.807z"/>
                                        <path fill="#195DA9" d="M113.831,66.146c0,0.233-0.04,0.466-0.116,0.7c-0.078,0.193-0.194,0.386-0.351,0.542
		c-0.155,0.155-0.31,0.272-0.503,0.35c-0.195,0.079-0.428,0.116-0.701,0.116c-0.232,0-0.465-0.037-0.659-0.116
		c-0.388-0.154-0.698-0.466-0.854-0.892c-0.078-0.234-0.116-0.467-0.116-0.7c0-0.232,0.038-0.466,0.116-0.699
		c0.078-0.193,0.194-0.388,0.35-0.543s0.311-0.272,0.505-0.351c0.233-0.076,0.427-0.117,0.659-0.117
		c0.234,0,0.467,0.041,0.701,0.117c0.387,0.156,0.697,0.467,0.854,0.894C113.791,65.681,113.831,65.914,113.831,66.146z
		 M113.016,66.146c0-0.35-0.078-0.583-0.232-0.776c-0.156-0.195-0.35-0.272-0.583-0.272c-0.155,0-0.311,0.039-0.427,0.116
		c-0.117,0.078-0.233,0.195-0.272,0.389c-0.077,0.155-0.116,0.35-0.116,0.583c0,0.232,0.039,0.387,0.116,0.581
		c0.078,0.156,0.155,0.273,0.272,0.39c0.116,0.076,0.271,0.116,0.427,0.116c0.233,0,0.466-0.077,0.583-0.271
		C112.938,66.729,113.016,66.496,113.016,66.146z"/>
                                        <path fill="#EB2629" d="M118.141,66.341c0,0.155-0.038,0.311-0.115,0.466c-0.078,0.155-0.195,0.311-0.312,0.466
		c-0.155,0.155-0.349,0.271-0.582,0.389c-0.233,0.116-0.505,0.156-0.815,0.156c-0.232,0-0.428-0.04-0.621-0.079
		c-0.195-0.039-0.352-0.117-0.506-0.194c-0.155-0.116-0.311-0.232-0.428-0.388c-0.116-0.155-0.232-0.31-0.311-0.465
		c-0.076-0.195-0.154-0.351-0.193-0.545s-0.077-0.427-0.077-0.62c0-0.352,0.038-0.661,0.155-0.973
		c0.078-0.271,0.232-0.505,0.466-0.737c0.194-0.194,0.427-0.35,0.698-0.465c0.272-0.118,0.545-0.156,0.855-0.156
		c0.349,0,0.697,0.077,0.97,0.233c0.271,0.155,0.505,0.312,0.66,0.543c0.155,0.194,0.233,0.428,0.233,0.582
		c0,0.116-0.039,0.195-0.116,0.271c-0.077,0.079-0.155,0.118-0.272,0.118c-0.116,0-0.194-0.039-0.271-0.078
		c-0.039-0.04-0.116-0.155-0.193-0.271c-0.117-0.233-0.273-0.389-0.428-0.505c-0.156-0.117-0.35-0.155-0.582-0.155
		c-0.389,0-0.66,0.155-0.894,0.427s-0.312,0.699-0.312,1.203c0,0.351,0.039,0.622,0.156,0.854c0.078,0.233,0.232,0.389,0.426,0.505
		c0.195,0.117,0.389,0.155,0.623,0.155c0.271,0,0.465-0.077,0.658-0.194c0.195-0.117,0.312-0.312,0.389-0.582
		c0.04-0.116,0.078-0.195,0.156-0.271c0.038-0.079,0.155-0.117,0.271-0.117c0.117,0,0.195,0.038,0.272,0.117
		C118.103,66.146,118.141,66.263,118.141,66.341L118.141,66.341z"/>
                                        <path fill="#EB2629" d="M120.819,67.351c-0.193,0.154-0.388,0.271-0.582,0.349s-0.388,0.118-0.622,0.118
		c-0.193,0-0.387-0.04-0.543-0.118s-0.271-0.194-0.389-0.349c-0.077-0.155-0.115-0.311-0.115-0.467c0-0.232,0.078-0.427,0.232-0.582
		c0.155-0.155,0.35-0.271,0.582-0.311c0.039,0,0.194-0.039,0.39-0.077c0.194-0.039,0.388-0.078,0.543-0.117l0.466-0.116
		c0-0.233-0.039-0.389-0.117-0.467c-0.077-0.116-0.232-0.154-0.466-0.154c-0.194,0-0.349,0.038-0.466,0.077
		c-0.117,0.038-0.193,0.155-0.271,0.272c-0.039,0.077-0.116,0.154-0.155,0.232c-0.039,0.039-0.116,0.039-0.193,0.039
		c-0.079,0-0.196-0.039-0.233-0.078c-0.078-0.039-0.117-0.155-0.117-0.232c0-0.156,0.039-0.272,0.154-0.427
		c0.117-0.156,0.273-0.233,0.467-0.35c0.232-0.077,0.506-0.116,0.815-0.116c0.351,0,0.661,0.039,0.854,0.116
		c0.194,0.076,0.35,0.231,0.428,0.427c0.078,0.193,0.117,0.427,0.117,0.737v0.971c0,0.155,0.038,0.312,0.077,0.504
		c0.038,0.156,0.077,0.272,0.077,0.312c0,0.077-0.039,0.155-0.116,0.233c-0.077,0.077-0.155,0.116-0.272,0.116
		c-0.077,0-0.155-0.039-0.232-0.116C120.977,67.621,120.896,67.505,120.819,67.351L120.819,67.351z M120.742,66.146
		c-0.116,0.039-0.311,0.078-0.544,0.155c-0.231,0.039-0.388,0.078-0.466,0.116c-0.076,0.039-0.193,0.078-0.271,0.154
		c-0.078,0.079-0.116,0.156-0.116,0.274c0,0.115,0.038,0.231,0.155,0.31c0.077,0.076,0.232,0.116,0.389,0.116
		c0.154,0,0.31-0.04,0.466-0.116c0.155-0.078,0.232-0.155,0.31-0.272c0.078-0.117,0.117-0.349,0.117-0.621L120.742,66.146
		L120.742,66.146z"/>
                                        <path fill="#EB2629" d="M124.858,66.729c0,0.233-0.04,0.428-0.155,0.583c-0.117,0.156-0.271,0.272-0.504,0.388
		c-0.234,0.078-0.467,0.118-0.777,0.118s-0.545-0.04-0.777-0.156c-0.193-0.077-0.388-0.193-0.465-0.35
		c-0.117-0.155-0.156-0.271-0.156-0.428c0-0.077,0.039-0.155,0.117-0.232c0.077-0.079,0.155-0.116,0.232-0.116
		c0.078,0,0.154,0.037,0.193,0.077c0.04,0.039,0.078,0.116,0.117,0.194c0.077,0.155,0.193,0.271,0.311,0.35
		c0.117,0.076,0.271,0.116,0.467,0.116c0.155,0,0.311-0.04,0.387-0.116c0.117-0.078,0.157-0.155,0.157-0.272
		c0-0.155-0.04-0.232-0.157-0.312c-0.115-0.076-0.31-0.115-0.543-0.192c-0.271-0.078-0.504-0.155-0.698-0.233
		c-0.155-0.077-0.311-0.155-0.427-0.311c-0.117-0.116-0.156-0.272-0.156-0.466c0-0.156,0.039-0.311,0.156-0.466
		c0.116-0.155,0.232-0.272,0.427-0.351c0.194-0.076,0.427-0.117,0.698-0.117c0.233,0,0.389,0.041,0.583,0.08
		c0.155,0.037,0.312,0.115,0.427,0.193c0.117,0.077,0.194,0.155,0.271,0.233c0.078,0.077,0.078,0.193,0.078,0.271
		c0,0.078-0.039,0.156-0.078,0.233c-0.077,0.079-0.154,0.079-0.271,0.079c-0.078,0-0.155-0.04-0.232-0.079
		c-0.077-0.077-0.156-0.155-0.194-0.233c-0.077-0.077-0.116-0.154-0.233-0.193c-0.076-0.04-0.193-0.077-0.35-0.077
		c-0.154,0-0.271,0.037-0.388,0.077c-0.116,0.077-0.156,0.154-0.156,0.233c0,0.076,0.04,0.155,0.116,0.232
		c0.078,0.04,0.156,0.116,0.312,0.155s0.312,0.078,0.505,0.116c0.271,0.078,0.466,0.156,0.621,0.233
		c0.155,0.078,0.271,0.194,0.389,0.311C124.818,66.457,124.858,66.612,124.858,66.729L124.858,66.729z"/>
                                        <path fill="#EB2629" d="M126.178,63.74v1.24c0.117-0.115,0.195-0.231,0.311-0.271c0.117-0.078,0.195-0.116,0.351-0.156
		c0.116-0.037,0.271-0.037,0.388-0.037c0.195,0,0.389,0.037,0.543,0.115c0.156,0.078,0.272,0.233,0.389,0.389
		c0.078,0.116,0.117,0.193,0.117,0.35c0.039,0.116,0.039,0.271,0.039,0.427v1.515c0,0.156-0.039,0.272-0.117,0.388
		c-0.078,0.078-0.194,0.118-0.31,0.118c-0.272,0-0.428-0.156-0.428-0.506v-1.397c0-0.272-0.038-0.467-0.116-0.622
		s-0.233-0.232-0.467-0.232c-0.154,0-0.271,0.038-0.389,0.115c-0.115,0.079-0.193,0.195-0.271,0.352
		c-0.039,0.115-0.076,0.349-0.076,0.659v1.126c0,0.156-0.039,0.272-0.117,0.388c-0.077,0.078-0.194,0.118-0.311,0.118
		c-0.271,0-0.428-0.156-0.428-0.506V63.7c0-0.155,0.039-0.312,0.117-0.388c0.078-0.079,0.156-0.117,0.311-0.117
		c0.116,0,0.233,0.038,0.311,0.117C126.141,63.429,126.178,63.584,126.178,63.74L126.178,63.74z"/>
                                    </g>
                                    <g>
                                        <path fill="#020202" d="M145.423,64.19l-0.337-2.325c0,0,1.649-0.508,3.087-1.565c1.438-1.101,1.606-1.269,1.606-1.269h3.893
		l-1.438,5.117c0,0,0.084,0.042,0.254-0.086c0.211-0.125,0.38-0.295,0.38-0.295s-0.169,0.635-2.918,1.607s-4.779,0.719-4.949,0.254
		c-0.168-0.466,0.466-0.932,0.466-0.932s-0.466,0.635,0.254,0.762c0.719,0.17,1.396,0.128,1.48,0.043l0.084-0.085l0.551-2.242
		L145.423,64.19L145.423,64.19z"/>
                                        <path fill="#020202" d="M153.672,63.092c0,0,0.718,0.337,0.507,0.93c-0.169,0.592-1.396,1.268-2.411,1.565
		c-1.016,0.253-2.029,0.253-2.029,0.253C150.964,65.755,154.39,64.782,153.672,63.092z M137.726,70.068l0.974-3.593h0.93
		l0.551,1.438l1.268-1.354h1.101l-0.931,3.51h-1.016l0.55-1.987h-0.126l-1.226,1.354l-0.594-1.354h-0.126l-0.508,1.987H137.726
		L137.726,70.068z"/>
                                        <path fill="#F68821" d="M145.086,66.476c0,0,1.944-0.299,1.691,1.605c-0.254,1.903-2.834,2.326-3.638,1.819
		c-0.846-0.508-0.508-1.692-0.423-1.819s0.931-0.423,0.931-0.423s-0.212-0.126-0.466-0.085l-0.254,0.043
		C142.886,67.658,143.479,66.644,145.086,66.476L145.086,66.476z M144.281,69.225c0.381,0.124,0.847-0.171,1.058-0.679
		c0.212-0.507,0.084-1.014-0.296-1.142c-0.381-0.126-0.846,0.169-1.057,0.677C143.774,68.589,143.901,69.097,144.281,69.225z
		 M146.692,70.068l1.057-3.552h0.931l0.973,2.029l0.593-2.029h0.974l-1.017,3.552h-1.015l-0.888-1.944l-0.635,1.944H146.692
		L146.692,70.068z M151.768,66.517h2.918l-0.211,0.762h-1.946l-0.168,0.635h1.818l-0.213,0.718l-1.776-0.042l-0.21,0.72l1.944,0.04
		l-0.212,0.72h-2.917L151.768,66.517L151.768,66.517z"/>
                                        <path fill="#020202" d="M155.109,66.517l0.761,2.198l-0.382,1.354h0.973l0.382-1.354l2.029-2.239h-1.142l-1.143,1.351h-0.084
		l-0.381-1.351h-1.014V66.517z"/>
                                    </g>
                                    <g>
                                        <path fill="#FFFFFF" d="M63.057,18.348c3.092,0,4.152,0.474,4.919,1.219c1.106,1.083,1.467,2.73,1.151,4.423
		c-0.316,1.692-1.354,3.476-2.573,4.378c-1.331,0.971-2.55,1.444-5.145,1.444h-1.67l-0.97,5.236h-4.265l3.092-16.7H63.057z
		 M60.439,26.066h1.557c0.406,0,1.083,0,1.693-0.248c0.609-0.249,1.151-0.768,1.332-1.761c0.18-0.993-0.203-1.467-0.745-1.715
		c-0.542-0.249-1.241-0.249-1.715-0.249h-1.399L60.439,26.066z"/>
                                        <path fill="#FFFFFF" d="M80.075,35.048h-3.747l0.249-1.354c-0.903,1.219-2.573,1.783-4.04,1.783c-3.972,0-5.71-3.114-5.033-6.703
		c0.745-4.107,4.175-6.68,7.515-6.68c2.054,0,3.024,0.993,3.385,1.76l0.249-1.331h3.746L80.075,35.048z M71.228,28.842
		c-0.203,1.151,0.271,3.137,2.527,3.137c1.332,0,2.257-0.632,2.889-1.399c0.406-0.497,0.655-1.038,0.813-1.603
		c0.136-0.564,0.136-1.128-0.022-1.647c-0.248-0.857-0.925-1.738-2.505-1.738c-2.144,0-3.43,1.806-3.701,3.228V28.842z"/>
                                        <path fill="#FFFFFF"
                                              d="M84.455,34.417l-2.437-11.893h3.994l1.196,7.267l3.746-7.267h3.972l-9.366,16.7h-3.972L84.455,34.417z"/>
                                        <path fill="#FFFFFF" d="M109.755,28.526l1.782-10.178h4.085l-3.092,16.7h-3.701l-4.514-10.065l-1.782,10.065h-4.085l3.092-16.7
		h3.679L109.755,28.526z"/>
                                        <path fill="#FFFFFF" d="M114.676,28.752c0.564-3.047,3.408-6.635,7.967-6.635s6.094,3.588,5.529,6.657
		c-0.587,3.069-3.431,6.658-7.989,6.658s-6.093-3.588-5.507-6.658V28.752z M118.399,28.797c-0.315,1.806,0.813,3.137,2.438,3.137
		s3.25-1.332,3.589-3.16c0.338-1.828-0.813-3.159-2.438-3.159s-3.228,1.331-3.565,3.159L118.399,28.797z"/>
                                        <path fill="#FFFFFF" d="M128.24,22.523h3.882l0.474,7.786l3.498-7.786h3.159l0.678,7.786l3.317-7.786h3.858l-6.16,12.525h-3.476
		l-0.632-8.102l-3.611,8.102h-3.476L128.24,22.523z"/>
                                    </g>
</svg>
                            </button>
                        </a></p>
                    <?php
                }
                ?>

            </div>
        </div>

    </div>
    <?php

    if(isset($_GET["mke_payment"])) {
        $invoice->addInvoice($myuuid);
        $response = $paynow->send($payment);

        if($response->success()) {
            // Or if you prefer more control, get the link to redirect the user to, then use it as you see fit
            $link = $response->redirectUrl();

            // Get the poll url (used to check the status of a transaction). You might want to save this in your DB
            $pollUrl = $response->pollUrl();

        }
    }
?>
    <script src="admin/assets/js/scrollspyNav.js"></script>
    <script src="admin/plugins/countdown/jquery.countdown.min.js"></script>
    <?php include('inc/footer.php'); ?>
