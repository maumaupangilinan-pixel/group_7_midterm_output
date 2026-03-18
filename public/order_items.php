<?php
header('Content-Type: application/json');
require_once "../models/OrderItem.php";

$orderItem = new OrderItem();

if (isset($_GET['id'])) {
    echo json_encode($orderItem->getById($_GET['id']));
} elseif (isset($_GET['order_id'])) {
    echo json_encode($orderItem->getByOrderId($_GET['order_id']));
} else {
    echo json_encode($orderItem->getAll());
}