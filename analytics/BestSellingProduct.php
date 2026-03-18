<?php

require_once "../models/Connection.php";

class BestSellingProduct {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function get() {
        try {
            $sql = "
                SELECT i.item_id, i.product_name, SUM(oi.quantity) AS total_sold
                FROM order_items oi
                JOIN items i ON i.item_id = oi.item_id
                GROUP BY i.item_id
                ORDER BY total_sold DESC
                LIMIT 1
            ";
            return $this->db->query($sql)->fetch();
        } catch (PDOException $e) {
            echo "Error fetching best selling product: " . $e->getMessage();
            return false;
        }
    }
}