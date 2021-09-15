<?php

include_once "../../../config/Database.php";
$database = new Database();
$db = $database->getConnection();

if(isset($_POST["update_account"])) {

    $student_id = htmlspecialchars($_POST["student_id"]);
    $student_name = htmlspecialchars($_POST["student_name"]);
    $student_bank = htmlspecialchars($_POST["student_bank"]);
    $student_deposit_date = $_POST["student_deposit_date"];
    $deposit_amount = $_POST["student_deposit_amount"] + $_POST["current_amount"];
    $deposit_amount = htmlspecialchars($deposit_amount);
    $student_bank_slip_code = htmlspecialchars($_POST["student_bank_slip_code"]);

    $studentQuery = "UPDATE food_customer SET name=?, bank_name=?, user_amount=?, bank_slip_code=?, deposit_date=? WHERE id=?";
    $insertStmt = $db->prepare($studentQuery);
    $insertStmt->bind_param("ssdssi", $student_name, $student_bank, $deposit_amount, $student_bank_slip_code, $student_deposit_date, $student_id);
    $insertStmt->execute();
    $insertStmt->get_result();

    header("Location: ../../index.php");
} else {
    header("Location: ../../add_meal.php");
}