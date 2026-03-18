<?php
header('Content-Type: application/json');
require_once "../models/Order.php";

$order = new Order();

if (isset($_GET['id'])) {
    echo json_encode($order->getById($_GET['id']));
} else {
    echo json_encode($order->getAll());
}