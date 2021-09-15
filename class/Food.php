<?php
class Food {	
   
	private $foodItemsTable = 'food_items';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function itemsList($hall){
		$stmt = $this->conn->prepare("SELECT id, name, price, description, images, status FROM ".$this->foodItemsTable." WHERE meal_place='$hall'");
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	
}
?>