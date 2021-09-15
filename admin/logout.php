<?php 
session_start();
$_SESSION["userid"] = '';
$_SESSION["name"] = '';

session_unset();
session_destroy();
header("Location: login.php");
?>






