<?php
require_once "Connection.php";

class Customer {
    private $db;

    public function __construct() {
        $this->db = Connection::get();
    }

    public function getAll() {
        try {
            $stmt = $this->db->query("SELECT * FROM customers");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching customers: " . $e->getMessage();
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM customers WHERE customer_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error fetching customer: " . $e->getMessage();
            return false;
        }
    }

    public function create($data) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO customers (first_name, last_name, email, phone, address) 
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                $data['phone'] ?? null,
                $data['address'] ?? null
            ]);
        } catch (PDOException $e) {
            echo "Error creating customer: " . $e->getMessage();
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $stmt = $this->db->prepare("
                UPDATE customers 
                SET first_name=?, last_name=?, email=?, phone=?, address=? 
                WHERE customer_id=?
            ");
            return $stmt->execute([
                $data['first_name'],
                $data['last_name'],
                $data['email'],
                $data['phone'] ?? null,
                $data['address'] ?? null,
                $id
            ]);
        } catch (PDOException $e) {
            echo "Error updating customer: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM customers WHERE customer_id=?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error deleting customer: " . $e->getMessage();
            return false;
        }
    }

    public function getOrders($customerId) {
        try {
            $stmt = $this->db->prepare("
                SELECT o.*, 
                       SUM(oi.subtotal) AS order_total,
                       COUNT(oi.order_item_id) AS item_count
                FROM orders o
                LEFT JOIN order_items oi ON o.order_id = oi.order_id
                WHERE o.customer_id = ?
                GROUP BY o.order_id
                ORDER BY o.order_date DESC
            ");
            $stmt->execute([$customerId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error fetching customer orders: " . $e->getMessage();
            return false;
        }
    }


}