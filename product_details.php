<?php
session_start();
include 'connectdb.php';

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT name, image, price, description FROM products WHERE id = $product_id AND status = 1 LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    echo "<p style='text-align:center;margin-top:40px;'>Product not found.</p>";
}

// Fetch cards from services table
$cards = [];
$card_sql = "SELECT id, name, price, image, description FROM services";
$card_result = $conn->query($card_sql);
if ($card_result && $card_result->num_rows > 0) {
    while ($row = $card_result->fetch_assoc()) {
        $cards[] = $row;
    }
}

if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('You need to log in first!'); window.location='./views/auth/login.php';</script>";
        exit;
    }
    $user_id = $_SESSION['user_id'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $service_id = isset($_POST['card']) ? intval($_POST['card']) : null;

    // Insert into cart_items
    $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity, service_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $user_id, $product_id, $quantity, $service_id);
    if ($stmt->execute()) {
        echo "<script>alert('Add to cart successfully!'); window.location='./views/customer/cart.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to add to cart.');</script>";
    }
}

$shipping_fee = 20000;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <style>
            body {
                clear: both;
                margin: 0;
                background-color: #f0ede6;
                font-family: Arial, sans-serif;
            }
            .product-detail {
                width: 90%;
                margin: 40px auto;
                padding: 24px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 8px #eee;
                overflow: hidden;
            }
            .product-detail-left, .product-detail-right {
                float: left;
                width: 50%;
            }
            .product-detail-left p{
                text-align: center;
            }
            .product-detail h2 {
                text-align: center;
                color: #333;
            }
            .product-detail img {
                width: 100%;
                max-width: 350px;
                display: block;
                margin: 20px auto;
                border-radius: 8px;
            }
            .product-detail p {
                font-size: 20px;
                color: #e75480;
            }
            .product-detail a {
                display: inline-block;
                margin-top: 20px;
                color: #fff;
                background: #e75480;
                padding: 10px 20px;
                border-radius: 4px;
                text-decoration: none;
            }
            .product-detail a:hover {
                background: #d84372;
            }
            .card {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: center;
            }
            .card input[type="radio"] {
                display: none;
            }
            .card label {
                border: 2px solid #ccc;
                border-radius: 8px;
                padding: 10px;
                width: 150px;
                cursor: pointer;
                transition: border-color 0.2s, box-shadow 0.2s;
            }
            .card label.selected {
                border-color: #e75480;
                box-shadow: 0 0 8px #e75480;
            }
        </style>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <div class="product-detail">
            <div class="product-detail-left">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <div style="position:relative; width:100%; max-width:350px; margin:20px auto;">
                <img src="assets/img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width:100%; max-width:350px; display:block; border-radius:8px;">
                <span style="
                    position:absolute;
                    left:0;
                    bottom:0;
                    background:rgba(231,84,128,0.9);
                    color:#fff;
                    padding:8px 16px;
                    border-bottom-left-radius:8px;
                    font-size:20px;
                    font-weight:bold;
                ">
                    <?php echo number_format($product['price']); ?> VND
                </span>
            </div>
        </div>
        <div class="product-detail-right">
            <p><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
            <p>Quantity:</p>
            <input 
                type="number" 
                id="quantity" 
                name="quantity" 
                value="1" 
                min="1" 
                style="width: 60px; padding: 5px; border-radius: 4px; border: 1px solid #ccc;"
            >
            <p>Pick a card (optional):</p>
            <div class="card">
                <?php foreach ($cards as $card): ?>
                    <label data-card-id="<?php echo $card['id']; ?>" style="text-align:center; display: inline-block;">
                        <input 
                            type="radio" 
                            name="card" 
                            value="<?php echo $card['id']; ?>" 
                            data-card-price="<?php echo $card['price']; ?>"
                        >
                        <div>
                            <img src="assets/img/<?php echo htmlspecialchars($card['image']); ?>" alt="<?php echo htmlspecialchars($card['name']); ?>" style="width:150px; height:auto; display:block; margin:auto;">
                            <div><?php echo htmlspecialchars($card['name']); ?></div>
                            <div style="color:#e75480;"><?php echo number_format($card['price']); ?> VND</div>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>
            <p style="margin-top:15px;">Card message (optional):</p>
            <textarea name="card_message" rows="3" style="width:100%; border-radius:4px; border:1px solid #ccc; padding:8px;" placeholder="Leave your message here..."></textarea>
            <p style="margin-top:15px; font-size: 18px;">Shipping Fee: 
                <b id="shipping-fee" data-fee="<?php echo $shipping_fee; ?>"><?php echo number_format($shipping_fee); ?> VND</b>
            </p>
            <p style="margin-top:15px;">Total Price:</p>
            <p style="font-size:20px;color:#e75480;">
                <b id="total-price" data-price="<?php echo $product['price']; ?>">
                    <?php echo number_format($product['price']); ?> VND
                </b>
            </p>
            <form method="post" id="cart-form">
                <input 
                    type="submit" 
                    name="add_to_cart"
                    value="🛒 Add to Cart" 
                    style="width:30%; background-color:#FFB5C0; color:black; padding:14px 20px; border:none; border-radius:4px; cursor:pointer;"
                >
                <button 
                    type="button"
                    id="checkout-btn"
                    style="width:30%; background-color:#e75480; color:white; padding:14px 20px; border:none; border-radius:4px; cursor:pointer; margin-left:10px;"
                >Checkout</button>
            </form>
        </div>
            <a href="homepage.php">Back to Shop</a>
        </div>
        <script>
        function updateTotal() {
            const price = parseInt(document.getElementById('total-price').getAttribute('data-price'));
            const qty = parseInt(document.getElementById('quantity').value) || 1;
            const cardRadio = document.querySelector('input[name="card"]:checked');
            const cardPrice = cardRadio ? parseInt(cardRadio.getAttribute('data-card-price')) : 0;
            const shippingFee = parseInt(document.getElementById('shipping-fee').getAttribute('data-fee')) || 0;
            const total = price * qty + cardPrice + shippingFee;
            document.getElementById('total-price').textContent = total.toLocaleString() + ' VND';
        }

        document.getElementById('quantity').addEventListener('input', updateTotal);
        document.querySelectorAll('input[name="card"]').forEach(function(radio) {
            radio.addEventListener('change', updateTotal);
        });
        document.querySelectorAll('.card label').forEach(function(label) {
            label.addEventListener('click', function(e) {
                const input = this.querySelector('input[type="radio"]');
                if (input.checked) {
                    // Deselect if already selected
                    input.checked = false;
                    document.querySelectorAll('.card label').forEach(l => l.classList.remove('selected'));
                } else {
                    // Select this card
                    document.querySelectorAll('.card label').forEach(l => l.classList.remove('selected'));
                    input.checked = true;
                    this.classList.add('selected');
                }
                updateTotal();
                // Prevent default radio behavior
                e.preventDefault();
            });
        });
        updateTotal();

        document.getElementById('checkout-btn').addEventListener('click', function() {
            const productId = <?php echo $product_id; ?>;
            const quantity = document.getElementById('quantity').value || 1;
            const card = document.querySelector('input[name="card"]:checked');
            const cardId = card ? card.value : '';
            const message = encodeURIComponent(document.querySelector('textarea[name="card_message"]').value || '');
            let url = `./views/customer/pay.php?id=${productId}&quantity=${quantity}`;
            if (cardId) url += `&card=${cardId}`;
            if (message) url += `&message=${message}`;
            window.location.href = url;
        });
        </script>
    </body>
    <?php include 'includes/footer.php'; ?>
</html>