<?php

if(isset($_POST["status"]) && ($_POST["status"] =="Ok")) {
    if($_POST["hash"] == "48CC50A8304A0407734BBE55CA89ACADC1F6382E5F8C6D0F87183F81FBE3BFDDDD92444A4AC620796BD432C3C6F63FEF00BE343C15E77D2BC9F5C41C8C1A005D") {
        $redirect = $_POST["browserurl"];
        $pollurl = $_POST["pollurl"];
        header("Location: $redirect");
    }
}

if(isset($_POST["status"]) && ($_POST["status"] =="Error")) {
        $error = $_POST["error"];
        header("Location: ");

}