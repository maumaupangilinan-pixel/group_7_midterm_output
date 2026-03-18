<?php
require_once "Connection.php";

class Order {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM orders");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching orders: " . $e->getMessage();
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM orders WHERE order_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching order: " . $e->getMessage();
            return false;
        }
    }

    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO orders (customer_id, total_amount, status, order_date) 
                VALUES (?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['customer_id'],
                $data['total_amount'] ?? 0,
                $data['status'] ?? 'pending',
                $data['order_date'] ?? date('Y-m-d H:i:s')
            ]);
        } catch (PDOException $e) {
            echo "Error creating order: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE orders 
                SET customer_id=?, total_amount=?, status=?, order_date=? 
                WHERE order_id=?
            ");
            return $stmt->execute([
                $data['customer_id'],
                $data['total_amount'] ?? 0,
                $data['status'] ?? 'pending',
                $data['order_date'] ?? date('Y-m-d H:i:s'),
                $id
            ]);
        } catch (PDOException $e) {
            echo "Error updating order: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM orders WHERE order_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error deleting order: " . $e->getMessage();
            return false;
        }
    }

    // Get all items in a specific order
    public function getItems($orderId) {
        try {
            $stmt = $this->db->prepare("
                SELECT i.item_id, i.product_name, oi.quantity, oi.unit_price, oi.subtotal
                FROM order_items oi
                JOIN items i ON i.item_id = oi.item_id
                WHERE oi.order_id = ?
            ");
            $stmt->execute([$orderId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching order items: " . $e->getMessage();
            return false;
        }
    }
}