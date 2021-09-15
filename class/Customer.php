<?php
class Customer {

	private $customerTable = 'food_customer';
	private $conn;

	public function __construct($db){
        $this->conn = $db;
    }

	public function login(){
		if($this->email && $this->password) {
			$sqlQuery = "
				SELECT * FROM ".$this->customerTable."
				WHERE email = ? AND password = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);
			$stmt->bind_param("ss", $this->email, $password);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['id'];
				$_SESSION["name"] = $user['name'];
				$_SESSION["email"] = $user['email'];
				$_SESSION["balance"] = $user["user_amount"];
				if($user["role"] == "admin") {
					$_SESSION["role"] = "admin";
				}
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

  public function signIn(){
    if($this->email && $this->password){

      $signQuery = "INSERT INTO food_customer(name, regnumber, email, password, phone, address) VALUES(?,?,?,?,?,?)";
      $signStmt = $this->conn->prepare($signQuery);
      $password = md5($this->password);
      $signStmt->bind_param("ssssss", $this->username, $this->regnumber, $this->email, $password, $this->phone, $this->address);
      $result = $signStmt->execute();

      if($result) {
        $loginResult = $this->Login();
        if($loginResult) {
          return 1;
        } else {
          return 0;
        }
      }else {

        return 0;
      }
    } else {
      return 0;
    }
  }

	public function loggedIn (){
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}

	function getAddress(){
		if($_SESSION["userid"]) {
			$stmt = $this->conn->prepare("
				SELECT email, phone, address
				FROM ".$this->customerTable."
				WHERE id = '".$_SESSION["userid"]."'");
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
	}

	function emailExists($email) {
		$userCountStmt = $this->conn->prepare("SELECT email FROM food_customer WHERE email='$email'");
		$userCountStmt->execute();
		$userCountStmt->store_result();
		$count = $userCountStmt->num_rows();
		return $count;
	}

	public function updateAmount($amount){
		if ($_SESSION["userid"]) {
			$userAddStmt = $this->conn->prepare("UPDATE food_customer SET user_amount='$amount' WHERE id = '".$_SESSION['userid']."'");
			$userAddStmt->execute();
			$result = $userAddStmt->get_result();
			return $result;
		}
	}
}
?>
