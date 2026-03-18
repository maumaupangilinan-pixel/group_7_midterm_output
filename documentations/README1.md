API Endpoints - Online Store System

This API was built as part of my project today, March 18, 2026. It lets you manage customers, items, and orders, and also provides some useful analytics like total sales, best selling products, and orders per customer.

I set it up to be simple and easy to test, so you can try all CRUD operations and analytics directly with Postman or integrate it with a frontend. Everything returns JSON, making it straightforward to use and explore.

Base URL:
http://localhost/Group7_online_store_system/public/

Customer API
GET customer.php – get all customers
GET customer.php?id={customer_id} – get a single customer by ID
POST customer.php – create a new customer
PUT customer.php?id={customer_id} – update a customer
DELETE customer.php?id={customer_id} – delete a customer

Item API
GET item.php – get all items
GET item.php?id={item_id} – get a single item by ID
POST item.php – create a new item
PUT item.php?id={item_id} – update an item
DELETE item.php?id={item_id} – delete an item

Order API
GET order.php – get all orders
GET order.php?id={order_id} – get a single order (includes items)
POST order.php – create a new order
PUT order.php?id={order_id} – update an order
DELETE order.php?id={order_id} – delete an order

Analytics API
GET analytics.php?type=orders_per_customer – get number of orders per customer
GET analytics.php?type=best_selling_product – get the best selling product
GET analytics.php?type=total_sales – get total sales value


