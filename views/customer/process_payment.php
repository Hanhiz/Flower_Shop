<?php
// filepath: c:\xampp\htdocs\Flower_Shop\views\customer\process_payment.php
session_start();
include '../../includes/header.php';

// Giả lập thông tin đơn hàng vừa thanh toán thành công
$order_id = $_GET['order_id'] ?? 0;

// Có thể lấy thêm thông tin đơn hàng nếu cần
// $conn = new mysqli('localhost', 'root', '', 'flowershop');
// $conn->set_charset('utf8');
// $order = null;
// if ($order_id) {
//     $sql = "SELECT * FROM orders WHERE id = $order_id";
//     $result = $conn->query($sql);
//     if ($result && $result->num_rows > 0) {
//         $order = $result->fetch_assoc();
//     }
//     $conn->close();
// }

?>
<style>
.processpay-container {
    max-width: 480px;
    margin: 60px auto 60px auto;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #f0e0de;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    padding: 48px 24px 36px 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
}
.processpay-icon {
    font-size: 3.2rem;
    color: #2ecc40;
    margin-bottom: 18px;
}
.processpay-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #222;
    margin-bottom: 10px;
    text-align: center;
}
.processpay-desc {
    font-size: 1.08rem;
    color: #444;
    margin-bottom: 24px;
    text-align: center;
}
.processpay-orderid {
    font-size: 1.05rem;
    color: #d17c7c;
    font-weight: 500;
    margin-bottom: 18px;
}
.processpay-btns {
    display: flex;
    gap: 18px;
    margin-top: 12px;
    width: 100%;
    justify-content: center;
}
.processpay-btn {
    background: #d17c7c;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 28px;
    font-size: 1.08rem;
    font-weight: 500;
    cursor: pointer;
    transition: opacity 0.15s;
    text-decoration: none;
    display: inline-block;
}
.processpay-btn:hover {
    opacity: 0.85;
}
</style>

<div class="processpay-container">
    <div class="processpay-icon">
        <!-- Biểu tượng thành công -->
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
            <circle cx="24" cy="24" r="24" fill="#eafbe7"/>
            <path d="M15 25.5L21 31.5L33 19.5" stroke="#2ecc40" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div class="processpay-title">Thanh toán thành công!</div>
    <div class="processpay-desc">
        Cảm ơn bạn đã đặt hàng tại Blossom Flower Shop.<br>
        Đơn hàng của bạn sẽ được xử lý và giao trong thời gian sớm nhất.
    </div>
    <?php if ($order_id): ?>
        <div class="processpay-orderid">Mã đơn hàng: #<?php echo htmlspecialchars($order_id); ?></div>
    <?php endif; ?>
    <div class="processpay-btns">
        <a href="orderhistory.php" class="processpay-btn">Xem đơn hàng</a>
        <a href="../../index.php" class="processpay-btn" style="background:#fff;color:#d17c7c;border:1.5px solid #d17c7c;">Về trang chủ</a>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>