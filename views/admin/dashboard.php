<?php
// filepath: d:\Xampp\htdocs\flower_shop\views\admin\dashboard.php
session_start();
// Optional: Check if user is admin
// if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
//     header("Location: ../../homepage.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Blossom Flower Shop</title>
    <style>
        body { background: #f8f8f8; font-family: Arial, sans-serif; margin: 0; }
        .admin-navbar {
            background: #e75480;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            height: 60px;
        }
        .admin-navbar a {
            color: #fff;
            text-decoration: none;
            padding: 0 32px;
            font-size: 18px;
            line-height: 60px;
            display: block;
            transition: background 0.2s;
        }
        .admin-navbar a:hover, .admin-navbar a.active {
            background: #d84372;
        }
        .dashboard-container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 12px #eee;
            padding: 32px;
        }
        h1 { color: #e75480; }
        .admin-welcome {
            font-size: 20px;
            color: #444;
            margin-bottom: 30px;
        }
        .admin-links {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }
        .admin-link-card {
            flex: 1;
            background: #faf6f8;
            border-radius: 8px;
            padding: 24px;
            text-align: center;
            box-shadow: 0 2px 8px #eee;
            transition: box-shadow 0.2s;
        }
        .admin-link-card:hover {
            box-shadow: 0 4px 16px #e75480;
        }
        .admin-link-card a {
            color: #e75480;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="admin-navbar">
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="mana_orders.php">Manage Orders</a>
        <a href="mana_products.php">Manage Products</a>
        <a href="mana_reviews.php">Manage Reviews</a>
    </nav>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1>
        <div class="admin-welcome">
            Welcome to the Blossom Flower Shop admin dashboard.<br>
            Use the navigation bar above to manage orders, products, and reviews.
        </div>
        <div class="admin-links">
            <div class="admin-link-card">
                <a href="mana_orders.php">Go to Orders Management</a>
            </div>
            <div class="admin-link-card">
                <a href="mana_products.php">Go to Products Management</a>
            </div>
            <div class="admin-link-card">
                <a href="mana_reviews.php">Go to Reviews Management</a>
            </div>
        </div>
    </div>
</body>
</html>