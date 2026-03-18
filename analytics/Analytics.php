<?php


class Analytics {

    public static function ordersPerCustomer() {
        require_once "OrdersPerCustomer.php";
        $obj = new OrdersPerCustomer();
        return $obj->get();
    }

    public static function bestSellingProduct() {
        require_once "BestSellingProduct.php";
        $obj = new BestSellingProduct();
        return $obj->get();
    }

    public static function totalSales() {
        require_once "TotalSales.php";
        $obj = new TotalSales();
        return $obj->get();
    }
}