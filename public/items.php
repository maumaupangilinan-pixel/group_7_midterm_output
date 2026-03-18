<?php
header('Content-Type: application/json');
require_once "../models/Item.php";

$item = new Item();

if (isset($_GET['id'])) {
    echo json_encode($item->getById($_GET['id']));
} else {
    echo json_encode($item->getAll());
}