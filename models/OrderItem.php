<?php
require_once "Connection.php";

class OrderItem {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    // Get all order_items
    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM order_items");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching order items: " . $e->getMessage();
            return false;
        }
    }

    // Get a single order_item by ID
    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM order_items WHERE order_item_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching order item: " . $e->getMessage();
            return false;
        }
    }

    // Create a new order_item
    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO order_items (order_id, item_id, quantity, unit_price) 
                VALUES (?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['order_id'],
                $data['item_id'],
                $data['quantity'],
                $data['unit_price']
            ]);
        } catch (PDOException $e) {
            echo "Error creating order item: " . $e->getMessage();
            return false;
        }
    }

    // Update an existing order_item
    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE order_items 
                SET order_id=?, item_id=?, quantity=?, unit_price=? 
                WHERE order_item_id=?
            ");
            return $stmt->execute([
                $data['order_id'],
                $data['item_id'],
                $data['quantity'],
                $data['unit_price'],
                $id
            ]);
        } catch (PDOException $e) {
            echo "Error updating order item: " . $e->getMessage();
            return false;
        }
    }

    // Delete an order_item
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM order_items WHERE order_item_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error deleting order item: " . $e->getMessage();
            return false;
        }
    }

    // Get all items for a specific order
    public function getByOrderId($orderId) {
        try {
            $stmt = $this->db->prepare("
                SELECT i.product_name, oi.quantity, oi.unit_price, oi.subtotal
                FROM order_items oi
                JOIN items i ON i.item_id = oi.item_id
                WHERE oi.order_id = ?
            ");
            $stmt->execute([$orderId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching order items for order: " . $e->getMessage();
            return false;
        }
    }
}