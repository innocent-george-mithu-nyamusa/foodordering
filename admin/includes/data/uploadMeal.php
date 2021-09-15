<?php

include_once "../../../config/Database.php";
$database = new Database();
$db = $database->getConnection();

if(isset($_POST["add_meal"])) {

    $meal_name = htmlspecialchars($_POST["meal-name"]);
    $meal_description = htmlspecialchars($_POST["meal-description"]);
    $meal_ingredients = htmlspecialchars($_POST["meal-ingredients"]);
    $meal_place = htmlspecialchars($_POST["meal-place"]);
    $meal_type = htmlspecialchars($_POST["meal-type"]);
    $meal_price = htmlspecialchars($_POST["meal-price"]);
    $meal_chef = htmlspecialchars($_POST["meal-chef"]);

    $meal_image = $_FILES['image']['name'];
    $meal_image_temp = $_FILES['image']['tmp_name'];

    // images directory
    $target_dir = __DIR__."./../../../images/";
    $target_file = $target_dir . basename($meal_image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($meal_image_temp);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";

        $SESSION["error"]="File is not an image";

//        header("Location: ../../add_meal.php");
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";

        $SESSION["error"] = "Sorry, file already exists.";
//        header("Location: ../../add_meal.php");
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $SESSION["error"]="Sorry, your file is too large.";
//        header("Location: ../../add_meal.php");
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG & PNG  files are allowed.";
        $SESSION["error"]="Sorry, only JPG, JPEG & PNG  files are allowed.";
//        header("Location: ../../add_meal.php");
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($meal_image_temp, $target_file)) {
            echo "The file ". basename( $meal_image). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            $SESSION["error"]="Sorry, There was an error uploading your file.";
//            header("Location: ../../add_meal.php");
        }
    }

    $mealQuery = "INSERT INTO food_items (name, price, description, images, meal_type, meal_chef, meal_ingredients, meal_place) VALUES(?,?,?,?,?,?,?,?)";
    $insertStmt = $db->prepare($mealQuery);
    $insertStmt->bind_param("sdssssss", $meal_name, $meal_price, $meal_description, $meal_image, $meal_type, $meal_chef, $meal_ingredients, $meal_place);
    $insertStmt->execute();
    $insertStmt->get_result();

//    header("Location: ../../index.php");
} else {
//    header("Location: add_meal.php");
}