<?php


class Invoice
{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function addInvoice($ref) {
        $invoiceQuery = "INSERT INTO invoice(ref) VALUES(?)";
        $invoiceStmt = $this->conn->prepare($invoiceQuery);
        $invoiceStmt->bind_param("s",$ref);
        $invoiceStmt->execute();


    }
}