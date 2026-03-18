<?php
header('Content-Type: application/json');
require_once "../models/Customer.php";

$customer = new Customer();

if (isset($_GET['id'])) {
    echo json_encode($customer->getById($_GET['id']));
} else {
    echo json_encode($customer->getAll());
}