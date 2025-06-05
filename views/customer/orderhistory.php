<?php
// filepath: c:\xampp\htdocs\Flower_Shop\views\customer\orderhistory.php
session_start();
include '../../includes/header.php';
include '../../connectdb.php';
$current_user_id = $_SESSION['user_id'] ?? 0;

// Lấy status filter từ query string, mặc định là 'Pending'
$status_filter = $_GET['status'] ?? 'Pending';
$valid_status = ['Pending', 'Shipped', 'Delivered'];
if (!in_array($status_filter, $valid_status)) $status_filter = 'Pending';

$conn->set_charset('utf8');
$orders = [];
$sql = "SELECT * FROM orders WHERE user_id = $current_user_id AND status = '$status_filter' ORDER BY order_date DESC";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

// Lấy order_ids để lấy order_items
$order_ids = array_column($orders, 'id');
$order_items = [];
$products = [];
if ($order_ids) {
    $ids_str = implode(',', array_map('intval', $order_ids));
    // Lấy order_items
    $sql = "SELECT * FROM order_items WHERE order_id IN ($ids_str)";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $order_items[$row['order_id']][] = $row;
        $product_ids[] = $row['product_id'];
    }
    // Lấy thông tin sản phẩm
    if (!empty($product_ids)) {
        $product_ids_str = implode(',', array_map('intval', array_unique($product_ids)));
        $sql = "SELECT * FROM products WHERE id IN ($product_ids_str)";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $products[$row['id']] = $row;
        }
    }
}
$conn->close();
?>

<style>
.orderhistory-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 32px 0 48px 0;
}
.orderhistory-menu {
    display: flex;
    justify-content: center;
    gap: 32px;
    margin-bottom: 32px;
}
.orderhistory-menu a {
    padding: 10px 32px;
    /* border-radius: 6px 6px 0 0; */ /* Xóa hoặc comment dòng này */
    color: #222;
    font-weight: 500;
    text-decoration: none;
    font-size: 1.1rem;
    /* border: 1px solid #f0e0de; */ /* Xóa hoặc comment dòng này */
    border-bottom: none;
    background: none;
    transition: color 0.15s;
}
.orderhistory-menu a.active {
    color: #222;
    border-bottom: 2.5px solid #d17c7c;
    border-radius: 0;
    font-weight: 500;
    background: none;
}
.order-list {
    display: flex;
    flex-direction: column;
    gap: 28px;
}
.order-item {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #f0e0de;
    box-shadow: 0 2px 8px rgba(0,0,0,0.02);
    margin-bottom: 0;
    padding: 18px 24px;
}
.order-head {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 12px;
}
.order-id {
    font-weight: bold;
    font-size: 1.08rem;
}
.order-date {
    color: #888;
    font-size: 0.98rem;
}
.order-status {
    margin-left: auto;
    font-weight: 600;
}
.order-products {
    border-top: 1px solid #eee;
    padding-top: 12px;
    margin-top: 8px;
}
.product-row {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 10px;
}
.product-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 6px;
    background: #f5f5f5;
    border: 1px solid #eee;
}
.product-info {
    flex: 1;
}
.product-name {
    font-weight: 500;
    font-size: 1rem;
}
.product-qty {
    color: #888;
    font-size: 0.97rem;
}
.product-price {
    color: #d17c7c;
    font-weight: bold;
    font-size: 1rem;
    margin-left: 12px;
}
.product-feedback {
    margin-left: 18px;
}
.feedback-btn {
    background: #d17c7c;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 5px 14px;
    font-size: 0.98rem;
    cursor: pointer;
    transition: opacity 0.15s;
    text-decoration: none;
    display: inline-block;
}
.feedback-btn:hover { opacity: 0.85; }
</style>

<div class="orderhistory-container">
    <div class="orderhistory-menu">
        <a href="?status=Pending" class="<?php if($status_filter=='Pending') echo 'active'; ?>">Pending</a>
        <a href="?status=Shipped" class="<?php if($status_filter=='Shipped') echo 'active'; ?>">Shipped</a>
        <a href="?status=Delivered" class="<?php if($status_filter=='Delivered') echo 'active'; ?>">Delivered</a>
    </div>
    <div class="order-list">
        <?php if (empty($orders)): ?>
            <div style="text-align:center;color:#888;font-size:1.1rem;">No orders found.</div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
            <div class="order-item">
                <div class="order-head">
                    <span class="order-id">Order #<?php echo htmlspecialchars($order['id']); ?></span>
                    <span class="order-date"><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></span>
                    <span class="order-status" style="
                        <?php
                        $color = "#888";
                        if ($order['status'] === 'Pending') $color = "#e5b600";
                        if ($order['status'] === 'Shipped') $color = "#1e90ff";
                        if ($order['status'] === 'Delivered') $color = "#2ecc40";
                        ?>
                        color:<?php echo $color; ?>;
                    ">
                        <?php echo htmlspecialchars($order['status']); ?>
                    </span>
                </div>
                <div class="order-products">
                    <?php
                    $items = $order_items[$order['id']] ?? [];
                    foreach ($items as $item):
                        $product = $products[$item['product_id']] ?? null;
                        if (!$product) continue;
                    ?>
                    <div class="product-row">
                        <img class="product-img" src="../../assets/img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="product-info">
                            <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                            <div class="product-qty">x<?php echo $item['quantity']; ?></div>
                        </div>
                        <div class="product-price"><?php echo number_format($item['price']); ?> VND</div>
                        <div class="product-feedback">
                            <a class="feedback-btn" href="review.php?order_id=<?php echo $order['id']; ?>&product_id=<?php echo $product['id']; ?>">Feedback</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>