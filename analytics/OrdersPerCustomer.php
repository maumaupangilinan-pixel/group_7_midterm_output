<?php
require_once "../models/Connection.php";

class OrdersPerCustomer {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function get() {
        try {
            $sql = "
                SELECT c.customer_id, c.first_name, c.last_name, COUNT(o.order_id) AS total_orders
                FROM customers c
                LEFT JOIN orders o ON c.customer_id = o.customer_id
                GROUP BY c.customer_id
                ORDER BY total_orders DESC
            ";
            return $this->db->query($sql)->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching orders per customer: " . $e->getMessage();
            return false;
        }
    }
}