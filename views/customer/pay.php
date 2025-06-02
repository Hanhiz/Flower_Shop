<?php
// filepath: d:\Xampp\htdocs\flower_shop\views\customer\pay.php
session_start();
include '../../connectdb.php';

// Example: Get product, quantity, card, message from GET or session (adjust as needed)
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;
$card_id = isset($_GET['card']) ? intval($_GET['card']) : null;
$card_message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

$product = null;
$card = null;
$shipping_fee = 30000;

if ($product_id) {
    $result = $conn->query("SELECT name, price, image FROM products WHERE id = $product_id");
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
}
if ($card_id) {
    $result = $conn->query("SELECT name, price, image FROM services WHERE id = $card_id");
    if ($result && $result->num_rows > 0) {
        $card = $result->fetch_assoc();
    }
}
$total = 0;
if ($product) {
    $total += $product['price'] * $quantity;
}
if ($card) {
    $total += $card['price'];
}
$total += $shipping_fee;

$user_fullname = $user_phone = $user_address = '';
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $user_result = $conn->query("SELECT fullname, phone, address FROM users WHERE id = $uid LIMIT 1");
    if ($user_result && $user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
        $user_fullname = $user['fullname'];
        $user_phone = $user['phone'];
        $user_address = $user['address'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - Blossom Flower Shop</title>
    <style>
        body { 
            background: #f8f8f8; 
            font-family: 'Montserrat', sans-serif; 
        }
        h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        .pay-container {
            width: 80%;
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 12px #eee;
            display: flex;
            overflow: hidden;
        }
        .pay-left, .pay-right {
            padding: 32px 28px;
            flex: 1;
        }
        .pay-left {
            border-right: 1px solid #f0f0f0;
            background: #faf6f8;
        }
        .pay-right {
            border: 1px solid #EE7FAF;
        }
        .pay-left h2, .pay-right h2 { 
            color: #000; 
            margin-top: 0; 
        }
        .pay-left input, .pay-left textarea {
            width: 70%; 
            padding: 10px; 
            margin-bottom: 16px; 
            border-radius: 5px; 
            border: 1px solid #ccc;
        }
        .pay-right .summary-item {
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 12px;
        }
        .pay-right .summary-item img {
            width: 60px; 
            height: 60px; 
            object-fit: cover; 
            border-radius: 6px; 
            margin-right: 10px;
        }
        .pay-right .total {
            font-size: 22px; 
            color: #e75480; 
            font-weight: bold; 
            margin-top: 20px;
        }
        .pay-left button {
            width: auto; 
            background: #e75480; 
            color: #fff; 
            border: none; 
            border-radius: 5px;
            padding: 8px 12px; 
            font-size: 18px; 
            margin-top: 30px; 
            cursor: pointer; 
            transition: background 0.2s;
        }
        .pay-left button:hover { background: #d84372; }
        @media (max-width: 800px) {
            .pay-container { flex-direction: column; }
            .pay-left { border-right: none; border-bottom: 1px solid #f0f0f0; }
        }
    </style>
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    <br>
    <a href="../../cart.php" style="text-decoration: none; color: #333; margin-left: 2%;">Cart</a> > Payment
    <h1>Complete Your Payment</h1>
    <div class="pay-container">
        <!-- Left: Customer Info -->
        <div class="pay-left">
            <h2>Customer Information</h2>
            <form method="post" action="process_payment.php">
                <label>Full Name:</label><br>
                <input type="text" name="fullname" required value="<?php echo htmlspecialchars($user_fullname); ?>" placeholder="Enter your full name">
                <br><label>Phone Number:</label><br>
                <input type="text" name="phone" required value="<?php echo htmlspecialchars($user_phone); ?>" placeholder="Enter your phone number">
                <br><label>Address:</label><br>
                <input type="text" name="address" required value="<?php echo htmlspecialchars($user_address); ?>" placeholder="Enter your address">
                <br><label>Note (optional):</label><br>
                <textarea name="note" rows="2" placeholder="Leave your message here"></textarea>
                <!-- Hidden fields to pass order info -->
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                <input type="hidden" name="card_id" value="<?php echo $card_id; ?>">
                <input type="hidden" name="card_message" value="<?php echo $card_message; ?>">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <br><button type="submit">Pay Now</button>
            </form>
        </div>
        <!-- Right: Payment Info -->
        <div class="pay-right">
            <h2>Your order</h2>
            <hr>
            <?php if ($product): ?>
                <div class="summary-item">
                    <div style="display:flex;align-items:center;">
                        <img src="../../assets/img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div>
                            <div><?php echo htmlspecialchars($product['name']); ?></div>
                            <div>Quantity: <?php echo $quantity; ?></div>
                        </div>
                    </div>
                    <div><?php echo number_format($product['price'] * $quantity); ?> VND</div>
                </div>
            <?php endif; ?>
            
            <?php if ($card): ?>
                <hr>
                <div class="summary-item">
                    <div style="display:flex;align-items:center;">
                        <img src="../../assets/img/<?php echo htmlspecialchars($card['image']); ?>" alt="<?php echo htmlspecialchars($card['name']); ?>">
                        <div>
                            <div><?php echo htmlspecialchars($card['name']); ?> (Card)</div>
                            <?php if ($card_message): ?>
                                <div style="font-size:12px;color:#888;">Message: <?php echo $card_message; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div><?php echo number_format($card['price']); ?> VND</div>
                </div>
                <hr>
            <?php endif; ?>
            <div class="summary-item">
                <div>Shipping Fee</div>
                <div><?php echo number_format($shipping_fee); ?> VND</div>
            </div>
            <hr>
            <div class="total">
                Total: <?php echo number_format($total); ?> VND
            </div>
            <hr>
            <h2>Payment method</h2>
            <input type="radio" name="payment_method" value="cod" checked> Cash on Delivery (COD)<br>
            <input type="radio" name="payment_method" value="bank_transfer"> Bank Transfer<br>
            <div id="bank-info" style="display:none; margin-top:15px; text-align:center;">
                <div style="margin-bottom: 12px; color:#555;">Make a transfer to our bank account immediately. Please use your Order ID in the Payment Details section. Your order will be shipped after the payment transaction is completed.</div>
                <img src="../../assets/img/bank.png" alt="Bank Transfer Info" style="max-width:250px; width:100%;">
            </div>
            <hr>
            <input type="checkbox" name="terms" required>I have read and agree to the website <span style="color: #E85697;">terms and conditions</span><br>
            <input type="checkbox" name="privacy" required>I have read and agree to the website <span style="color: #E85697;">privacy policy</span><br>
        </div>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script>
        document.querySelectorAll('input[name="payment_method"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('bank-info').style.display =
                    this.value === 'bank_transfer' ? 'block' : 'none';
            });
        });
        // Show if already selected (on reload)
        if(document.querySelector('input[name="payment_method"]:checked')?.value === 'bank_transfer') {
            document.getElementById('bank-info').style.display = 'block';
        }
    </script>
</body>
</html>