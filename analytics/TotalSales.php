<?php

require_once "../models/Connection.php";

class TotalSales {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function get() {
        try {
            $sql = "SELECT SUM(total_amount) AS total_sales FROM orders";
            return $this->db->query($sql)->fetch();
        } catch (PDOException $e) {
            echo "Error fetching total sales: " . $e->getMessage();
            return false;
        }
    }
}