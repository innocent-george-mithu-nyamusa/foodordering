<?php 
session_start();
$_SESSION["userid"] = '';
$_SESSION["name"] = '';
$_SESSION["balance"] = '';
session_destroy();
header("Location: login.php");
?>






