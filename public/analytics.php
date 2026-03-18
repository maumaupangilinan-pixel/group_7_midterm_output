<?php
header('Content-Type: application/json');
require_once "../analytics/Analytics.php";

$type = $_GET['type'] ?? '';

switch($type) {
    case 'orders_per_customer':
        echo json_encode(Analytics::OrdersPerCustomer());
        break;
    case 'best_seller':
        echo json_encode(Analytics::BestSellingProduct());
        break;
    case 'total_sales':
        echo json_encode(Analytics::TotalSales());
        break;
    default:
        echo json_encode(["error" => "Invalid analytics type"]);
}