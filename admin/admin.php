<?php


class Admin
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login()
    {

        if ($this->email && $this->password) {
            $sqlQuery = "SELECT * FROM admin_table WHERE admin_email = ? AND admin_password = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            $password = md5($this->password);

            $stmt->bind_param("ss", $this->email, $password);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $_SESSION["userid"] = $user['id'];
                $_SESSION["name"] = $user['name'];
                $_SESSION["role"] = $user["admin"];

                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function loggedInAdmin (){

        if(!empty($_SESSION["role"]) && ($_SESSION["role"] == "admin")) {
            return 1;
        } else {
            return 0;
        }
    }


}