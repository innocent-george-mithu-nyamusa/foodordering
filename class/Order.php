<?php
class Order {	
   
	private $ordersTable = 'food_orders';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function insert()
    {
        if ($this->item_name) {
            $stmt = $this->conn->prepare("
			INSERT INTO " . $this->ordersTable . "(`item_id`, `name`, `price`, `quantity`, `order_date`, `order_id`, `order_client_name`, `order_client_id`)
			VALUES(?,?,?,?,?,?,?,?)");
            $this->item_id = htmlspecialchars(strip_tags($this->item_id));
            $this->item_name = htmlspecialchars(strip_tags($this->item_name));
            $this->item_price = htmlspecialchars(strip_tags($this->item_price));
            $this->quantity = htmlspecialchars(strip_tags($this->quantity));
            $this->order_date = htmlspecialchars(strip_tags($this->order_date));
            $this->order_id = htmlspecialchars(strip_tags($this->order_id));
            $this->userorder = htmlspecialchars(strip_tags($this->userorder));
            $this->userid = htmlspecialchars(strip_tags($this->userid));
            $stmt->bind_param("isiissss", $this->item_id, $this->item_name, $this->item_price, $this->quantity, $this->order_date, $this->order_id, $this->userorder, $this->userid);
            if ($stmt->execute()) {
                return true;
            }
        }
    }

    public function myOrdersList(int $userId) {

            $stmt = $this->conn->prepare("SELECT id, item_id, order_id, name, price, quantity, order_time FROM food_orders WHERE order_client_id=? AND status='active'");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
    }
    public function allTransactionsList(int $userId) {

        $stmt = $this->conn->prepare("SELECT * FROM food_orders WHERE order_client_id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function allHistoryList(int $userId) {

        $stmt = $this->conn->prepare("SELECT * FROM food_orders WHERE order_client_id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function numberOfOrders(int $userId) {

        $stmt = $this->conn->prepare("SELECT id FROM food_orders WHERE order_client_id=? AND status='active'");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows();
        return $result;
    }

    public function madeAnyOrders(int $userId) {

        $stmt = $this->conn->prepare("SELECT id FROM food_orders WHERE order_client_id=? ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows();
        return $result;
    }

    public function numberOfOrdersToCollect(int $userId) {

        $stmt = $this->conn->prepare("SELECT id FROM food_orders WHERE order_client_id=? AND status='to_collect'");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows();
        return $result;
    }

    public function cleanAllOrders(int $userId) {
        $stmt = $this->conn->prepare("UPDATE food_orders SET status='cancelled' WHERE order_client_id=? AND status='active'");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result) {
            return 1;
        }
        return 0;
    }

    public function cleanOrder(int $orderId) {
        $stmt = $this->conn->prepare("UPDATE food_orders SET status='cancelled' WHERE order_id=? AND status='active'");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result) {
            return 1;
        }
        return 0;
    }

    public function toCollectOrder(int $orderId) {
        $stmt = $this->conn->prepare("UPDATE food_orders SET status='to_collect' WHERE order_id=? AND status='active'");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result) {
            return 1;
        }
        return 0;
    }

}
?>