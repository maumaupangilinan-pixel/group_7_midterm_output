# Online Store System - Development Overview

Developer: Sean Maurice Pangilinan
Date: March 18, 2026  
Database: PostgreSQL (online_store_system)

This project is a PHP OOP-based online store system built to demonstrate clean architecture, database relationships, CRUD operations, and analytics. The focus of this document is on what was developed, why it was structured that way, and how each component functions.

---

## Project Purpose

The goal of this system was to create a maintainable and organized online store backend using OOP principles. Key objectives:

- Implement modular PHP classes for each database entity
- Separate concerns between models, analytics, and public endpoints
- Enable reliable CRUD operations with proper error handling
- Implement analytics for actionable insights
- Facilitate testing via Postman with minimal setup

This approach emphasizes scalability, readability, and maintainability.



### Models

### Connection Class

- Why: To centralize the database connection and ensure all models use a single PDO instance.  
- What: Connection.php class that returns a PDO instance to be used by all models.  
- How: Implements a static get method to return a PDO object. Uses try-catch for error handling.

Each database table has a corresponding PHP class with CRUD methods.

- Why: Centralizing database logic in OOP models avoids repeated SQL queries and makes the system easier to maintain.  
- What: Classes created: Connection, Customer, Item, Order, OrderItem  
- How:
  - CRUD operations use PDO with try-catch for safe error handling  
  - Relationship methods connect related entities, such as getting all orders for a customer or items for an order  
  - Helper methods simplify analytics calculations and API responses

### Relationship Methods

- Why: Relationships between entities (customers, orders, items) are essential for analytics and reporting.  
- What: Methods like getOrders(customerId), getItems(orderId), getOrderItems(itemId) were added.  
- How: Each method executes a SQL join or query to fetch related data efficiently and returns results in arrays.

### Analytics

- Why: Analytics provide insight into sales performance and customer activity.  
- What: Implemented metrics:
  - Orders per customer
  - Best selling product
  - Total sales  
- How: Each metric is a separate class in the analytics folder. They are instantiated in a main Analytics.php class for centralized access. Methods return arrays of data that can be consumed by scripts or front-end code.

### Public Scripts

- Why: Public scripts allow testing of CRUD and analytics without a full MVC framework.  
- What: Minimal PHP scripts under /public call model methods and output JSON.  
- How:
  - GET, POST, PUT, DELETE requests supported for CRUD operations  
  - Analytics endpoints accept query parameters to return the requested metric

---

## Development Insights

- Structuring code in models, analytics, and public scripts improved readability and maintainability  
- Using PDO with try-catch prevented unhandled errors and made debugging simpler  
- Helper methods for relationships made writing analytics and API logic easier and reusable  
- Developing this in a single day provided a strong understanding of OOP principles in PHP, database relationships, and modular backend design

