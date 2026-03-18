<?php
require_once "Connection.php";

class Item {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM items");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching items: " . $e->getMessage();
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM items WHERE item_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching item: " . $e->getMessage();
            return false;
        }
    }

    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO items (product_name, description, price, stock_quantity) 
                VALUES (?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['product_name'],
                $data['description'] ?? null,
                $data['price'],
                $data['stock_quantity'] ?? 0
            ]);
        } catch (PDOException $e) {
            echo "Error creating item: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE items 
                SET product_name=?, description=?, price=?, stock_quantity=? 
                WHERE item_id=?
            ");
            return $stmt->execute([
                $data['product_name'],
                $data['description'] ?? null,
                $data['price'],
                $data['stock_quantity'] ?? 0,
                $id
            ]);
        } catch (PDOException $e) {
            echo "Error updating item: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM items WHERE item_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error deleting item: " . $e->getMessage();
            return false;
        }
    }

    public function getOrderItems($itemId) {
    try {
        $stmt = $this->db->prepare("
            SELECT oi.order_item_id, oi.order_id, oi.quantity, oi.unit_price, oi.subtotal, o.customer_id, o.status
            FROM order_items oi
            JOIN orders o ON o.order_id = oi.order_id
            WHERE oi.item_id = ?
            ORDER BY o.order_date DESC
        ");
        $stmt->execute([$itemId]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Error fetching order items for product: " . $e->getMessage();
        return false;
    }
    }   
}